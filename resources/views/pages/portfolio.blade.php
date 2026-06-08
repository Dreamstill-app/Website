@extends('layouts.site-page')

@php($pageTitle = 'Experiences | DreamStill Technologies')

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
          <a href="{{ url('/about') }}">About</a>
          <a href="{{ url('/app') }}">App</a>
          <a class="active" href="{{ url('/portfolio') }}">Experiences</a>
        </nav>
        <a class="button coral" href="{{ url('/contact') }}">Let's talk</a>
      </div>
    </header>

    <main class="experience-page">
      <section class="site-shell experience-hero" data-reveal="hero-left">
        <div class="experience-hero-copy">
          <span class="eyebrow">DreamStill Experiences</span>
          <h1>Corporate Experiences That Inspire Creativity and Connection.</h1>
          <p>DreamStill designs unforgettable sustainability and creativity experiences for teams, conferences, retreats, and company celebrations across British Columbia.</p>
          <div class="hero-actions" data-reveal="up">
            <a class="button coral" href="#book-discovery">Book a Discovery Call</a>
            <a class="button light" href="#past-experiences">View Past Events</a>
          </div>
        </div>
        <div class="experience-hero-media" aria-label="DreamStill creative sustainability experience">
          <img src="{{ asset('assets/img/event-activation.svg') }}" alt="DreamStill event activation with circular fashion materials">
          <div class="media-caption">
            <span>Creative climate experiences</span>
            <strong>Designed for teams, retreats, conferences, and community moments.</strong>
          </div>
        </div>
      </section>

      <section class="site-shell section experience-intro" data-reveal="up">
        <div class="experience-intro-text">
          <span class="eyebrow">For teams and communities</span>
          <h2>Not another workshop. A memorable shared experience.</h2>
        </div>
        <p>For community attendees, DreamStill events feel warm, welcoming, and creative. For corporate clients, they become premium team-building experiences with purpose, beauty, and conversation built in.</p>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="card">
          <span class="eyebrow">Ideal client</span>
          <h3>Who this is for</h3>
          <p>DreamStill experiences are designed for teams of 10–100 people at companies, nonprofits, and public institutions that want a sustainability activation with real substance — not a slide deck. Ideal clients include HR and People &amp; Culture teams planning offsites, conference organizers seeking tactile activations, and organizations celebrating milestones with purpose-driven programming. If your team cares about climate but needs something creative and hands-on, this is for you.</p>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="experience-card-grid" data-reveal-group>
          <article class="experience-offer-card" data-reveal-item>
            <span>01</span>
            <h2>Team Building</h2>
            <p>Hands-on creative experiences using repurposed textile materials.</p>
            <small>Teams leave with a handmade item and a circular fashion action plan they can implement immediately. Collaborative making, guided reflection, and tangible takeaways.</small>
          </article>
          <article class="experience-offer-card" data-reveal-item>
            <span>02</span>
            <h2>Wellness &amp; Climate Resilience</h2>
            <p>Mindfulness and meaningful conversations for modern workplaces.</p>
            <small>Participants gain practical tools for climate anxiety and leave with a personal sustainability commitment. A softer, emotionally intelligent approach to climate action.</small>
          </article>
          <article class="experience-offer-card" data-reveal-item>
            <span>03</span>
            <h2>Conference Activations</h2>
            <p>Interactive installations and drop-in experiences for up to 100 participants.</p>
            <small>Attendees engage with circular fashion in under 15 minutes and leave with a memorable, shareable moment. Beautiful, tactile activations that don't slow down the room.</small>
          </article>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="section-heading experience-heading" data-reveal="up">
          <h2>Why DreamStill</h2>
          <p>Not a generic sustainability workshop — a creative, tactile, community-rooted experience.</p>
        </div>
        <div class="grid three" data-reveal-group>
          <article class="card value-card" data-reveal-item>
            <h3>Creative &amp; tactile</h3>
            <p>Participants work with real textile materials — mending, dyeing, repurposing — not just listening to presentations.</p>
          </article>
          <article class="card value-card" data-reveal-item>
            <h3>Community rooted</h3>
            <p>Built from 40+ real community events. Our facilitators bring lived experience, not corporate talking points.</p>
          </article>
          <article class="card value-card" data-reveal-item>
            <h3>Measurable outcomes</h3>
            <p>Every experience includes a circular fashion action plan and post-event impact summary for internal reporting.</p>
          </article>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up" id="past-experiences">
        <div class="section-heading experience-heading" data-reveal="up">
          <h2>Past Experiences</h2>
          <p>Real activations from community gatherings to corporate retreats across British Columbia.</p>
        </div>
        <div class="experience-masonry" data-reveal-group>
          <article class="masonry-item tall" data-reveal-item>
            <img src="{{ asset('assets/img/story-summer-2025.svg') }}" alt="DreamStill summer textile storytelling event">
            <div>
              <span>Retreat format</span>
              <h3>Textile storytelling circles</h3>
            </div>
          </article>
          <article class="masonry-item" data-reveal-item>
            <img src="{{ asset('assets/img/story-spring-2026.svg') }}" alt="DreamStill repurposed material lab workshop">
            <div>
              <span>Team studio</span>
              <h3>Repurposed material labs</h3>
            </div>
          </article>
          <article class="masonry-item" data-reveal-item>
            <img src="{{ asset('assets/img/story-fall-2025.svg') }}" alt="DreamStill conference circular fashion activation">
            <div>
              <span>Conference activation</span>
              <h3>Drop-in circular fashion moments</h3>
            </div>
          </article>
          <article class="masonry-item wide" data-reveal-item>
            <img src="{{ asset('assets/img/story-summer-2024.svg') }}" alt="DreamStill community creative reuse event">
            <div>
              <span>Community gathering</span>
              <h3>Creative reuse and connection</h3>
            </div>
          </article>
          <article class="masonry-item" data-reveal-item>
            <img src="{{ asset('assets/img/story-spring-2025.svg') }}" alt="DreamStill mindful mending wellness session">
            <div>
              <span>Wellness session</span>
              <h3>Mindful mending conversations</h3>
            </div>
          </article>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="section-heading experience-heading" data-reveal="up">
          <h2>Trusted for thoughtful, creative sustainability programming.</h2>
          <p>DreamStill designs with the polish corporate clients expect and the warmth community attendees remember.</p>
        </div>
        <div class="testimonial-grid">
          <blockquote>
            <p>"DreamStill created the rare kind of team experience that felt thoughtful, beautiful, and genuinely connective."</p>
            <cite>Sarah Chen, People &amp; Culture Lead — Vancouver tech company retreat</cite>
          </blockquote>
          <blockquote>
            <p>"Our attendees stayed longer than expected because the activation felt calm, tactile, and different from everything else in the room."</p>
            <cite>James Okonkwo, Conference Producer — BC Sustainability Summit</cite>
          </blockquote>
          <blockquote>
            <p>"The session made climate action feel personal without making our team feel overwhelmed. It was creative, warm, and memorable."</p>
            <cite>Emily Torres, Operations Director — Corporate team building, 35 participants</cite>
          </blockquote>
        </div>
        <div class="logo-cloud" aria-label="Organizations and partners">
          <a href="https://slowfashionseason.org/" target="_blank" rel="noopener noreferrer"><span>Slow Fashion Season</span></a>
          <a href="https://www.loveyourclothes.org.uk/" target="_blank" rel="noopener noreferrer"><span>Love Your Clothes</span></a>
          <a href="https://www.fashionrevolution.org/" target="_blank" rel="noopener noreferrer"><span>Fashion Revolution Week</span></a>
          <a href="https://ecorise.org/" target="_blank" rel="noopener noreferrer"><span>Ecorise</span></a>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="booking-prompt" data-reveal="up">
          <div>
            <h2>Ready to book?</h2>
            <p>Schedule a free 30-minute discovery call to discuss your team, goals, and the perfect experience format.</p>
          </div>
          <a class="button light" href="#book-discovery">Book a Discovery Call</a>
        </div>
      </section>

      <section class="site-shell section pricing-section" data-reveal="up">
        <div class="pricing-panel" data-reveal="up">
          <div class="pricing-copy">
            <span class="eyebrow">Pricing guidance</span>
            <h2>Premium experiences, shaped around your team.</h2>
            <p>Every DreamStill experience is customized to your team and goals. All prices in CAD.</p>
          </div>
          <div class="pricing-grid">
            <article>
              <span>Small Teams</span>
              <h3>10–20</h3>
              <p>Starting at $2,500 CAD</p>
              <p class="pricing-inclusions">Includes facilitation, materials, setup, and a post-event summary.</p>
            </article>
            <article>
              <span>Growing Teams</span>
              <h3>20–50</h3>
              <p>Starting at $4,000 CAD</p>
              <p class="pricing-inclusions">Includes facilitation, materials, setup, take-home items, and follow-up resources.</p>
            </article>
            <article>
              <span>Large Activations</span>
              <h3>50–100</h3>
              <p>Custom Quote (CAD)</p>
              <p class="pricing-inclusions">Includes full production, multi-station setup, branding integration, and impact reporting.</p>
            </article>
          </div>
        </div>
        <div class="inclusions-panel" data-reveal="up">
          <h3>What's included in every experience</h3>
          <div class="inclusions-grid">
            <div class="inclusion-item">Expert facilitation by DreamStill team</div>
            <div class="inclusion-item">All textile materials and tools provided</div>
            <div class="inclusion-item">Venue setup and teardown</div>
            <div class="inclusion-item">Circular fashion action plan for participants</div>
            <div class="inclusion-item">Post-event impact summary for your team</div>
            <div class="inclusion-item">Travel within British Columbia included</div>
          </div>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up" id="book-discovery">
        <div class="booking-layout">
          <div>
            <span class="eyebrow">Book a discovery call</span>
            <h2>Let's Create Something Memorable.</h2>
            <p>We'll discuss your event, team size, goals, and build an experience your people will actually remember.</p>
          </div>
          <div class="calendly-frame">
            <iframe title="Book a DreamStill discovery call" src="https://calendly.com/dreamstill/discovery-call?hide_event_type_details=1&hide_gdpr_banner=1"></iframe>
          </div>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="contact-layout" data-reveal="up">
          <form class="contact-form" data-corporate-form>
            <span class="eyebrow">Corporate inquiry</span>
            <h2>Prefer a form? Tell us about your event.</h2>
            <p class="form-note">We respond within 2 business days with a proposal or calendar link.</p>
            <div class="form-row">
              <label for="corp-name">Name</label>
              <input id="corp-name" name="name" type="text" autocomplete="name" required>
            </div>
            <div class="form-row">
              <label for="corp-email">Email</label>
              <input id="corp-email" name="email" type="email" autocomplete="email" required>
            </div>
            <div class="form-row">
              <label for="corp-company">Company / Organization</label>
              <input id="corp-company" name="company" type="text" required>
            </div>
            <div class="form-row">
              <label for="corp-team-size">Estimated team size</label>
              <select id="corp-team-size" name="team-size">
                <option>10–20</option>
                <option>20–50</option>
                <option>50–100</option>
                <option>100+</option>
              </select>
            </div>
            <input type="hidden" name="interest" value="Corporate experience booking">
            <div class="form-row">
              <label for="corp-message">Tell us about your event</label>
              <textarea id="corp-message" name="message" placeholder="Team offsite, conference activation, retreat — tell us the date, location, and goals." required></textarea>
            </div>
            <button class="button coral" type="submit">Submit inquiry</button>
          </form>
          <aside>
            <article class="card contact-card" data-reveal-item>
              <span class="eyebrow">Quick contact</span>
              <h3>Email us directly</h3>
              <p><a href="mailto:info@dreamstill.ca">info@dreamstill.ca</a></p>
              <p><a href="tel:+17788888541">778-888-8541</a></p>
            </article>
          </aside>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="faq-layout">
          <div>
            <span class="eyebrow">FAQ</span>
            <h2>Everything you need to know before we design your experience.</h2>
          </div>
          <div class="faq-list">
            <details>
              <summary>What kinds of companies do you work with?</summary>
              <p>Any. We can design experiences for startups, enterprise teams, public institutions, nonprofits, conferences, and community groups.</p>
            </details>
            <details>
              <summary>How many participants can you accommodate?</summary>
              <p>Up to 100 participants, depending on the format, venue, materials, and facilitation needs.</p>
            </details>
            <details>
              <summary>Can you travel?</summary>
              <p>Yes. DreamStill can travel across British Columbia and discuss location needs during discovery.</p>
            </details>
            <details>
              <summary>Can experiences be customized?</summary>
              <p>Yes. Every experience can be customized around your team, audience, goals, materials, and desired tone.</p>
            </details>
            <details>
              <summary>Do participants need prior experience?</summary>
              <p>No. Experiences are beginner-friendly, but we can customize the format for higher skilled people if you wish.</p>
            </details>
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
      <a class="button coral" href="#book-discovery">Book an experience</a>
      <a class="button" href="{{ url('/contact') }}">Get in touch</a>
    </div>
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
