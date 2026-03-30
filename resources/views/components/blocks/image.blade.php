@props(['data' => []])

<section class="py-12 md:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($data['src']))
            <figure>
                <img
                    src="{{ $data['src'] }}"
                    alt="{{ $data['alt'] ?? '' }}"
                    class="w-full rounded-2xl shadow-lg"
                >
                @if(!empty($data['caption']))
                    <figcaption class="text-center text-gray-500 text-sm mt-4">
                        {{ $data['caption'] }}
                    </figcaption>
                @endif
            </figure>
        @endif
    </div>
</section>
