<?php

namespace App\Services\Ai;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Client for Azure OpenAI (v1 API) chat-completions deployments.
 *
 * Tuned for the gpt-5 reasoning family: uses max_completion_tokens (never
 * max_tokens), no custom temperature, and reasoning_effort control.
 * Vision analysis (structured JSON) + chatbot (plain / streaming).
 */
class AzureOpenAi
{
    public const PROMPT_VERSION = 'garment-analysis-1.1';

    public function isConfigured(): bool
    {
        return (bool) (config('sorty.azure.endpoint') && config('sorty.azure.api_key'));
    }

    /**
     * Analyze garment photos with the vision deployment. Returns the structured
     * analysis array, or null when unconfigured/unavailable (caller falls back
     * to rules-only — the demo must never break).
     *
     * @param  array<string, string>  $imageBytesByType  type => raw JPEG bytes (front/back/tag)
     * @return array{category?: string, brand?: ?string, colours?: array<int, string>,
     *               damages?: array<int, array{type: string, severity: int, image: string, location: string, size_over_threshold?: bool}>,
     *               quality_signals?: array<int, string>}|null
     */
    public function analyzeGarment(array $imageBytesByType): ?array
    {
        if (! $this->isConfigured()) {
            return null;
        }

        $content = [[
            'type' => 'text',
            'text' => 'Analyze the garment in these photos. Photos are labeled by view.',
        ]];

        foreach ($imageBytesByType as $type => $bytes) {
            $content[] = ['type' => 'text', 'text' => "View: {$type}"];
            $content[] = [
                'type' => 'image_url',
                'image_url' => ['url' => $this->toDataUrl($bytes), 'detail' => 'high'],
            ];
        }

        try {
            $response = $this->request([
                'model' => config('sorty.azure.vision_deployment'),
                'messages' => [
                    ['role' => 'system', 'content' => $this->visionSystemPrompt()],
                    ['role' => 'user', 'content' => $content],
                ],
                'response_format' => ['type' => 'json_object'],
                'reasoning_effort' => config('sorty.azure.vision_reasoning_effort'),
                'max_completion_tokens' => 4000,
            ], timeout: 60);

            $json = json_decode($response->json('choices.0.message.content') ?? '', true);

            return is_array($json) ? $json : null;
        } catch (\Throwable $e) {
            report($e);

            return null;
        }
    }

    /**
     * Chatbot completion (non-streaming). Messages may contain multimodal
     * content arrays (text + image_url) for photo questions.
     *
     * @param  array<int, array{role: string, content: mixed}>  $messages
     * @return array{content: string, prompt_tokens: ?int, completion_tokens: ?int, model: string}
     */
    public function chat(array $messages, int $maxCompletionTokens = 2500): array
    {
        $response = $this->request([
            'model' => config('sorty.azure.chat_deployment'),
            'messages' => $messages,
            'reasoning_effort' => config('sorty.azure.chat_reasoning_effort'),
            'max_completion_tokens' => $maxCompletionTokens,
        ], timeout: 90);

        return [
            'content' => (string) $response->json('choices.0.message.content'),
            'prompt_tokens' => $response->json('usage.prompt_tokens'),
            'completion_tokens' => $response->json('usage.completion_tokens'),
            'model' => (string) config('sorty.azure.chat_deployment'),
        ];
    }

    /**
     * Streaming chatbot completion. Invokes $onDelta per content token and
     * returns the full assembled reply.
     *
     * @param  array<int, array{role: string, content: mixed}>  $messages
     * @param  callable(string): void  $onDelta
     */
    public function chatStream(array $messages, callable $onDelta, int $maxCompletionTokens = 2500): string
    {
        $response = Http::withHeaders(['api-key' => config('sorty.azure.api_key')])
            ->withOptions(['stream' => true])
            ->timeout(120)
            ->post($this->url(), [
                'model' => config('sorty.azure.chat_deployment'),
                'messages' => $messages,
                'reasoning_effort' => config('sorty.azure.chat_reasoning_effort'),
                'max_completion_tokens' => $maxCompletionTokens,
                'stream' => true,
            ]);

        if ($response->failed()) {
            throw new RuntimeException('Azure OpenAI stream failed: '.$response->status());
        }

        $full = '';
        $body = $response->toPsrResponse()->getBody();
        $buffer = '';

        while (! $body->eof()) {
            $buffer .= $body->read(1024);

            while (($pos = strpos($buffer, "\n")) !== false) {
                $line = trim(substr($buffer, 0, $pos));
                $buffer = substr($buffer, $pos + 1);

                if (! str_starts_with($line, 'data: ')) {
                    continue;
                }

                $payload = substr($line, 6);

                if ($payload === '[DONE]') {
                    break 2;
                }

                $delta = json_decode($payload, true)['choices'][0]['delta']['content'] ?? null;

                if ($delta !== null && $delta !== '') {
                    $full .= $delta;
                    $onDelta($delta);
                }
            }
        }

        return $full;
    }

