<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Sort;
use App\Services\Media\ImageStorage;
use Illuminate\Http\Request;

/**
 * Authorized image serving for local-disk media; redirects to the CDN
 * when media lives on Azure (docs/SECURITY.md §3).
 */
class SortImageController extends Controller
{
    public function __invoke(Request $request, Sort $sort, string $type, ImageStorage $storage)
    {
        $this->authorize('view', $sort);

        $image = $sort->images()->where('type', $type)->first();

        abort_if($image === null, 404);

        $publicUrl = $storage->publicUrl($image->path);
        if ($publicUrl !== null) {
            return redirect()->away($publicUrl);
        }

        return $storage->response($image->path, [
            'Cache-Control' => 'private, max-age=86400',
        ]);
    }
}
