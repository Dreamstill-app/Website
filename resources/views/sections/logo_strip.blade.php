<section class="site-shell section" data-reveal="up">
  @if (!empty($data['heading']))
    <div class="section-heading">
      <h2>{{ $data['heading'] }}</h2>
    </div>
  @endif
  @if (!empty($data['tags']))
    <div class="who-we-work-with">
      @foreach ($data['tags'] as $tag)
        <span class="audience-tag">{{ $tag['label'] ?? $tag }}</span>
      @endforeach
    </div>
  @endif
  @if (!empty($data['partners_heading']))
    <div class="section-heading" style="margin-top: 2rem;">
      <h2>{{ $data['partners_heading'] }}</h2>
    </div>
  @endif
  @if (!empty($data['partners']))
    <div class="logo-strip" data-reveal-group aria-label="Partner logos">
      @foreach ($data['partners'] as $partner)
        @if (!empty($partner['url']))
          <a class="partner-logo" href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer">
            @if (!empty($partner['image']))
              <img src="{{ Storage::url($partner['image']) }}" alt="{{ $partner['label'] ?? '' }}">
            @else
              <span class="logo-text">{{ $partner['label'] ?? '' }}</span>
            @endif
          </a>
        @else
          <div class="partner-logo">
            @if (!empty($partner['image']))
              <img src="{{ Storage::url($partner['image']) }}" alt="{{ $partner['label'] ?? '' }}">
            @else
              <span class="logo-text">{{ $partner['label'] ?? '' }}</span>
            @endif
          </div>
        @endif
      @endforeach
    </div>
  @endif
</section>
