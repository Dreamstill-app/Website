<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EventController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return EventResource::collection(
            Event::query()->published()->upcoming()->limit(50)->get()
        );
    }

    /**
     * User event submission — lands as `pending` for admin approval in Filament.
     */
    public function submit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:2000'],
            'starts_at' => ['required', 'date', 'after:now'],
            'ends_at' => ['nullable', 'date', 'after:starts_at'],
            'location' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url', 'max:255'],
        ]);

        Event::create($validated + [
            'is_published' => true,
            'status' => 'pending',
            'submitted_by' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Thanks! Your event was submitted and will appear once approved.',
        ], 201);
    }
}
