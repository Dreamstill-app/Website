<section class="site-shell section tight" data-reveal="up">
  @if (!empty($data['heading']) || !empty($data['subtext']))
    <div class="section-heading" data-reveal="up">
      @if (!empty($data['heading']))<h2>{{ $data['heading'] }}</h2>@endif
      @if (!empty($data['subtext']))<p>{{ $data['subtext'] }}</p>@endif
    </div>
  @endif
  <div class="timeline-compact" aria-label="Timeline">
    @foreach (($data['items'] ?? []) as $item)
      <article class="timeline-compact-item" data-reveal-item>
        <h3>{{ $item['period'] ?? '' }}</h3>
        <div>
          @if (!empty($item['title']))<p><strong>{{ $item['title'] }}</strong></p>@endif
          @if (!empty($item['text']))<div>{!! $item['text'] !!}</div>@endif
          @if (!empty($item['outcome']))<p class="outcome">→ {{ $item['outcome'] }}</p>@endif
        </div>
      </article>
    @endforeach
  </div>
</section>
