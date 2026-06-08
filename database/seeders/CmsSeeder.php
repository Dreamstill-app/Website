<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SiteSetting;
use App\Support\Cms\PageContent;
use App\Support\Cms\SiteDefaults;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            SiteDefaults::settings()
        );

        foreach (PageContent::pages() as $pageData) {
            $sections = $pageData['sections'] ?? [];
            unset($pageData['sections']);

            if (($pageData['status'] ?? null) === 'published' && empty($pageData['published_at'])) {
                $pageData['published_at'] = Carbon::now();
            }

            $page = Page::query()->updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );

            $existingIds = [];

            foreach ($sections as $sectionData) {
                $section = PageSection::query()->updateOrCreate(
                    [
                        'page_id' => $page->id,
                        'sort_order' => $sectionData['sort_order'],
                    ],
                    [
                        'name' => $sectionData['name'] ?? null,
                        'type' => $sectionData['type'],
                        'data' => $sectionData['data'] ?? [],
                    ]
                );

                $existingIds[] = $section->id;
            }

            PageSection::query()
                ->where('page_id', $page->id)
                ->when($existingIds !== [], fn ($query) => $query->whereNotIn('id', $existingIds))
                ->delete();
        }
    }
}
