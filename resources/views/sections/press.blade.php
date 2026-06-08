<section class="site-shell section" data-reveal="up">
  @if (!empty($data['heading']) || !empty($data['subtext']))
    <div class="section-heading" data-reveal="up">
      @if (!empty($data['heading']))<h2>{{ $data['heading'] }}</h2>@endif
      @if (!empty($data['subtext']))<p>{{ $data['subtext'] }}</p>@endif
    </div>
  @endif
  <div class="press-grid" data-reveal-group>
    @foreach (($data['items'] ?? []) as $item)
      <article class="press-card" data-reveal-item>
        @if (!empty($item['eyebrow']))<span class="eyebrow">{{ $item['eyebrow'] }}</span>@endif
        @if (!empty($item['image']))
          <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['image_alt'] ?? '' }}" class="press-card-image">
        @endif
        @if (!empty($item['heading']))<h3>{{ $item['heading'] }}</h3>@endif
        @if (!empty($item['text']))<div>{!! $item['text'] !!}</div>@endif
        @if (!empty($item['link_url']) && !empty($item['link_label']))
          <a href="{{ $item['link_url'] }}" target="_blank" rel="noopener noreferrer">{{ $item['link_label'] }} →</a>
        @endif
      </article>
    @endforeach
  </div>
</section>
