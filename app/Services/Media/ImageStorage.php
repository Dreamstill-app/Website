<?php

namespace App\Services\Media;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/**
 * Secure image ingestion (docs/SECURITY.md §3):
 * decode + re-encode via Intervention (destroys embedded payloads, strips
 * EXIF/GPS), cap dimensions, store with random unguessable names.
 *
 * Backend is disk-configurable (config sorty.media_disk):
 *  - local: private disk, served through authorized API routes
 *  - azure: public-read CDN container, served by absolute URL
 */
class ImageStorage
{
    private ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver);
    }

    private function disk(): Filesystem
    {
        return Storage::disk((string) config('sorty.media_disk', 'local'));
    }

    /**
     * Store an uploaded image under the given directory on the media disk.
     *
     * @return array{path: string, width: int, height: int, bytes: int, sha256: string}
     */
    public function storePrivate(UploadedFile $file, string $directory): array
    {
        $maxDimension = (int) config('sorty.uploads.max_dimension');
        $quality = (int) config('sorty.uploads.jpeg_quality');

        $image = $this->manager->read($file->getRealPath());

        if ($image->width() > $maxDimension || $image->height() > $maxDimension) {
            $image->scaleDown($maxDimension, $maxDimension);
        }

        // Re-encode to JPEG: strips EXIF (incl. GPS) and any embedded payloads.
        $encoded = $image->toJpeg($quality);
        $binary = (string) $encoded;

        $path = trim($directory, '/').'/'.Str::random(40).'.jpg';
        $this->disk()->put($path, $binary);

        return [
            'path' => $path,
            'width' => $image->width(),
            'height' => $image->height(),
            'bytes' => strlen($binary),
            'sha256' => hash('sha256', $binary),
        ];
    }

    /**
     * Public URL when the media disk exposes one (CDN); null on private local.
     */
    public function publicUrl(string $path): ?string
    {
        if (config('sorty.media_disk') === 'azure') {
            $base = rtrim((string) config('filesystems.disks.azure.url'), '/');

            return $base !== '' ? $base.'/'.ltrim($path, '/') : null;
        }

        return null;
    }

    /**
     * Raw bytes regardless of backend (used by the vision pipeline).
     */
    public function readBytes(string $path): ?string
    {
        $contents = $this->disk()->get($path);

        return $contents === null || $contents === '' ? null : $contents;
    }

    /**
     * Stream a stored image as an HTTP response (local-disk serving).
     */
    public function response(string $path, array $headers = [])
    {
        return $this->disk()->response($path, null, $headers);
    }

    public function exists(string $path): bool
    {
        return $this->disk()->exists($path);
    }

    public function delete(string $path): void
    {
        $this->disk()->delete($path);
    }

    public function deleteDirectory(string $directory): void
    {
        $this->disk()->deleteDirectory($directory);
    }
}
