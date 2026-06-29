@extends('layouts.landing')

@section('title', 'Sanaa Cloud — Sanaa Co.')
@section('seo_title', 'Sanaa Cloud — Sanaa Co.')
@section('seo_description', 'Sanaa Cloud is managed hosting and storage for businesses running on Soko 24 and Baraka 24. Full launch details are on the way.')
@section('seo_image', asset('storage/images/sanaa-logo-b.svg'))

@push('schema')
    <x-schema-product
        name="Sanaa Cloud"
        description="Managed cloud hosting and storage for businesses on the Sanaa stack."
        url="https://sanaa.ug/sanaa-cloud"
        category="WebApplication" />
@endpush

@section('content')
<section class="min-h-screen bg-black text-white flex items-center">
    <div class="max-w-4xl mx-auto px-6 py-32">
        <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs uppercase tracking-[0.2em] text-gray-400">
            Infrastructure
        </div>
        <h1 class="mt-8 text-5xl md:text-6xl font-light tracking-tight">Sanaa Cloud</h1>
        <p class="mt-6 max-w-2xl text-lg text-gray-300 leading-8">Managed cloud hosting and storage for businesses running on the Sanaa stack. More detail is on the way as the infrastructure layer opens up.</p>
        <div class="mt-10 flex flex-wrap gap-4">
            <a href="{{ route('contact') }}" class="inline-flex items-center rounded-full bg-emerald-400 px-6 py-3 font-semibold text-black hover:bg-emerald-300 transition-colors">Contact Us</a>
            <a href="https://wa.me/256706121211" class="inline-flex items-center rounded-full border border-white/20 px-6 py-3 font-semibold text-white hover:bg-white/5 transition-colors" target="_blank" rel="noopener noreferrer">WhatsApp 0706121211</a>
        </div>
    </div>
</section>
@endsection
