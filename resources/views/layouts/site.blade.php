<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ $metaDescription ?? ($siteSettings['default_meta_description'] ?? 'DreamStill Technologies equips people and industries with tools and skills to move clothing toward a zero-waste future.') }}">
        <title>{{ $pageTitle ?? ($siteSettings['site_name'] ?? config('app.name', 'DreamStill CMS')) }}</title>
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $ogTitle ?? $pageTitle ?? ($siteSettings['site_name'] ?? config('app.name', 'DreamStill CMS')) }}">
        <meta property="og:description" content="{{ $ogDescription ?? $metaDescription ?? ($siteSettings['default_meta_description'] ?? 'DreamStill Technologies equips people and industries with tools and skills to move clothing toward a zero-waste future.') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ $ogImage ?? asset($siteSettings['default_og_image'] ?? 'assets/img/app-preview.svg') }}">
        <meta name="twitter:card" content="summary_large_image">
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
        <script defer data-domain="dreamstill.ca" src="https://plausible.io/js/script.js"></script>
        @stack('head')
    </head>
    <body>
        {{ $slot }}

        <script src="{{ asset('assets/js/main.js') }}"></script>
        @stack('scripts')
    </body>
</html>
