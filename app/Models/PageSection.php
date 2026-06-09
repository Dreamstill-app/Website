<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Throwable;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'type',
        'name',
        'sort_order',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function render(): HtmlString
    {
        $viewMap = [
            'hero'        => 'sections.hero',
            'page_hero'   => 'sections.page_hero',
            'mission'     => 'sections.mission',
            'stats'       => 'sections.stats',
            'cards'       => 'sections.cards',
            'text_card'   => 'sections.text_card',
            'timeline'    => 'sections.timeline',
            'press'       => 'sections.press',
            'logo_strip'  => 'sections.logo_strip',
            'newsletter'  => 'sections.newsletter',
            'contact_cta' => 'sections.contact_cta',
            'image_text'  => 'sections.image_text',
            'rich_text'   => 'sections.rich_text',
        ];

        try {
            if (isset($viewMap[$this->type])) {
                return new HtmlString(view($viewMap[$this->type], ['data' => $this->normalizedData()])->render());
            }

            if ($this->type === 'raw_blade') {
                return new HtmlString(Blade::render($this->sanitizeRawBlade($this->data['markup'] ?? '')));
            }
        } catch (Throwable) {
            return new HtmlString('');
        }

        return new HtmlString('');
    }

    protected function normalizedData(): array
    {
        $data = is_array($this->data) ? $this->data : [];

        return match ($this->type) {
            'hero' => array_merge([
                'eyebrow' => '',
                'headline' => '',
                'lede' => '',
                'hero_note' => '',
                'buttons' => [],
                'slides' => [],
            ], $data),
            'page_hero' => array_merge([
                'slider_style' => false,
                'eyebrow' => '',
                'heading' => '',
                'text' => '',
                'badge' => '',
                'image' => null,
                'image_alt' => '',
                'buttons' => [],
                'slides' => [],
            ], $data),
            'mission' => array_merge([
                'eyebrow' => '',
                'heading' => '',
                'text' => '',
            ], $data),
            'stats' => array_merge([
                'heading' => '',
                'subtext' => '',
                'columns' => '4',
                'items' => [],
                'source_note' => '',
            ], $data),
            'cards' => array_merge([
                'heading' => '',
                'subtext' => '',
                'columns' => '2',
                'card_class' => '',
                'items' => [],
            ], $data),
            'text_card' => array_merge([
                'heading' => '',
                'content' => '',
            ], $data),
            'timeline' => array_merge([
                'heading' => '',
                'subtext' => '',
                'items' => [],
            ], $data),
            'press' => array_merge([
                'heading' => '',
                'subtext' => '',
                'items' => $this->decodeItemsFromContent($data),
            ], Arr::except($data, ['content'])),
            'logo_strip' => array_merge([
                'heading' => '',
                'subtext' => '',
                'tags' => [],
                'partners_heading' => '',
                'partners' => [],
            ], $data),
            'newsletter' => array_merge([
                'eyebrow' => '',
                'heading' => '',
                'text' => '',
                'placeholder' => 'your@email.com',
                'button_label' => 'Subscribe',
            ], $data),
            'contact_cta' => array_merge([
                'eyebrow' => '',
                'heading' => '',
                'text' => '',
                'buttons' => [],
                'contact_items' => [],
            ], $data),
            'image_text' => array_merge([
                'eyebrow' => '',
                'heading' => '',
                'content' => '',
                'image' => null,
                'image_alt' => '',
                'image_position' => 'right',
                'buttons' => [],
            ], $data),
            'rich_text' => array_merge([
                'content' => '',
            ], $data),
            default => $data,
        };
    }

    protected function decodeItemsFromContent(array $data): array
    {
        if (!empty($data['items']) && is_array($data['items'])) {
            return $data['items'];
        }

        $decoded = json_decode($data['content'] ?? '[]', true);

        return is_array($decoded) ? array_values($decoded) : [];
    }

    protected function sanitizeRawBlade(string $markup): string
    {
        return preg_replace('/@(extends|section|endsection|yield|show|parent)\b[^\n]*/i', '', $markup) ?? '';
    }
}
