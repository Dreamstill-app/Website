<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? ($siteSettings['default_meta_description'] ?? 'DreamStill Technologies equips people and industries with tools and skills to move clothing toward a zero-waste future.') }}">
    <title>{{ $pageTitle ?? ($siteSettings['site_name'] ?? 'DreamStill Technologies') }}</title>
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $ogTitle ?? $pageTitle ?? ($siteSettings['site_name'] ?? 'DreamStill Technologies') }}">
    <meta property="og:description" content="{{ $ogDescription ?? $metaDescription ?? ($siteSettings['default_meta_description'] ?? 'DreamStill Technologies equips people and industries with tools and skills to move clothing toward a zero-waste future.') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage ?? asset($siteSettings['default_og_image'] ?? 'assets/img/app-preview.svg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <script defer data-domain="dreamstill.ca" src="https://plausible.io/js/script.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    @stack('head')
  </head>
  <body>
    @yield('content')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
  </body>
</html>