    /**
     * Content moderation gate for community tips. Returns approval + reason.
     *
     * @return array{approved: bool, reason: ?string}
     */
    public function moderateTip(string $text): array
    {
        if (! $this->isConfigured()) {
            // Fail closed to manual review, not auto-publish.
            return ['approved' => false, 'reason' => 'Moderation unavailable — queued for admin review'];
        }

        try {
            $response = $this->request([
                'model' => config('sorty.azure.chat_deployment'),
                'messages' => [
                    ['role' => 'system', 'content' => 'You moderate community tips for a clothing sustainability app. Approve genuine tips about clothing care, repair, reuse, donation, or sustainability. Reject spam, harassment, profanity, unsafe advice, or off-topic content. Reply ONLY with JSON: {"approved": true|false, "reason": "short user-facing reason when rejected, else null"}'],
                    ['role' => 'user', 'content' => $text],
                ],
                'response_format' => ['type' => 'json_object'],
                'reasoning_effort' => 'minimal',
                'max_completion_tokens' => 800,
            ], timeout: 30);

            $json = json_decode($response->json('choices.0.message.content') ?? '', true);

            return [
                'approved' => (bool) ($json['approved'] ?? false),
                'reason' => $json['reason'] ?? null,
            ];
        } catch (\Throwable $e) {
            report($e);

            return ['approved' => false, 'reason' => 'Moderation unavailable — queued for admin review'];
        }
    }

    private function request(array $payload, int $timeout): Response
    {
        $response = Http::withHeaders(['api-key' => config('sorty.azure.api_key')])
            ->timeout($timeout)
            ->retry(2, 500, throw: false)
            ->post($this->url(), $payload);

        if ($response->failed()) {
            throw new RuntimeException(
                'Azure OpenAI request failed: '.$response->status().' '.substr((string) $response->body(), 0, 500)
            );
        }

        return $response;
    }

    /**
     * Azure OpenAI v1 API endpoint (version-less; deployment passed as model).
     */
    private function url(): string
    {
        $endpoint = rtrim((string) config('sorty.azure.endpoint'), '/');

        return "{$endpoint}/openai/v1/chat/completions";
    }

    private function toDataUrl(string $bytes): string
    {
        return 'data:image/jpeg;base64,'.base64_encode($bytes);
    }

    private function visionSystemPrompt(): string
    {
        return <<<'PROMPT'
You are a garment condition assessor for a textile circularity platform. Examine the
supplied photos (front view, optional back view, optional brand tag) and return ONLY a
JSON object with this exact shape:

{
  "category": "shirt|pants|dress|outerwear|shoes|accessory|other",
  "brand": "brand name read from tag or visible logo, else null",
  "colours": ["primary colour", "..."],
  "damages": [
    {
      "type": "stain|damaged_text|shrinkage|faded_colour|pilling|tear|seam_breakage|missing_button|broken_zipper",
      "severity": 1,
      "image": "front|back",
      "location": "short human description e.g. 'left sleeve near cuff'",
      "size_over_threshold": false
    }
  ],
  "quality_signals": ["short flags like 'heavy wear', 'like new', 'misshapen'"]
}

Rules:
- severity: 1 = minor/barely visible, 2 = clearly visible, 3 = severe/extensive.
- size_over_threshold: true for tears longer than ~3cm or seam breakage longer than ~5cm.
- Report only damage you can actually see. An empty damages array is a valid answer.
- Do not invent a brand. Reading the tag photo is the preferred source.
- No prose, no markdown — the JSON object only.
PROMPT;
    }
}
