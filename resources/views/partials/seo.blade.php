{{-- SEO Meta Tags --}}
@php
    $title = @$seo_title ?: (@$title ?: (View::hasSection('seo_title') ? View::getSection('seo_title') : (View::hasSection('title') ? View::getSection('title') : config('app.name', 'Sanaa Co.'))));
    $description = @$seo_description ?: (@$description ?: (View::hasSection('seo_description') ? View::getSection('seo_description') : (View::hasSection('meta_description') ? View::getSection('meta_description') : (View::hasSection('description') ? View::getSection('description') : 'Sanaa is a modern financial platform for businesses in Uganda, offering cards, payments, and financial management tools.'))));
    $url = url()->current();
    $image = @$seo_image ?: (@$image ?: (View::hasSection('seo_image') ? View::getSection('seo_image') : (View::hasSection('image') ? View::getSection('image') : cdn_asset('storage/images/sanaa.png'))));
    $keywords = @$seo_keywords ?: (@$keywords ?: (View::hasSection('seo_keywords') ? View::getSection('seo_keywords') : 'Sanaa Co,Sanaa,Aguma Banks,African commerce platform,digital infrastructure,omnichannel retail,financial services Uganda,POS Uganda'));
    $authorMeta = @$seo_author ?: (View::hasSection('seo_author') ? View::getSection('seo_author') : 'Sanaa Co.');
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ Str::limit($description, 160) }}">
<link rel="canonical" href="{{ $url }}">

<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $authorMeta }}">
<meta name="facebook-domain-verification" content="9sz4w1uhc1h5znmxytx5h8d9ub838m">
<meta name="theme-color" content="#10b981">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ @$type ?: 'website' }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ Str::limit($description, 160) }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:site_name" content="Sanaa Co.">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sanaa_co">
<meta name="twitter:url" content="{{ $url }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ Str::limit($description, 160) }}">
<meta name="twitter:image" content="{{ $image }}">

{{-- Custom Schema Markup --}}
@stack('schema')

{{-- Additional Meta --}}
@stack('meta')
