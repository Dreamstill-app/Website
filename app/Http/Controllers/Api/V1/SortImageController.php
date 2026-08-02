<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Sort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Authorized image serving — the only path to sort images
 * (private disk, no public URLs; docs/SECURITY.md §3).
 */
class SortImageController extends Controller
{
    public function __invoke(Request $request, Sort $sort, string $type): StreamedResponse
    {
        $this->authorize('view', $sort);

        $image = $sort->images()->where('type', $type)->first();

        abort_if($image === null, 404);

        return Storage::disk('local')->response($image->path, null, [
            'Cache-Control' => 'private, max-age=86400',
        ]);
    }
}
