@extends('layouts.finance', [
    'title' => 'Thank you — Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Contact Sales', 'url' => route('finance.contact-sales')], ['name' => 'Success'] ],
])
@section('content')
<section class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    <h1 class="text-3xl font-semibold">Thank you</h1>
    <p class="mt-3 text-gray-600">We received your request and will be in touch shortly.</p>
    <a href="{{ route('finance.index') }}" class="mt-6 inline-flex rounded-md bg-emerald-600 text-white px-4 py-2 text-sm hover:bg-emerald-700">Back to Finance</a>
    @push('head')
    <meta http-equiv="refresh" content="5; url={{ route('finance.index') }}">
    @endpush
</section>
@endsection

