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
            <a href="{{ url($navPage->route_path) }}">{{ $navPage->nav_label ?: $navPage->title }}</a>
          @endforeach
        </nav>
        <a class="button" href="{{ url('/sorty') }}" style="background: linear-gradient(135deg, #6C63FF, #9D97FF); color: #fff; border: none;">Sorty App</a>
        <a class="button coral" href="{{ url($siteSettings['header_cta_url'] ?? '/contact') }}">{{ $siteSettings['header_cta_label'] ?? "Let's talk" }}</a>
      </div>
    </header>

    <main>
      {{-- ================= HERO: copy left, live app right ================= --}}
      <section class="section">
        <div class="site-shell">
          <div class="sorty-hero">
            <div>
              <p class="eyebrow">Sorty · free in your browser</p>
              <h1 class="headline">Every garment deserves a <span>next best life</span>.</h1>
              <p class="lede">
                Photograph any piece of clothing and Sorty's AI tells you — in seconds, in plain
                English — whether to <strong>resell, donate, repair, or recycle</strong> it, what
                it's worth, and exactly where to take it near you.
              </p>
              <ul class="sorty-checks">
                <li>AI condition assessment with explainable, auditable reasoning</li>
                <li>Real resale, repair, donation &amp; recycling spots across Metro Vancouver</li>
                <li>Track the kilograms you divert and the CO₂e you save</li>
                <li>Free for everyone — challenges, rewards &amp; community included</li>
              </ul>
              <div class="hero-actions">
                <a class="button coral attention-gentle" href="{{ url('/demo') }}">Try Sorty now — it's free</a>
                <a class="button" href="{{ url('/demo') }}">📲 Install the web app</a>
              </div>
              <p class="hero-note">
                Works on any phone or laptop. To install: open Sorty → Profile → “Install the app”.
                iOS &amp; Android store apps coming soon.
              </p>
            </div>
            <div class="sorty-phone-wrap">
              <div class="sorty-phone">
                <div class="sorty-notch"></div>
                <iframe src="{{ url('/app-demo/index.html') }}" title="Sorty app — live" loading="lazy"></iframe>
              </div>
              <p class="sorty-phone-caption">▲ This is the real app, live — go ahead, try it</p>
            </div>
          </div>
        </div>
      </section>

      {{-- ================= FEATURES ================= --}}
      <section class="section">
        <div class="site-shell">
          <div class="section-heading">
            <h2>A personal assistant for your unwanted clothes</h2>
            <p>85% of textiles end up in landfill — most could have had another life. Sorty makes the responsible choice the easy choice.</p>
          </div>
          <div class="grid three">
            <div class="card"><h3>🧠 AI vision analysis</h3><p>Snap front &amp; back photos. Frontier vision AI inspects fabric, damage, brand tags and condition — no forms, no guesswork.</p></div>
            <div class="card"><h3>🧭 Explainable decisions</h3><p>Every recommendation comes with plain-English reasons from our published decision framework — auditable, never a black box.</p></div>
            <div class="card"><h3>💰 Resale value estimates</h3><p>Brand-aware price bands tell you what an item could fetch on Poshmark, Depop and consignment before you decide.</p></div>
            <div class="card"><h3>📍 Real local drop-offs</h3><p>Verified thrift, repair, donation, recycling and take-back locations, distance-sorted from wherever you are.</p></div>
            <div class="card"><h3>💬 Ask anything</h3><p>A streaming AI assistant answers repair, care, resale and donation questions — even from a photo of the garment.</p></div>
            <div class="card"><h3>🏆 Challenges &amp; rewards</h3><p>Earn points for sorting responsibly and redeem them for perks at local circular businesses.</p></div>
          </div>
        </div>
      </section>

      {{-- ================= HOW IT WORKS ================= --}}
      <section class="section tight">
        <div class="site-shell">
          <div class="section-heading">
            <h2>Three steps to a clear-conscience closet</h2>
          </div>
          <div class="grid three">
            <div class="card"><h3>1 · Photograph it</h3><p>Front and back photos — add the brand tag if you want a sharper price estimate.</p></div>
            <div class="card"><h3>2 · AI assesses it</h3><p>Condition score, damage detection, brand read, and a resale value band — in seconds.</p></div>
            <div class="card"><h3>3 · Give it a next life</h3><p>Resell, donate, repair, or recycle — with the best nearby spots mapped for a single trip.</p></div>
          </div>
        </div>
      </section>

      {{-- ================= LIVE IMPACT ================= --}}
      <section class="section tight">
        <div class="site-shell">
          <div class="section-heading">
            <h2>Impact, counted live from the platform</h2>
          </div>
          <div class="impact-grid" id="sorty-impact">
            <div class="impact-card"><div class="impact-number" id="stat-sorts">—</div><p>garments assessed by our AI</p></div>
            <div class="impact-card"><div class="impact-number" id="stat-kg">—</div><p>kg of textiles diverted from landfill</p></div>
            <div class="impact-card"><div class="impact-number" id="stat-ghg">—</div><p>kg CO₂e avoided through circularity</p></div>
          </div>
        </div>
      </section>

      {{-- ================= PARTNERS ================= --}}
      <section class="section tight">
        <div class="site-shell">
          <div class="mission-card">
            <h2>For municipalities, retailers &amp; circular businesses</h2>
            <p>
              The consumer app stays free. Partners get diversion dashboards, aggregated behaviour
              insights, take-back campaign tooling, and verified referrals to their locations.
              DreamStill has already diverted 2,500+ lbs of textiles through 40+ community events —
              Sorty scales that impact.
            </p>
            <p style="margin-top: 18px;"><a class="button lime" href="{{ url('/contact') }}">Talk to DreamStill</a></p>
          </div>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <div class="site-shell">
        <div class="footer-cta">
          <p>Ready to give your closet a next life?</p>
          <a class="button lime attention-gentle" href="{{ url('/demo') }}">Open the Sorty Web App</a>
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
            <h3>Sorty</h3>
            <nav class="footer-links" aria-label="Sorty links">
              <a href="{{ url('/demo') }}">Open the web app</a>
              <a href="{{ url('/sorty') }}">About Sorty</a>
              <a href="{{ url('/terms') }}">Terms &amp; Conditions</a>
              <a href="{{ url('/privacy') }}">Privacy Policy</a>
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
        <div class="footer-bottom">
          © {{ date('Y') }} DreamStill Technologies. All rights reserved. ·
          <a href="{{ url('/terms') }}">Terms</a> · <a href="{{ url('/privacy') }}">Privacy</a> ·
          Powered by <a href="https://inputly.ai" target="_blank" rel="noopener">Inputly AI</a>
        </div>
      </div>
    </footer>
