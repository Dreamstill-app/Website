<x-site-layout page-title="DreamStill Technologies | Circular Textile Clean Technology">
    <div class="top-ribbon">Clean technology for textile circularity • Vancouver, BC • Sort better, waste less</div>
    <header class="site-header">
        <div class="site-shell nav-card">
            <a class="brand" href="{{ url('/') }}" aria-label="DreamStill home">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="DreamStill Technologies">
            </a>
            <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="main-navigation">Menu</button>
            <nav class="nav-links" id="main-navigation" data-nav-links aria-label="Main menu">
                <a class="active" href="{{ url('/') }}">Home</a>
                <a href="{{ url('/about') }}">About</a>
                <a href="{{ url('/app') }}">App</a>
                <a href="{{ url('/portfolio') }}">Experiences</a>
            </nav>
            <a class="button coral" href="{{ url('/contact') }}">Let's talk</a>
        </div>
    </header>

    <main>
        <section class="site-shell hero">
            <div>
                <span class="eyebrow">DreamStill Technologies</span>
                <h1 class="headline">Clean tech for <span>clothing with a future.</span></h1>
                <p class="lede">We help people, communities, and industries see the true value of clothing through AI-powered decision support, circular fashion events, and textile recovery education.</p>
                <div class="hero-actions">
                    <a class="button lime" href="{{ url('/app') }}">Try the sorting app</a>
                    <a class="button light" href="{{ url('/portfolio') }}">Book an experience</a>
                    <a class="button" href="{{ url('/contact?interest=partnership') }}">Partner with us</a>
                </div>
                <p class="hero-note">From garment scans to community swaps, DreamStill makes the next best use feel joyful, simple, and local.</p>
            </div>

            <div class="slider" data-slider aria-label="DreamStill feature slider">
                <div class="slides" data-slides>
                    <article class="slide">
                        <div class="slide-frame">
                            <img src="{{ asset('assets/img/app-preview.svg') }}" alt="Sorty mobile app user interface preview">
                            <div class="slide-caption">
                                <h2>Scan your clothes in seconds</h2>
                                <p>Sorty scans a garment, recommends a pathway, and points users to nearby circular options.</p>
                            </div>
                        </div>
                    </article>
                    <article class="slide">
                        <div class="slide-frame">
                            <img src="{{ asset('assets/img/event-activation.svg') }}" alt="Illustration of DreamStill circular fashion event">
                            <div class="slide-caption">
                                <h2>Experience sustainable fashion</h2>
                                <p>Monthly activations, clothing swaps, repair workshops, community dye baths, and styling nights.</p>
                            </div>
                        </div>
                    </article>
                    <article class="slide">
                        <div class="slide-frame">
                            <img src="{{ asset('assets/img/textile-map.svg') }}" alt="Illustrated map of nearby textile circularity locations">
                            <div class="slide-caption">
                                <h2>Find local circular options near you</h2>
                                <p>A local pathway map helps residents find repair, resale, donation, consignment, and recycling options.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="slider-controls" aria-label="Slider controls">
                    <button class="slider-dot active" type="button" data-slide-dot aria-label="Show app preview" aria-pressed="true"></button>
                    <button class="slider-dot" type="button" data-slide-dot aria-label="Show event photos" aria-pressed="false"></button>
                    <button class="slider-dot" type="button" data-slide-dot aria-label="Show map" aria-pressed="false"></button>
                </div>
            </div>
        </section>

        <section class="site-shell section tight">
            <div class="mission-card">
                <span class="eyebrow">Our mission</span>
                <h2>To equip people and industries with tools and skills to see the true value of clothing.</h2>
                <p>DreamStill drives a collective movement towards a zero-waste future of textiles by connecting clean technology, circular infrastructure, and community imagination.</p>
            </div>
        </section>

        <section class="site-shell section tight">
            <div class="section-heading">
                <h2>Our impact so far</h2>
                <p>Real numbers from community activations, pilots, and education — proof that circular fashion can scale.</p>
            </div>
            <div class="impact-grid">
                <article class="impact-card">
                    <span class="impact-number">40+</span>
                    <p>events hosted</p>
                </article>
                <article class="impact-card">
                    <span class="impact-number">2,000</span>
                    <p>participants reached</p>
                </article>
                <article class="impact-card">
                    <span class="impact-number">4,000</span>
                    <p>garments diverted</p>
                </article>
                <article class="impact-card">
                    <span class="impact-number">4</span>
                    <p>events we spoke at</p>
                </article>
            </div>
        </section>

        <section class="site-shell section">
            <div class="section-heading">
                <h2>CMS migration in progress</h2>
                <p>This public homepage is now running inside Laravel. Next, the remaining pages will move into database-driven templates and editable admin sections.</p>
            </div>
            <div class="grid two">
                <article class="card solution-card">
                    <span class="eyebrow">Admin foundation</span>
                    <h3>Laravel + Filament + Breeze</h3>
                    <p>Email/password auth and the admin panel foundation are installed so DreamStill can move from static editing to a browser-based CMS workflow.</p>
                </article>
                <article class="card solution-card">
                    <span class="eyebrow">Next phase</span>
                    <h3>Database-driven pages</h3>
                    <p>Page records, reusable sections, settings, and APIs are the next layer so the website and future Flutter app can share one backend.</p>
                </article>
            </div>
        </section>
    </main>
</x-site-layout>
