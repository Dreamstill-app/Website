<section class="site-shell section tight" data-reveal="up">
  <div class="contact-layout" data-reveal="up">
    <div class="card contact-card">
      @if (!empty($data['eyebrow']))<span class="eyebrow">{{ $data['eyebrow'] }}</span>@endif
      @if (!empty($data['heading']))<h2>{{ $data['heading'] }}</h2>@endif
      @if (!empty($data['text']))<p>{{ $data['text'] }}</p>@endif
      @if (!empty($data['buttons']))
        <div class="hero-actions" data-reveal="up">
          @foreach ($data['buttons'] as $btn)
            @if (!empty($btn['url']) && !empty($btn['label']))
              <a class="button {{ $btn['style'] ?? '' }}" href="{{ $btn['url'] }}">{{ $btn['label'] }}</a>
            @endif
          @endforeach
        </div>
      @endif
    </div>
    @if (!empty($data['contact_items']))
      <div class="card">
        <ul class="contact-list">
          @foreach ($data['contact_items'] as $ci)
            <li>
              @if (!empty($ci['url']))<a href="{{ $ci['url'] }}">{{ $ci['label'] ?? $ci['url'] }}</a>@else{{ $ci['label'] ?? '' }}@endif
            </li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
</section>
