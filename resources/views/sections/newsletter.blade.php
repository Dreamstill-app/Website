<section class="site-shell section tight" data-reveal="up">
  <div class="newsletter-card" data-reveal="up">
    <div>
      @if (!empty($data['eyebrow']))<span class="eyebrow" style="color: var(--lime);">{{ $data['eyebrow'] }}</span>@endif
      @if (!empty($data['heading']))<h2>{{ $data['heading'] }}</h2>@endif
      @if (!empty($data['text']))<p>{{ $data['text'] }}</p>@endif
    </div>
    <form class="newsletter-form" data-newsletter-form>
      <label class="sr-only" for="newsletter-email">Email address</label>
      <input id="newsletter-email" name="email" type="email" placeholder="{{ $data['placeholder'] ?? 'your@email.com' }}" autocomplete="email" required>
      <button class="button lime" type="submit">{{ $data['button_label'] ?? 'Subscribe' }}</button>
    </form>
  </div>
</section>
