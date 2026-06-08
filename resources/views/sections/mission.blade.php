<section class="site-shell section tight" data-reveal="up">
  <div class="mission-card" data-reveal="up">
    @if (!empty($data['eyebrow']))<span class="eyebrow">{{ $data['eyebrow'] }}</span>@endif
    @if (!empty($data['heading']))<h2>{{ $data['heading'] }}</h2>@endif
    @if (!empty($data['text']))<p>{{ $data['text'] }}</p>@endif
  </div>
</section>
