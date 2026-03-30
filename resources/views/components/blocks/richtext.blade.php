@props(['data' => []])

<section class="py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-600 prose-a:text-emerald-600 prose-strong:text-gray-900">
            {!! $data['content'] ?? '' !!}
        </div>
    </div>
</section>
