<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['sections'] = $this->getRecord()
            ->sections
            ->map(fn ($s) => $s->attributesToArray())
            ->values()
            ->toArray();

        $data['sections'] = array_map([$this, 'normalizeSection'], $data['sections']);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['sections'] = array_map([$this, 'normalizeSection'], $data['sections'] ?? []);

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $sections = $data['sections'] ?? [];

        $record->update(Arr::except($data, ['sections']));

        $existingIds = collect($sections)->pluck('id')->filter()->values()->all();
        $record->sections()->whereNotIn('id', $existingIds)->delete();

        foreach ($sections as $i => $sectionData) {
            $id = $sectionData['id'] ?? null;
            $payload = Arr::except($sectionData, ['id', 'page_id', 'created_at', 'updated_at']);
            $payload['sort_order'] = $payload['sort_order'] ?? ($i * 10);

            if ($id) {
                $record->sections()->where('id', $id)->first()?->update($payload);
            } else {
                $record->sections()->create($payload);
            }
        }

        return $record;
    }

    protected function normalizeSection(array $section): array
    {
        $section['data'] = is_array($section['data'] ?? null) ? $section['data'] : [];

        return match ($section['type'] ?? null) {
            'hero' => $this->normalizeHeroSection($section),
            'page_hero' => $this->normalizePageHeroSection($section),
            'stats' => $this->normalizeStatsSection($section),
            'cards' => $this->normalizeCardsSection($section),
            'timeline' => $this->normalizeTimelineSection($section),
            'press' => $this->normalizePressSection($section),
            'logo_strip' => $this->normalizeLogoStripSection($section),
            'newsletter' => $this->normalizeNewsletterSection($section),
            'contact_cta' => $this->normalizeContactCtaSection($section),
            'image_text' => $this->normalizeImageTextSection($section),
            'text_card' => $this->normalizeTextCardSection($section),
            'rich_text' => $this->normalizeRichTextSection($section),
            'mission' => $this->normalizeMissionSection($section),
            default => $section,
        };
    }

    protected function normalizeHeroSection(array $section): array
    {
        $section['data'] = array_merge([
            'eyebrow' => '',
            'headline' => '',
            'lede' => '',
            'hero_note' => '',
            'buttons' => [],
            'slides' => [],
        ], $section['data']);

        $section['data']['buttons'] = array_values(array_map(fn ($button) => array_merge([
            'label' => '',
            'url' => '',
            'style' => '',
        ], is_array($button) ? $button : []), $section['data']['buttons']));

        $section['data']['slides'] = array_values(array_map(fn ($slide) => array_merge([
            'heading' => '',
            'text' => '',
            'image' => null,
            'image_alt' => '',
        ], is_array($slide) ? $slide : []), $section['data']['slides']));

        return $section;
    }

    protected function normalizePageHeroSection(array $section): array
    {
        $section['data'] = array_merge([
            'slider_style' => false,
            'eyebrow' => '',
            'heading' => '',
            'text' => '',
            'badge' => '',
            'image' => null,
            'image_alt' => '',
            'buttons' => [],
            'slides' => [],
        ], $section['data']);

        $section['data']['buttons'] = array_values(array_map(fn ($button) => array_merge([
            'label' => '',
            'url' => '',
            'style' => '',
        ], is_array($button) ? $button : []), $section['data']['buttons']));

        $section['data']['slides'] = array_values(array_map(fn ($slide) => array_merge([
            'eyebrow' => '',
            'heading' => '',
            'text' => '',
            'image' => null,
            'image_alt' => '',
        ], is_array($slide) ? $slide : []), $section['data']['slides']));

        return $section;
    }

    protected function normalizeMissionSection(array $section): array
    {
        $section['data'] = array_merge([
            'eyebrow' => '',
            'heading' => '',
            'text' => '',
        ], $section['data']);

        return $section;
    }

    protected function normalizeStatsSection(array $section): array
    {
        $section['data'] = array_merge([
            'heading' => '',
            'subtext' => '',
            'columns' => '4',
            'items' => [],
            'source_note' => '',
        ], $section['data']);

        $section['data']['items'] = array_values(array_map(fn ($item) => array_merge([
            'number' => '',
            'label' => '',
        ], is_array($item) ? $item : []), $section['data']['items']));

        return $section;
    }

    protected function normalizeCardsSection(array $section): array
    {
        $section['data'] = array_merge([
            'heading' => '',
            'subtext' => '',
            'columns' => '2',
            'card_class' => '',
            'items' => [],
        ], $section['data']);

        $section['data']['items'] = array_values(array_map(fn ($item) => array_merge([
            'eyebrow' => '',
            'heading' => '',
            'image' => null,
            'image_alt' => '',
            'text' => '',
            'link_label' => '',
            'link_url' => '',
        ], is_array($item) ? $item : []), $section['data']['items']));

        return $section;
    }

    protected function normalizeTimelineSection(array $section): array
    {
        $section['data'] = array_merge([
            'heading' => '',
            'subtext' => '',
            'items' => [],
        ], $section['data']);

        $section['data']['items'] = array_values(array_map(fn ($item) => array_merge([
            'period' => '',
            'title' => '',
            'text' => '',
            'outcome' => '',
        ], is_array($item) ? $item : []), $section['data']['items']));

        return $section;
    }

    protected function normalizePressSection(array $section): array
    {
        // Migrate legacy 'content' key to 'items_json'
        if (isset($section['data']['content']) && !isset($section['data']['items_json'])) {
            $section['data']['items_json'] = $section['data']['content'];
            unset($section['data']['content']);
        }

        $section['data'] = array_merge([
            'heading' => '',
            'subtext' => '',
            'items_json' => '[]',
            'items' => [],
        ], $section['data']);

        $section['data']['items'] = array_values(array_map(fn ($item) => array_merge([
            'eyebrow' => '',
            'heading' => '',
            'image' => null,
            'image_alt' => '',
            'text' => '',
            'link_label' => '',
            'link_url' => '',
        ], is_array($item) ? $item : []), $section['data']['items']));

        return $section;
    }

    protected function normalizeLogoStripSection(array $section): array
    {
        $section['data'] = array_merge([
            'heading' => '',
            'subtext' => '',
            'tags' => [],
            'partners_heading' => '',
            'partners' => [],
        ], $section['data']);

        $section['data']['tags'] = array_values(array_map(fn ($tag) => array_merge([
            'label' => '',
        ], is_array($tag) ? $tag : ['label' => (string) $tag]), $section['data']['tags']));

        $section['data']['partners'] = array_values(array_map(fn ($partner) => array_merge([
            'label' => '',
            'url' => '',
            'image' => null,
        ], is_array($partner) ? $partner : []), $section['data']['partners']));

        return $section;
    }

    protected function normalizeNewsletterSection(array $section): array
    {
        $section['data'] = array_merge([
            'eyebrow' => '',
            'heading' => '',
            'text' => '',
            'placeholder' => 'your@email.com',
            'button_label' => 'Subscribe',
        ], $section['data']);

        return $section;
    }

    protected function normalizeContactCtaSection(array $section): array
    {
        $section['data'] = array_merge([
            'eyebrow' => '',
            'heading' => '',
            'text' => '',
            'buttons' => [],
            'contact_items' => [],
        ], $section['data']);

        $section['data']['buttons'] = array_values(array_map(fn ($button) => array_merge([
            'label' => '',
            'url' => '',
            'style' => '',
        ], is_array($button) ? $button : []), $section['data']['buttons']));

        $section['data']['contact_items'] = array_values(array_map(fn ($item) => array_merge([
            'label' => '',
            'url' => '',
        ], is_array($item) ? $item : []), $section['data']['contact_items']));

        return $section;
    }

    protected function normalizeImageTextSection(array $section): array
    {
        $section['data'] = array_merge([
            'eyebrow' => '',
            'heading' => '',
            'content' => '',
            'image' => null,
            'image_alt' => '',
            'image_position' => 'right',
            'buttons' => [],
        ], $section['data']);

        $section['data']['buttons'] = array_values(array_map(fn ($button) => array_merge([
            'label' => '',
            'url' => '',
            'style' => '',
        ], is_array($button) ? $button : []), $section['data']['buttons']));

        return $section;
    }

    protected function normalizeTextCardSection(array $section): array
    {
        $section['data'] = array_merge([
            'heading' => '',
            'content' => '',
        ], $section['data']);

        return $section;
    }

    protected function normalizeRichTextSection(array $section): array
    {
        $section['data'] = array_merge([
            'content' => '',
        ], $section['data']);

        return $section;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
