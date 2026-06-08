<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

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

        if (isset($viewMap[$this->type])) {
            return new HtmlString(view($viewMap[$this->type], ['data' => $this->data])->render());
        }

        if ($this->type === 'raw_blade') {
            return new HtmlString(Blade::render($this->data['markup'] ?? ''));
        }

        return new HtmlString('');
    }
}
