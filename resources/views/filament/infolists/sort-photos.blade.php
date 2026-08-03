@php
    /** @var \App\Models\Sort $record */
    $photos = collect(['front' => 'Front', 'back' => 'Back', 'tag' => 'Brand tag'])
        ->map(fn (string $label, string $type) => [
            'type' => $type,
            'label' => $label,
            'url' => $record->images->firstWhere('type', $type)
                ? route('admin.sort-image', ['sort' => $record->id, 'type' => $type])
                : null,
        ])
        ->values();
    $available = $photos->whereNotNull('url')->count();
@endphp

<div>
    <p style="margin-bottom: 0.75rem; font-size: 0.875rem; opacity: 0.6;">
        {{ $available }} {{ Str::plural('photo', $available) }} uploaded — scroll sideways, click any photo to open it full size
    </p>

    <div style="display: flex; gap: 1rem; overflow-x: auto; padding-bottom: 0.5rem; scroll-snap-type: x mandatory;">
        @foreach ($photos as $photo)
            <figure style="flex: 0 0 auto; width: 16rem; margin: 0; scroll-snap-align: start;">
                @if ($photo['url'])
                    <a href="{{ $photo['url'] }}" target="_blank" rel="noopener"
                       title="Open {{ strtolower($photo['label']) }} photo full size">
                        <img src="{{ $photo['url'] }}"
                             alt="{{ $photo['label'] }} photo"
                             style="height: 14rem; width: 16rem; object-fit: cover; border-radius: 0.75rem; display: block; box-shadow: 0 0 0 1px rgba(0,0,0,0.08);" />
                    </a>
                @else
                    <div style="display: flex; height: 14rem; width: 16rem; align-items: center; justify-content: center; border-radius: 0.75rem; background: rgba(128,128,128,0.08); font-size: 0.875rem; opacity: 0.5;">
                        No {{ strtolower($photo['label']) }} photo
                    </div>
                @endif
                <figcaption style="margin-top: 0.4rem; text-align: center; font-size: 0.75rem; font-weight: 500; opacity: 0.75;">
                    {{ $photo['label'] }}
                </figcaption>
            </figure>
        @endforeach
    </div>
</div>
