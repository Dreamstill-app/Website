<section class="site-shell hero" data-reveal="hero-left">
  <div>
    @if (!empty($data['eyebrow']))
      <span class="eyebrow">{{ $data['eyebrow'] }}</span>
    @endif
    @if (!empty($data['headline']))
      <h1 class="headline">{!! $data['headline'] !!}</h1>
    @endif
    @if (!empty($data['lede']))
      <p class="lede">{{ $data['lede'] }}</p>
    @endif
    @if (!empty($data['buttons']))
      <div class="hero-actions" data-reveal="up">
        @foreach ($data['buttons'] as $btn)
          @if (!empty($btn['url']) && !empty($btn['label']))
            <a class="button {{ $btn['style'] ?? '' }}" href="{{ $btn['url'] }}">{{ $btn['label'] }}</a>
          @endif
        @endforeach
      </div>
    @endif
    @if (!empty($data['hero_note']))
      <p class="hero-note">{{ $data['hero_note'] }}</p>
    @endif
  </div>

  @if (!empty($data['slides']))
    <div class="slider" data-slider aria-label="Feature slider">
      <div class="slides" data-slides>
        @foreach ($data['slides'] as $slide)
          <article class="slide">
            <div class="slide-frame">
              @if (!empty($slide['image']))
                <img src="{{ Storage::url($slide['image']) }}" alt="{{ $slide['image_alt'] ?? '' }}">
              @endif
              <div class="slide-caption">
                @if (!empty($slide['heading']))<h2>{{ $slide['heading'] }}</h2>@endif
                @if (!empty($slide['text']))<p>{{ $slide['text'] }}</p>@endif
              </div>
            </div>
          </article>
        @endforeach
      </div>
      <div class="slider-controls" aria-label="Slider controls">
        @foreach ($data['slides'] as $i => $slide)
          <button class="slider-dot {{ $i === 0 ? 'active' : '' }}" type="button" data-slide-dot aria-pressed="{{ $i === 0 ? 'true' : 'false' }}"></button>
        @endforeach
      </div>
    </div>
  @endif
</section>
