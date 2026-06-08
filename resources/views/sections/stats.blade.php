<section class="site-shell section tight" data-reveal="up">
  @if (!empty($data['heading']) || !empty($data['subtext']))
    <div class="section-heading" data-reveal="up">
      @if (!empty($data['heading']))<h2>{{ $data['heading'] }}</h2>@endif
      @if (!empty($data['subtext']))<p>{{ $data['subtext'] }}</p>@endif
    </div>
  @endif
  @php $cols = $data['columns'] ?? 4; @endphp
  <div class="impact-grid" data-reveal-group>
    @foreach (($data['items'] ?? []) as $item)
      <article class="impact-card" data-reveal-item>
        <span class="impact-number">{{ $item['number'] ?? '' }}</span>
        <p>{{ $item['label'] ?? '' }}</p>
      </article>
    @endforeach
  </div>
  @if (!empty($data['source_note']))
    <p class="source-note">{{ $data['source_note'] }}</p>
  @endif
</section>
