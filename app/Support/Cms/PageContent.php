<?php

namespace App\Support\Cms;

use Illuminate\Support\Facades\File;

class PageContent
{
    public static function pages(): array
    {
        return [
            self::page(
                title: 'Home',
                slug: 'home',
                metaTitle: 'DreamStill Technologies | Circular Textile Clean Technology',
                metaDescription: 'DreamStill builds circular textile tools, climate technology, and community experiences for a zero-waste future.',
                template: 'home',
                navLabel: 'Home',
                showInNav: true,
                isHomepage: true,
            ),
            self::page(
                title: 'About',
                slug: 'about',
                metaTitle: 'About | DreamStill Technologies',
                metaDescription: 'Learn about DreamStill, its founders, milestones, and the mission behind its circular textile work.',
                template: 'about',
                navLabel: 'About',
                showInNav: true,
            ),
            self::page(
                title: 'Sorty App',
                slug: 'app',
                metaTitle: 'Sorty App | DreamStill Technologies',
                metaDescription: 'Explore Sorty, DreamStill\'s textile circularity app for routing unwanted clothing toward its next best use.',
                template: 'app',
                navLabel: 'App',
                showInNav: true,
            ),
            self::page(
                title: 'Experiences',
                slug: 'portfolio',
                metaTitle: 'Experiences | DreamStill Technologies',
                metaDescription: 'Discover DreamStill\'s sustainability experiences for teams, conferences, retreats, and community gatherings.',
                template: 'portfolio',
                navLabel: 'Experiences',
                showInNav: true,
            ),
            self::page(
                title: 'Contact',
                slug: 'contact',
                metaTitle: 'Contact | DreamStill Technologies',
                metaDescription: 'Contact DreamStill about pilots, partnerships, events, media, and investment opportunities.',
                template: 'contact',
                navLabel: 'Contact',
                showInNav: false,
            ),
            self::page(
                title: 'Investors',
                slug: 'investors',
                metaTitle: 'For Investors & Funders | DreamStill Technologies',
                metaDescription: 'Investor information for DreamStill Technologies, including traction, technology, and funding interest.',
                template: 'investors',
                navLabel: 'Investors',
                showInNav: false,
            ),
        ];
    }

    protected static function page(
        string $title,
        string $slug,
        string $metaTitle,
        string $metaDescription,
        string $template,
        string $navLabel,
        bool $showInNav,
        bool $isHomepage = false,
    ): array {
        return [
            'title' => $title,
            'slug' => $slug,
            'status' => 'published',
            'template' => $template,
            'nav_label' => $navLabel,
            'show_in_nav' => $showInNav,
            'is_homepage' => $isHomepage,
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'sections' => [
                [
                    'name' => 'Page body',
                    'type' => 'raw_blade',
                    'sort_order' => 10,
                    'data' => [
                        'markup' => self::loadMarkup($slug),
                    ],
                ],
            ],
        ];
    }

    protected static function loadMarkup(string $slug): string
    {
        $path = base_path("cms_page_sources/{$slug}.blade.raw");

        return File::exists($path)
            ? File::get($path)
            : '';
    }
}
