@extends('layouts.site-page')

@php($pageTitle = 'Contact | DreamStill Technologies')

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
          <a href="{{ url('/portfolio') }}">Experiences</a>
        </nav>
        <a class="button coral" href="{{ url('/contact') }}">Let's talk</a>
      </div>
    </header>

    <main>
      <section class="site-shell page-hero" data-reveal="hero-left">
        <div class="page-hero-card" data-reveal="up">
          <div>
            <span class="eyebrow">Contact</span>
            <h1>Questions, inquiries, pilots, or circular fashion ideas?</h1>
            <p>Reach out and tell us what you are building. DreamStill would be happy to explore app partnerships, textile recovery education, community activations, and circular fashion event production.</p>
          </div>
          <div class="hero-badge" data-reveal="accent">we respond within 2 business days</div>
        </div>
      </section>

      <section class="site-shell section" data-reveal="up">
        <div class="contact-layout" data-reveal="up">
          <form class="contact-form" data-contact-form>
            <span class="eyebrow">Send a note</span>
            <h2>Contact Form</h2>
            <p>Complete the form below and we'll get back to you within <strong>2 business days</strong>. After submitting, you'll receive an email from our team to discuss next steps — whether that's a discovery call, a pilot proposal, or a direct answer to your question.</p>
            <div class="form-row">
              <label for="name">Name</label>
              <input id="name" name="name" type="text" autocomplete="name" required>
            </div>
            <div class="form-row">
              <label for="email">Email</label>
              <input id="email" name="email" type="email" autocomplete="email" required>
            </div>
            <div class="form-row">
              <label for="interest">I am interested in</label>
              <select id="interest" name="interest">
                <option>Sorty app pilot</option>
                <option>Request a pilot</option>
                <option>Corporate experience booking</option>
                <option>Circular fashion event</option>
                <option>Industry partnership</option>
                <option>Investment or grant inquiry</option>
                <option>Media or speaking</option>
                <option>General inquiry</option>
              </select>
            </div>
            <div class="form-row">
              <label for="message">Message</label>
              <textarea id="message" name="message" placeholder="Tell us about your idea, question, or partnership opportunity." required></textarea>
            </div>
            <button class="button coral" type="submit">Send message</button>
            <p class="form-note">Your inquiry will be categorized and routed to the right team member based on your selection above.</p>
          </form>

          <aside class="grid" data-reveal-group>
            <article class="card contact-card" data-reveal-item>
              <span class="eyebrow">Contact information</span>
              <h2>Let's connect.</h2>
              <p>Use the details below for questions or inquiries about DreamStill, Sorty, and circular fashion activations.</p>
              <ul class="contact-list">
                <li><a href="tel:+17788888541">778-888-8541</a></li>
                <li><a href="mailto:info@dreamstill.ca">info@dreamstill.ca</a></li>
              </ul>
            </article>
            <article class="card" data-reveal-item>
              <span class="eyebrow">Prefer to book directly?</span>
              <div class="calendly-link-card">
                <h3>Schedule a discovery call</h3>
                <p>Pick a time that works for you — no form required.</p>
                <a class="button coral" href="https://calendly.com/dreamstill/discovery-call" target="_blank" rel="noopener noreferrer">Book on Calendly</a>
              </div>
            </article>
            <article class="card" data-reveal-item>
              <span class="eyebrow">Socials</span>
              <div class="social-grid">
                <a href="https://www.instagram.com/dreamstilll" target="_blank" rel="noopener noreferrer">Instagram</a>
                <a href="https://ca.linkedin.com/company/dreamstilll" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                <a href="https://www.facebook.com/people/DreamStill/61558387175265/" target="_blank" rel="noopener noreferrer">Facebook</a>
              </div>
              <div class="whatsapp-note">
                <strong>Community WhatsApp group:</strong> Join our community chat for circular fashion updates, event announcements, and local swap info.
                <a class="button light" href="https://chat.whatsapp.com/KcDCExBU7fj6HTG8Xhsups" target="_blank" rel="noopener noreferrer" style="margin-top: 0.75rem; display: inline-flex;">Join WhatsApp group</a>
              </div>
            </article>
          </aside>
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
    <script>
      (function () {
        var params = new URLSearchParams(window.location.search);
        var interest = params.get("interest");
        var select = document.getElementById("interest");
        if (interest && select) {
          var map = {
            pilot: "Sorty app pilot",
            partnership: "Industry partnership",
            investment: "Investment or grant inquiry",
            corporate: "Corporate experience booking",
          };
          if (map[interest]) select.value = map[interest];
        }
      })();
    </script>
@endsection
