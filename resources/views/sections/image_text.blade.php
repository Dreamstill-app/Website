<section class="site-shell section" data-reveal="up">
  <div class="image-text-layout {{ ($data['image_position'] ?? 'right') === 'left' ? 'image-left' : 'image-right' }}" data-reveal="up">
    <div>
      @if (!empty($data['eyebrow']))<span class="eyebrow">{{ $data['eyebrow'] }}</span>@endif
      @if (!empty($data['heading']))<h2>{{ $data['heading'] }}</h2>@endif
      @if (!empty($data['content']))<div class="content">{!! $data['content'] !!}</div>@endif
      @if (!empty($data['buttons']))
        <div class="hero-actions" style="margin-top: 1.5rem;">
          @foreach ($data['buttons'] as $btn)
            @if (!empty($btn['url']) && !empty($btn['label']))
              <a class="button {{ $btn['style'] ?? '' }}" href="{{ $btn['url'] }}">{{ $btn['label'] }}</a>
            @endif
          @endforeach
        </div>
      @endif
    </div>
    @if (!empty($data['image']))
      <div class="image-wrapper">
        <img src="{{ Storage::url($data['image']) }}" alt="{{ $data['image_alt'] ?? '' }}">
      </div>
    @endif
  </div>
</section>
