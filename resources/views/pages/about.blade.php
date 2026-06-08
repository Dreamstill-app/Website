@extends('layouts.site-page')

@php($pageTitle = 'About | DreamStill Technologies')

@section('content')
<div class="top-ribbon">Clean technology for textile circularity • Vancouver, BC • Sort better, waste less</div>
    <header class="site-header">
      <div class="site-shell nav-card">
        <a class="brand" href="{{ url('/') }}" aria-label="DreamStill home">
          <img src="{{ asset('assets/img/logo.svg') }}" alt="DreamStill Technologies">
        </a>
        <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="main-navigation">Menu</button>
        <nav class="nav-links" id="main-navigation" data-nav-links aria-label="Main menu">
          <a href="{{ url('/') }}">Home</a>
          <a class="active" href="{{ url('/about') }}">About</a>
          <a href="{{ url('/app') }}">App</a>
          <a href="{{ url('/portfolio') }}">Experiences</a>
        </nav>
        <a class="button coral" href="{{ url('/contact') }}">Let's talk</a>
      </div>
    </header>

    <main>
      <section class="site-shell page-hero" data-reveal="hero-left">
        <div class="about-hero-slider" data-slider aria-label="About DreamStill highlights">
          <div class="slides" data-slides>
            <article class="about-hero-slide">
              <div>
                <span class="eyebrow">About us</span>
                <h1>Change happens when people are empowered, inspired, and connected.</h1>
                <p>At DreamStill, sustainability is not just a technical goal — it's a cultural and emotional journey. We help people rediscover joy, agency, and care through the clothes they wear.</p>
              </div>
              <img src="{{ asset('assets/img/event-activation.svg') }}" alt="DreamStill community activation">
            </article>
            <article class="about-hero-slide">
              <div>
                <span class="eyebrow">Climate tech</span>
                <h1>Building tools and experiences for a zero-waste textile future.</h1>
                <p>From AI-powered sorting apps to hands-on circular fashion events, DreamStill connects technology, community, and industry to keep clothing in use longer.</p>
              </div>
              <img src="{{ asset('assets/img/app-preview.svg') }}" alt="Sorty app preview">
            </article>
            <article class="about-hero-slide">
              <div>
                <span class="eyebrow">Community rooted</span>
                <h1>40+ events. 2,000 participants. One mission.</h1>
                <p>We've learned that the best climate solutions are tactile, creative, and local — and that people change behavior when they feel connected, not lectured.</p>
              </div>
              <img src="{{ asset('assets/img/story-summer-2025.svg') }}" alt="DreamStill summer events">
            </article>
          </div>
          <div class="slider-controls" aria-label="About slider controls">
            <button class="slider-dot active" type="button" data-slide-dot aria-label="Slide 1" aria-pressed="true"></button>
            <button class="slider-dot" type="button" data-slide-dot aria-label="Slide 2" aria-pressed="false"></button>
            <button class="slider-dot" type="button" data-slide-dot aria-label="Slide 3" aria-pressed="false"></button>
          </div>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="section-heading" data-reveal="up">
          <h2>Why we started</h2>
        </div>
        <div class="card">
          <p>DreamStill began with a simple frustration: millions of garments end up in landfill every year, not because people don't care, but because they don't know what else to do. Our founders saw this gap firsthand — in overflowing donation bins, in municipal waste reports, and in community clothing swaps where people lit up when given a better option.</p>
          <p>We started with events — swaps, repair nights, styling sessions — and quickly realized the problem needed both human connection and scalable technology. Sorty was born from that insight: a tool that makes the right decision feel obvious, local, and fast. Today, DreamStill bridges community imagination with clean tech to build a circular textile future.</p>
        </div>
      </section>

      <section class="site-shell section tight" data-reveal="up">
        <div class="section-heading" data-reveal="up">
          <h2>Our story</h2>
          <p>Key milestones — and what we learned along the way.</p>
        </div>
        <div class="timeline-compact" aria-label="DreamStill story timeline">
          <article class="timeline-compact-item" data-reveal-item>
            <h3>Spring 2024</h3>
            <div>
              <p><strong>Finding Stuff:</strong> Identified textile waste pain points and gathered community stories.</p>
              <p class="outcome">→ Validated that confusion, not apathy, drives most textile disposal.</p>
            </div>
          </article>
          <article class="timeline-compact-item" data-reveal-item>
            <h3>Summer 2024</h3>
            <div>
              <p><strong>Clothing swaps, styling, and selling:</strong> First hands-on circular fashion experiences.</p>
              <p class="outcome">→ Proved that joyful, tactile events change behavior faster than information alone.</p>
            </div>
          </article>
          <article class="timeline-compact-item" data-reveal-item>
            <h3>Fall 2024</h3>
            <div>
              <p><strong>Buildspace:</strong> Refined the venture and shaped a stronger product narrative.</p>
              <p class="outcome">→ Secured accelerator support and clarified Sorty as the core technology bet.</p>
            </div>
          </article>
          <article class="timeline-compact-item" data-reveal-item>
            <h3>Spring 2025</h3>
            <div>
              <p><strong>Capstone app deliverable:</strong> Sorty prototype with computer vision and pathway mapping.</p>
              <p class="outcome">→ Demonstrated end-to-end scan-to-recommendation flow in a working prototype.</p>
            </div>
          </article>
          <article class="timeline-compact-item" data-reveal-item>
            <h3>Summer 2025</h3>
            <div>
              <p><strong>Events expansion:</strong> Community activations with textile education and circular services.</p>
              <p class="outcome">→ Reached 2,000+ participants and diverted 4,000+ garments from landfill.</p>
            </div>
          </article>
          <article class="timeline-compact-item" data-reveal-item>
            <h3>Fall 2025</h3>
            <div>
              <p><strong>Industry partnerships:</strong> Kelowna Fashion Weekend and UBC Slow Fibre Research Cluster.</p>
              <p class="outcome">→ Built credibility with research networks and regional fashion ecosystems.</p>
            </div>
          </article>
          <article class="timeline-compact-item" data-reveal-item>
            <h3>Spring 2026</h3>
            <div>
              <p><strong>App launch:</strong> Sorty moves toward public release as a decision-support tool.</p>
              <p class="outcome">→ Opening pilot programs for municipalities and institutional partners.</p>
            </div>
          </article>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="section-heading" data-reveal="up">
          <h2>Values</h2>
          <p>DreamStill is guided by creative rigor, community accountability, and an insistence that clothing deserves better endings.</p>
        </div>
        <div class="grid four" data-reveal-group>
          <article class="card value-card" data-reveal-item>
            <h3>Innovation</h3>
            <p>Building clean technology that turns textile decisions into clear, fast, actionable next steps.</p>
          </article>
          <article class="card value-card" data-reveal-item>
            <h3>Authenticity</h3>
            <p>Showing up with honesty, imagination, and lived connection to fashion, culture, and climate work.</p>
          </article>
          <article class="card value-card" data-reveal-item>
            <h3>Environmental Stewardship</h3>
            <p>Prioritizing reuse, repair, resale, and recycling so garments stay in use longer and out of landfill.</p>
          </article>
          <article class="card value-card" data-reveal-item>
            <h3>Collaboration</h3>
            <p>Working across communities, municipalities, research networks, and industry to build circular systems.</p>
          </article>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="section-heading" data-reveal="up">
          <h2>The founders</h2>
          <p>DreamStill is led by founders bringing startup strategy, community engagement, environmental governance, and creative practice together.</p>
        </div>
        <div class="grid two" data-reveal-group>
          <article class="card founder-card">
            <img src="{{ asset('assets/img/founder-khushi.svg') }}" alt="Illustrated portrait of Khushi">
            <div>
              <h3>Khushi</h3>
              <p>The innovative Co-Founder of DreamStill Technologies with a background in startup development and strategic planning. Khushi has successfully co-led social justice and creative expression initiatives by fostering team collaboration, securing funding, and executing growth strategies.</p>
              <p>Known for accelerating non-profit growth and boosting workplace productivity by managing schedules, promoting EDI, and leveraging project management tools. Specialized in elevating organizational visibility through impactful community engagement initiatives.</p>
              <a class="linkedin-link" href="https://ca.linkedin.com/company/dreamstilll" target="_blank" rel="noopener noreferrer">View on LinkedIn →</a>
            </div>
          </article>
          <article class="card founder-card">
            <img src="{{ asset('assets/img/founder-mars.svg') }}" alt="Illustrated portrait of Mars">
            <div>
              <h3>Mars</h3>
              <p>Brazilian environmental professional, actor, poet, and co-founder working in both climate technology and Indigenous governance. She is the founder of DreamStill Technologies, where she is developing AI-driven solutions to address textile waste and advance circular systems in fashion.</p>
              <p>Alongside her entrepreneurial work, she serves as a Regulatory Engagement Coordinator with the Gitga'at First Nation, supporting environmental decision-making and navigating complex regulatory processes between industry, government, and community.</p>
              <a class="linkedin-link" href="https://ca.linkedin.com/company/dreamstilll" target="_blank" rel="noopener noreferrer">View on LinkedIn →</a>
            </div>
          </article>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="section-heading" data-reveal="up">
          <h2>Advisors &amp; supporters</h2>
          <p>Institutional supporters, mentors, and collaborators who strengthen DreamStill's work.</p>
        </div>
        <div class="team-grid" data-reveal-group>
          <article class="team-card" data-reveal-item>
            <p class="role">Research</p>
            <h3>UBC Slow Fibre Research Cluster</h3>
            <p>Academic research partnership supporting textile circularity methodology and community engagement.</p>
          </article>
          <article class="team-card" data-reveal-item>
            <p class="role">Accelerator</p>
            <h3>Buildspace</h3>
            <p>Startup development program that helped refine DreamStill's product narrative and go-to-market strategy.</p>
          </article>
          <article class="team-card" data-reveal-item>
            <p class="role">Community</p>
            <h3>Ecorise &amp; Fashion Revolution</h3>
            <p>Education and advocacy networks connecting DreamStill to circular fashion movements globally.</p>
          </article>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="vision-card" data-reveal="up">
          <span class="eyebrow" style="color: var(--lime);">Where we're headed</span>
          <h2>Scaling circular textiles from Vancouver to every city.</h2>
          <p>We're building Sorty into a platform municipalities can deploy, expanding corporate experiences across British Columbia, and deepening research partnerships to measure real diversion impact. The opportunity is massive — and we're looking for investors, grant partners, and municipal pilots who want to move fast.</p>
          <div class="hero-actions" style="margin-top: 1.5rem;">
            <a class="button lime" href="{{ url('/contact') }}">Get involved</a>
            <a class="button light" href="{{ url('/investors') }}">For investors &amp; funders</a>
          </div>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <div class="site-shell">
        <div class="footer-cta">
          <p>Ready to work together? Get in touch.</p>
          <a class="button lime attention-gentle" href="{{ url('/contact') }}">Contact DreamStill</a>
        </div>
        <div class="footer-grid">
          <div>
            <h2>Land Acknowledgement</h2>
            <p>DreamStill operates in Vancouver, BC, on the traditional, ancestral, and unceded territories of the Musqueam, Squamish, and Tsleil-Waututh Nations. We acknowledge the responsibilities that come with building climate solutions on these lands.</p>
          </div>
          <div>
            <h3>Main Menu</h3>
            <nav class="footer-links" aria-label="Footer main menu">
              <a href="{{ url('/') }}">Home</a>
              <a href="{{ url('/about') }}">About</a>
              <a href="{{ url('/app') }}">App</a>
              <a href="{{ url('/portfolio') }}">Experiences</a>
              <a href="{{ url('/contact') }}">Contact</a>
              <a href="{{ url('/investors') }}">Investors</a>
            </nav>
          </div>
          <div>
            <h3>Socials</h3>
            <nav class="footer-links" aria-label="Social links">
              <a href="https://www.instagram.com/dreamstilll" target="_blank" rel="noopener noreferrer">Instagram</a>
              <a href="https://ca.linkedin.com/company/dreamstilll" target="_blank" rel="noopener noreferrer">LinkedIn</a>
              <a href="https://www.facebook.com/people/DreamStill/61558387175265/" target="_blank" rel="noopener noreferrer">Facebook</a>
            </nav>
          </div>
        </div>
        <div class="footer-bottom">© 2026 DreamStill Technologies. Circular textile tools for a zero-waste future.</div>
      </div>
    </footer>

    <div class="mobile-cta-bar" data-reveal="up" aria-label="Quick actions">
      <a class="button coral" href="{{ url('/portfolio') }}">Book an experience</a>
      <a class="button" href="{{ url('/contact') }}">Get in touch</a>
    </div>
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