@endsection

@push('head')
<style>
    /* Sorty landing extras — inherits the DreamStill design system. */
    .sorty-hero {
        display: grid;
        grid-template-columns: 1.05fr 0.95fr;
        gap: 56px;
        align-items: center;
    }
    .sorty-checks {
        list-style: none;
        padding: 0;
        margin: 0 0 26px;
    }
    .sorty-checks li {
        position: relative;
        padding-left: 34px;
        margin-bottom: 12px;
        line-height: 1.55;
    }
    .sorty-checks li::before {
        content: "✓";
        position: absolute;
        left: 0;
        top: 0;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--lime);
        color: var(--forest);
        font-weight: 700;
        font-size: 0.8rem;
        display: grid;
        place-items: center;
    }
    .sorty-phone-wrap { display: flex; flex-direction: column; align-items: center; }
    .sorty-phone {
        width: 384px;
        height: 780px;
        padding: 12px;
        background: #1d1a29;
        border-radius: 46px;
        box-shadow: var(--shadow), 0 0 70px rgba(108, 99, 255, 0.18);
        position: relative;
    }
    .sorty-phone iframe {
        width: 100%;
        height: 100%;
        border: 0;
        border-radius: 36px;
        background: #F8F9FE;
    }
    .sorty-notch {
        position: absolute;
        top: 22px;
        left: 50%;
        transform: translateX(-50%);
        width: 108px;
        height: 22px;
        background: #1d1a29;
        border-radius: 999px;
        z-index: 2;
    }
    .sorty-phone-caption { margin-top: 14px; font-size: 0.85rem; opacity: 0.65; }

    @media (max-width: 980px) {
        .sorty-hero { grid-template-columns: 1fr; }
        .sorty-phone { width: 330px; height: 680px; }
    }
</style>
@endpush

@push('scripts')
<script>
    // Mobile visitors go straight into the app — the app IS the mobile view.
    if (window.innerWidth < 768) {
        window.location.replace('{{ url('/demo') }}');
    }

    // Live impact counters
    (function () {
        function countUp(el, target, decimals) {
            var start = performance.now(), dur = 1400;
            function tick(now) {
                var p = Math.min((now - start) / dur, 1);
                var eased = 1 - Math.pow(1 - p, 3);
                el.textContent = (target * eased).toFixed(decimals);
                if (p < 1) requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
        }

        fetch('{{ url('/api/v1/impact/global') }}')
            .then(function (r) { return r.json(); })
            .then(function (res) {
                var data = res.data || {};
                var section = document.getElementById('sorty-impact');
                var fired = false;
                var io = new IntersectionObserver(function (entries) {
                    if (entries[0].isIntersecting && !fired) {
                        fired = true;
                        countUp(document.getElementById('stat-sorts'), data.sorts_total || 0, 0);
                        countUp(document.getElementById('stat-kg'), data.textiles_kg_diverted || 0, 1);
                        countUp(document.getElementById('stat-ghg'), data.ghg_kg_avoided || 0, 1);
                        io.disconnect();
                    }
                }, { threshold: 0.4 });
                io.observe(section);
            })
            .catch(function () {});
    })();
</script>
@endpush
