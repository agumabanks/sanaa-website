@props(['data' => []])

@php
    $url = $data['url'] ?? '';
    $embedUrl = '';

    if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        if (!empty($matches[1])) {
            $embedUrl = "https://www.youtube.com/embed/{$matches[1]}";
        }
    } elseif (str_contains($url, 'vimeo.com')) {
        preg_match('/vimeo\.com\/(\d+)/', $url, $matches);
        if (!empty($matches[1])) {
            $embedUrl = "https://player.vimeo.com/video/{$matches[1]}";
        }
    }
@endphp

<section class="py-12 md:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($data['title']))
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">{{ $data['title'] }}</h3>
        @endif

        @if($embedUrl)
            <div class="relative aspect-video rounded-2xl overflow-hidden shadow-lg">
                <iframe
                    src="{{ $embedUrl }}"
                    class="absolute inset-0 w-full h-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        @endif
    </div>
</section>
