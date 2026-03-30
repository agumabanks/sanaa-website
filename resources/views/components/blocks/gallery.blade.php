@props(['data' => []])

@php
    $images = $data['images'] ?? [];
    $columns = $data['columns'] ?? 4;
@endphp

<section class="py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(count($images) > 0)
            <div class="grid grid-cols-2 md:grid-cols-{{ $columns }} gap-4">
                @foreach($images as $image)
                    <a href="{{ $image['src'] ?? '' }}" class="group relative aspect-square overflow-hidden rounded-xl">
                        <img
                            src="{{ $image['src'] ?? '' }}"
                            alt="{{ $image['alt'] ?? '' }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                        >
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors"></div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
