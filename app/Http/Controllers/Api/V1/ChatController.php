<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatMessageResource;
use App\Models\ChatConversation;
use App\Models\Event;
use App\Models\PartnerLocation;
use App\Services\Ai\AzureOpenAi;
use App\Services\Media\ImageStorage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ChatController extends Controller
{
    /**
     * Send a message; streams the assistant reply as SSE. Accepts an optional
     * image ("is this worth repairing?") and optional lat/lng for grounded
     * local recommendations.
     */
    public function send(Request $request, AzureOpenAi $ai, ImageStorage $images): StreamedResponse
    {
        $validated = $request->validate([
            'conversation_id' => ['nullable', 'uuid'],
            'message' => ['required', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:6144'],
            'lat' => ['nullable', 'numeric', 'between:-90,90'],
            'lng' => ['nullable', 'numeric', 'between:-180,180'],
        ]);

        $user = $request->user();

        $conversation = isset($validated['conversation_id'])
            ? ChatConversation::query()->findOrFail($validated['conversation_id'])
            : $user->chatConversations()->create(['title' => Str::limit($validated['message'], 60)]);

        $this->authorize('view', $conversation);

        $userMessage = $conversation->messages()->create([
            'role' => 'user',
            'content' => $validated['message'],
        ]);

        // Build the multimodal user content when an image is attached.
        $userContent = $validated['message'];
        if ($request->hasFile('image')) {
            $stored = $images->storePrivate($request->file('image'), "chat/{$user->id}/{$conversation->id}");
            $bytes = $images->readBytes($stored['path']) ?? '';
            $userContent = [
                ['type' => 'text', 'text' => $validated['message']],
                ['type' => 'image_url', 'image_url' => [
                    'url' => 'data:image/jpeg;base64,'.base64_encode($bytes),
                    'detail' => 'low',
                ]],
            ];
        }

        $messages = $this->buildMessages($conversation, $userContent, $request);

        return response()->stream(function () use ($ai, $messages, $conversation, $userMessage): void {
            $emit = function (array $payload): void {
                echo 'data: '.json_encode($payload)."\n\n";
                if (ob_get_level() > 0) {
                    ob_flush();
                }
                flush();
            };

            try {
                $full = $ai->chatStream($messages, fn (string $delta) => $emit(['delta' => $delta]));
            } catch (\Throwable $e) {
                report($e);
                $full = "I'm having trouble connecting right now — please try again in a moment.";
                $emit(['delta' => $full]);
            }

            $assistantMessage = $conversation->messages()->create([
                'role' => 'assistant',
                'content' => $full,
                'model' => (string) config('sorty.azure.chat_deployment'),
            ]);

            $conversation->touch();

            $emit([
                'done' => true,
                'message' => (new ChatMessageResource($assistantMessage))->resolve(),
                'user_message_id' => $userMessage->id,
                'conversation_id' => $conversation->id,
            ]);
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'X-Accel-Buffering' => 'no',
        ]);
    }

    public function conversations(Request $request): AnonymousResourceCollection
    {
        $conversations = $request->user()->chatConversations()
            ->latest('updated_at')
            ->limit(50)
            ->get(['id', 'title', 'updated_at']);

        return JsonResource::collection($conversations);
    }

    public function messages(Request $request, ChatConversation $conversation): AnonymousResourceCollection
    {
        $this->authorize('view', $conversation);

        return ChatMessageResource::collection(
            $conversation->messages()->orderBy('id')->get()
        );
    }

    /**
     * Assemble the model context: persona + live grounding from MySQL
     * (nearby partner locations, upcoming events, the user's recent sorts).
     *
     * @return array<int, array{role: string, content: mixed}>
     */
    private function buildMessages(ChatConversation $conversation, mixed $latestUserContent, Request $request): array
    {
        $grounding = '';

        if ($request->filled('lat') && $request->filled('lng')) {
            $nearby = PartnerLocation::query()
                ->published()
                ->near((float) $request->input('lat'), (float) $request->input('lng'), 20)
                ->limit(12)
                ->get(['name', 'type', 'address', 'website'])
                ->map(fn ($l) => "- {$l->name} ({$l->type}) — {$l->address}".($l->website ? " — {$l->website}" : ''))
                ->implode("\n");

            if ($nearby !== '') {
                $grounding .= "\n\nNearby partner locations (use these for local recommendations):\n{$nearby}";
            }
        }

        $events = Event::query()->published()->upcoming()->limit(5)
            ->get(['title', 'starts_at', 'location'])
            ->map(fn ($e) => "- {$e->title} — {$e->starts_at->format('M j')} — {$e->location}")
            ->implode("\n");

        if ($events !== '') {
            $grounding .= "\n\nUpcoming DreamStill community events:\n{$events}";
        }

        $recentSorts = $conversation->user->sorts()
            ->whereNotNull('decision')->latest()->limit(3)
            ->get(['decision', 'brand', 'category', 'condition_score'])
            ->map(fn ($s) => "- {$s->category} ".($s->brand ? "({$s->brand}) " : '')."→ {$s->decision}, condition {$s->condition_score}/4")
            ->implode("\n");

        if ($recentSorts !== '') {
            $grounding .= "\n\nThe user's recent sorts:\n{$recentSorts}";
        }

        $system = <<<PROMPT
You are Sorty, the sustainability assistant in the Sorty app by DreamStill Technologies
(Vancouver, BC). You help people decide what to do with unwanted clothing — resell,
donate, repair, or recycle — and answer questions about clothing care, repair costs,
resale platforms, donation etiquette, textile recycling, and sustainable fashion.

Style: warm, practical, concise. Use short paragraphs or tight bullet lists. Give
concrete, actionable advice with realistic price/cost figures (CAD). When a photo is
provided, assess what you can actually see. When local options are relevant, recommend
from the partner locations provided below — never invent addresses. Suggest the app's
Sort feature when a full condition assessment would help. Stay on the topic of clothing
and sustainability; politely redirect anything else.{$grounding}
PROMPT;

        $history = $conversation->messages()
            ->orderByDesc('id')->limit(12)->get()->reverse()
            ->map(fn ($m) => ['role' => $m->role, 'content' => $m->content])
            ->values()
            ->all();

        // Replace the last history entry (the just-saved user message) with the
        // potentially multimodal version.
        if ($history !== []) {
            array_pop($history);
        }
        $history[] = ['role' => 'user', 'content' => $latestUserContent];

        return [['role' => 'system', 'content' => $system], ...$history];
    }
}
