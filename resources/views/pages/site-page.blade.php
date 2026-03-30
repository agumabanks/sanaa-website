<x-pages-layout :title="$title ?? ($page->title . ' | ' . config('app.name'))">
  @if(!empty($metaDescription))
    <x-slot name="metaDescription">{{ $metaDescription }}</x-slot>
  @endif

  <section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold mb-8 text-center">{{ $page->title }}</h1>
      <div class="prose prose-lg max-w-none">
        {!! $page->content !!}
      </div>
    </div>
  </section>
</x-pages-layout>
