<section class="site-shell section" data-reveal="up">
  @if (!empty($data['heading']))
    <div class="section-heading" data-reveal="up">
      <h2>{{ $data['heading'] }}</h2>
    </div>
  @endif
  <div class="card">
    @if (!empty($data['content']))
      {!! $data['content'] !!}
    @endif
  </div>
</section>
