@extends('layouts.site-page')

@section('content')
<div class="top-ribbon">{{ $siteSettings['top_ribbon'] ?? '' }}</div>
    <header class="site-header">
      <div class="site-shell nav-card">
        <a class="brand" href="{{ url('/') }}" aria-label="DreamStill home">
          <img src="{{ str_starts_with($siteSettings['logo_path'] ?? '', 'uploads/') ? \Illuminate\Support\Facades\Storage::url($siteSettings['logo_path']) : asset($siteSettings['logo_path'] ?? 'assets/img/logo.svg') }}" alt="{{ $siteSettings['site_name'] ?? 'DreamStill Technologies' }}" style="width: {{ (int) ($siteSettings['logo_width_px'] ?? 140) }}px; height: auto;">
        </a>
        <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="main-navigation">Menu</button>
        <nav class="nav-links" id="main-navigation" data-nav-links aria-label="Main menu">
          @foreach ($navigationPages as $navPage)
            <a class="{{ request()->is(ltrim($navPage->route_path, '/')) || ($navPage->is_homepage && request()->path() === '/') ? 'active' : '' }}" href="{{ url($navPage->route_path) }}">{{ $navPage->nav_label ?: $navPage->title }}</a>
          @endforeach
        </nav>
        <a class="button coral" href="{{ url($siteSettings['header_cta_url'] ?? '/contact') }}">{{ $siteSettings['header_cta_label'] ?? "Let's talk" }}</a>
      </div>
    </header>

    <main>
      @foreach ($page->sections as $section)
        {!! $section->render() !!}
      @endforeach
    </main>

    <footer class="site-footer">
      <div class="site-shell">
        <div class="footer-cta">
          <p>{{ $siteSettings['footer_cta_text'] ?? 'Ready to work together? Get in touch.' }}</p>
          <a class="button lime attention-gentle" href="{{ url($siteSettings['footer_cta_button_url'] ?? '/contact') }}">{{ $siteSettings['footer_cta_button_label'] ?? 'Contact DreamStill' }}</a>
        </div>
        <div class="footer-grid">
          <div>
            <h2>Land Acknowledgement</h2>
            <p>{{ $siteSettings['footer_blurb'] ?? '' }}</p>
          </div>
          <div>
            <h3>Main Menu</h3>
            <nav class="footer-links" aria-label="Footer main menu">
              @foreach ($navigationPages as $navPage)
                <a href="{{ url($navPage->route_path) }}">{{ $navPage->nav_label ?: $navPage->title }}</a>
              @endforeach
              <a href="{{ url('/contact') }}">Contact</a>
              <a href="{{ url('/investors') }}">Investors</a>
            </nav>
          </div>
          <div>
            <h3>Socials</h3>
            <nav class="footer-links" aria-label="Social links">
              @foreach (($siteSettings['social_links'] ?? []) as $social)
                <a href="{{ $social['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer">{{ $social['label'] ?? 'Link' }}</a>
              @endforeach
            </nav>
          </div>
        </div>
        <div class="footer-bottom">© 2026 {{ $siteSettings['site_name'] ?? 'DreamStill Technologies' }}. {{ $siteSettings['site_tagline'] ?? 'Circular textile tools for a zero-waste future.' }}</div>
      </div>
    </footer>

    <div class="mobile-cta-bar" data-reveal="up" aria-label="Quick actions">
      <a class="button coral" href="{{ url($siteSettings['mobile_cta_primary_url'] ?? '/portfolio') }}">{{ $siteSettings['mobile_cta_primary_label'] ?? 'Book an experience' }}</a>
      <a class="button" href="{{ url($siteSettings['mobile_cta_secondary_url'] ?? '/contact') }}">{{ $siteSettings['mobile_cta_secondary_label'] ?? 'Get in touch' }}</a>
    </div>
@endsection
