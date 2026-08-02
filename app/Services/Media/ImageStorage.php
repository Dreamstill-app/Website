<?php

namespace App\Services\Media;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/**
 * Secure image ingestion (docs/SECURITY.md §3):
 * decode + re-encode via Intervention (destroys embedded payloads, strips
 * EXIF/GPS), cap dimensions, store on the private local disk with random
 * names, record hash + dimensions.
 */
class ImageStorage
{
    private ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver);
    }

    /**
     * Store an uploaded image under the given private directory.
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
        Storage::disk('local')->put($path, $binary);

        return [
            'path' => $path,
            'width' => $image->width(),
            'height' => $image->height(),
            'bytes' => strlen($binary),
            'sha256' => hash('sha256', $binary),
        ];
    }

    public function absolutePath(string $path): string
    {
        return Storage::disk('local')->path($path);
    }

    public function delete(string $path): void
    {
        Storage::disk('local')->delete($path);
    }

    public function deleteDirectory(string $directory): void
    {
        Storage::disk('local')->deleteDirectory($directory);
    }
}
