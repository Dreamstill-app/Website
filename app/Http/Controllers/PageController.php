<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class PageController extends Controller
{
    public function home(): View|Response
    {
        return $this->showBySlug('home', true);
    }

    public function about(): View|Response
    {
        return $this->showBySlug('about');
    }

    public function app(): View|Response
    {
        return $this->showBySlug('app');
    }

    public function portfolio(): View|Response
    {
        return $this->showBySlug('portfolio');
    }

    public function contact(): View|Response
    {
        return $this->showBySlug('contact');
    }

    public function investors(): View|Response
    {
        return $this->showBySlug('investors');
    }

    protected function showBySlug(string $slug, bool $homepage = false): View|Response
    {
        $query = Page::query()->with('sections')->published();

        if ($homepage) {
            $query->where('is_homepage', true);
        } else {
            $query->where('slug', $slug);
        }

        $page = $query->first();

        if (! $page) {
            $fallback = $homepage ? 'pages.home' : 'pages.'.$slug;

            if (view()->exists($fallback)) {
                return response()->view($fallback);
            }

            abort(404);
        }

        $navigationPages = Page::published()
            ->where('show_in_nav', true)
            ->orderBy('id')
            ->get();

        $siteSettings = SiteSetting::first()?->toArray() ?? [];

        return view('pages.show', [
            'page'            => $page,
            'pageTitle'       => $page->meta_title ?: $page->title,
            'metaDescription' => $page->meta_description,
            'ogImage'         => $page->og_image ? asset($page->og_image) : null,
            'navigationPages' => $navigationPages,
            'siteSettings'    => $siteSettings,
        ]);
    }
}
