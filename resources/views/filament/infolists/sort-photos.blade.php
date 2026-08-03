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
    $available = $photos->whereNotNull('url')->values();
@endphp

<div
    x-data="{
        open: false,
        current: 0,
        photos: @js($available->map(fn ($p) => ['url' => $p['url'], 'label' => $p['label']])->all()),
        show(index) { this.current = index; this.open = true; },
        close() { this.open = false; },
        next() { this.current = (this.current + 1) % this.photos.length; },
        prev() { this.current = (this.current - 1 + this.photos.length) % this.photos.length; },
    }"
    x-on:keydown.escape.window="close()"
    x-on:keydown.arrow-right.window="if (open) next()"
    x-on:keydown.arrow-left.window="if (open) prev()"
>
    <p style="margin-bottom: 0.75rem; font-size: 0.875rem; opacity: 0.6;">
        {{ $available->count() }} {{ Str::plural('photo', $available->count()) }} uploaded — click a photo to enlarge
    </p>

    {{-- Thumbnail strip --}}
    <div style="display: flex; gap: 1rem; overflow-x: auto; padding-bottom: 0.5rem;">
        @php $galleryIndex = 0; @endphp
        @foreach ($photos as $photo)
            <figure style="flex: 0 0 auto; width: 16rem; margin: 0;">
                @if ($photo['url'])
                    <button type="button" x-on:click="show({{ $galleryIndex }})"
                            style="padding: 0; border: 0; background: none; cursor: zoom-in;"
                            title="Enlarge {{ strtolower($photo['label']) }} photo">
                        <img src="{{ $photo['url'] }}"
                             alt="{{ $photo['label'] }} photo"
                             style="height: 14rem; width: 16rem; object-fit: cover; border-radius: 0.75rem; display: block; box-shadow: 0 0 0 1px rgba(0,0,0,0.08); transition: opacity 0.15s;"
                             onmouseover="this.style.opacity=0.85" onmouseout="this.style.opacity=1" />
                    </button>
                    @php $galleryIndex++; @endphp
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

    {{-- Lightbox overlay --}}
    <template x-teleport="body">
        <div x-show="open" x-cloak x-transition.opacity.duration.150ms
             style="position: fixed; inset: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.85);"
             x-on:click.self="close()">

            {{-- Close --}}
            <button type="button" x-on:click="close()" title="Close (Esc)"
                    style="position: absolute; top: 1.25rem; right: 1.5rem; width: 2.75rem; height: 2.75rem; border: 0; border-radius: 9999px; background: rgba(255,255,255,0.12); color: #fff; font-size: 1.5rem; line-height: 1; cursor: pointer;">
                &times;
            </button>

            {{-- Prev / Next --}}
            <template x-if="photos.length > 1">
                <div>
                    <button type="button" x-on:click="prev()" title="Previous (←)"
                            style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); width: 2.75rem; height: 2.75rem; border: 0; border-radius: 9999px; background: rgba(255,255,255,0.12); color: #fff; font-size: 1.4rem; cursor: pointer;">
                        &#8249;
                    </button>
                    <button type="button" x-on:click="next()" title="Next (→)"
                            style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); width: 2.75rem; height: 2.75rem; border: 0; border-radius: 9999px; background: rgba(255,255,255,0.12); color: #fff; font-size: 1.4rem; cursor: pointer;">
                        &#8250;
                    </button>
                </div>
            </template>

            {{-- Image + caption --}}
            <figure style="margin: 0; max-width: 90vw; max-height: 90vh; text-align: center;">
                <img x-bind:src="photos[current]?.url" x-bind:alt="photos[current]?.label"
                     style="max-width: 90vw; max-height: 82vh; object-fit: contain; border-radius: 0.5rem;" />
                <figcaption style="margin-top: 0.75rem; color: rgba(255,255,255,0.85); font-size: 0.9rem; font-weight: 500;">
                    <span x-text="photos[current]?.label"></span>
                    <span x-show="photos.length > 1" style="opacity: 0.6;">
                        &nbsp;·&nbsp;<span x-text="(current + 1) + ' / ' + photos.length"></span>
                    </span>
                </figcaption>
            </figure>
        </div>
    </template>
</div>
