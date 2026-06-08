<section class="site-shell page-hero" data-reveal="hero-left">
  <div class="@if(!empty($data['slider_style'])) about-hero-slider @else page-hero-card @endif" @if(!empty($data['slider_style'])) data-slider aria-label="Page hero" @endif>
    @if(!empty($data['slider_style']))
      <div class="slides" data-slides>
    @endif
    @foreach (($data['slides'] ?? [['eyebrow' => $data['eyebrow'] ?? '', 'heading' => $data['heading'] ?? '', 'text' => $data['text'] ?? '', 'image' => $data['image'] ?? '', 'image_alt' => $data['image_alt'] ?? '']]) as $i => $slide)
      <article class="{{ !empty($data['slider_style']) ? 'about-hero-slide' : '' }}">
        <div>
          @if (!empty($slide['eyebrow']))<span class="eyebrow">{{ $slide['eyebrow'] }}</span>@endif
          <h1>{{ $slide['heading'] ?? '' }}</h1>
          @if (!empty($slide['text']))<p>{{ $slide['text'] }}</p>@endif
          @if (!empty($data['buttons']) && $i === 0)
            <div class="hero-actions" data-reveal="up">
              @foreach ($data['buttons'] as $btn)
                @if (!empty($btn['url']) && !empty($btn['label']))
                  <a class="button {{ $btn['style'] ?? '' }}" href="{{ $btn['url'] }}">{{ $btn['label'] }}</a>
                @endif
              @endforeach
            </div>
          @endif
        </div>
        @if (!empty($slide['image']))
          <img src="{{ Storage::url($slide['image']) }}" alt="{{ $slide['image_alt'] ?? '' }}">
        @endif
      </article>
    @endforeach
    @if(!empty($data['slider_style']))
      </div>
      <div class="slider-controls" aria-label="Slider controls">
        @foreach (($data['slides'] ?? []) as $i => $s)
          <button class="slider-dot {{ $i === 0 ? 'active' : '' }}" type="button" data-slide-dot aria-pressed="{{ $i === 0 ? 'true' : 'false' }}"></button>
        @endforeach
      </div>
    @endif
    @if(!empty($data['badge']) && empty($data['slider_style']))
      <div class="hero-badge" data-reveal="accent">{{ $data['badge'] }}</div>
    @endif
  </div>
</section>
