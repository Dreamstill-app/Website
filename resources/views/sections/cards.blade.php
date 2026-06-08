<section class="site-shell section" data-reveal="up">
  @if (!empty($data['heading']) || !empty($data['subtext']))
    <div class="section-heading" data-reveal="up">
      @if (!empty($data['heading']))<h2>{{ $data['heading'] }}</h2>@endif
      @if (!empty($data['subtext']))<p>{{ $data['subtext'] }}</p>@endif
    </div>
  @endif
  @php $cols = $data['columns'] ?? 2; @endphp
  <div class="grid {{ $cols === 3 ? 'three' : ($cols === 4 ? 'four' : 'two') }}" data-reveal-group>
    @foreach (($data['items'] ?? []) as $item)
      <article class="card {{ $data['card_class'] ?? 'solution-card' }}" data-reveal-item>
        @if (!empty($item['eyebrow']))<span class="eyebrow">{{ $item['eyebrow'] }}</span>@endif
        @if (!empty($item['image']))
          <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['image_alt'] ?? '' }}" class="card-image">
        @endif
        @if (!empty($item['heading']))<h3>{{ $item['heading'] }}</h3>@endif
        @if (!empty($item['text']))<div class="card-text">{!! $item['text'] !!}</div>@endif
        @if (!empty($item['link_url']) && !empty($item['link_label']))
          <a href="{{ $item['link_url'] }}" {{ str_starts_with($item['link_url'], 'http') ? 'target="_blank" rel="noopener noreferrer"' : '' }}>{{ $item['link_label'] }} →</a>
        @endif
      </article>
    @endforeach
  </div>
</section>
