{{-- SEO Meta Tags --}}
@php
    $title = @$seo_title ?: (@$title ?: (View::hasSection('seo_title') ? View::getSection('seo_title') : (View::hasSection('title') ? View::getSection('title') : config('app.name', 'Sanaa Co.'))));
    $description = @$seo_description ?: (@$description ?: (View::hasSection('seo_description') ? View::getSection('seo_description') : (View::hasSection('meta_description') ? View::getSection('meta_description') : (View::hasSection('description') ? View::getSection('description') : 'Sanaa Co. is a member-owned technology ecosystem built in Uganda — finance, commerce, logistics, and digital infrastructure for African business.'))));
    $canonical = @$seo_canonical ?: (@$canonical ?: (View::hasSection('seo_canonical') ? View::getSection('seo_canonical') : url()->current()));
    $url = @$seo_url ?: (@$url ?: (View::hasSection('seo_url') ? View::getSection('seo_url') : $canonical));
    $image = @$seo_image ?: (@$image ?: (View::hasSection('seo_image') ? View::getSection('seo_image') : (View::hasSection('image') ? View::getSection('image') : cdn_asset('storage/images/sanaa-logo-b.svg'))));
    $keywords = @$seo_keywords ?: (@$keywords ?: (View::hasSection('seo_keywords') ? View::getSection('seo_keywords') : 'Sanaa Co,Sanaa,Aguma Banks,African commerce platform,digital infrastructure,omnichannel retail,financial services Uganda,POS Uganda'));
    $authorMeta = @$seo_author ?: (View::hasSection('seo_author') ? View::getSection('seo_author') : 'Sanaa Co.');
    $robots = @$seo_robots ?: (@$robots ?: (View::hasSection('seo_robots') ? View::getSection('seo_robots') : 'index, follow'));
    $type = @$seo_type ?: (@$type ?: (View::hasSection('seo_type') ? View::getSection('seo_type') : 'website'));
    $publishedTime = @$seo_published_time ?: (@$published_time ?: (View::hasSection('seo_published_time') ? View::getSection('seo_published_time') : null));
    $modifiedTime = @$seo_modified_time ?: (@$modified_time ?: (View::hasSection('seo_modified_time') ? View::getSection('seo_modified_time') : null));

    // Get current path for hreflang generation
    $currentPath = request()->path();
    $currentPath = $currentPath === '/' ? '' : '/' . $currentPath;

    // Check if we're on a locale-prefixed path
    $locales = ['en', 'fr', 'sw'];
    $currentLocale = app()->getLocale();
    $isLocalePrefixed = false;
    foreach ($locales as $locale) {
        if (str_starts_with($currentPath, '/' . $locale . '/') || $currentPath === '/' . $locale) {
            $isLocalePrefixed = true;
            break;
        }
    }
@endphp

<title>{{ $title }}</title>

{{-- Hreflang tags for multilingual SEO --}}
@if(!isset($disable_hreflang) || !$disable_hreflang)
    @php
        $cleanPath = $currentPath;
        // Remove existing locale prefix if present
        foreach ($locales as $locale) {
            if (str_starts_with($cleanPath, '/' . $locale . '/')) {
                $cleanPath = substr($cleanPath, strlen('/' . $locale));
                break;
            } elseif ($cleanPath === '/' . $locale) {
                $cleanPath = '/';
                break;
            }
        }
        $cleanPath = $cleanPath === '/' ? '' : $cleanPath;

        // Get the base canonical without locale
        $baseUrl = rtrim(config('app.url', 'https://sanaa.ug'), '/');
    @endphp

    {{-- English (default) --}}
    <link rel="alternate" hreflang="en" href="{{ $baseUrl . '/en' . $cleanPath }}" />

    {{-- French --}}
    <link rel="alternate" hreflang="fr" href="{{ $baseUrl . '/fr' . $cleanPath }}" />

    {{-- Swahili --}}
    <link rel="alternate" hreflang="sw" href="{{ $baseUrl . '/sw' . $cleanPath }}" />

    {{-- x-default for language/region not specified --}}
    <link rel="alternate" hreflang="x-default" href="{{ $baseUrl . $cleanPath }}" />
@endif

<meta name="description" content="{{ Str::limit($description, 160) }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">

<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $authorMeta }}">
<meta name="facebook-domain-verification" content="9sz4w1uhc1h5znmxytx5h8d9ub838m">
<meta name="theme-color" content="#10b981">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ Str::limit($description, 160) }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:alt" content="{{ Str::limit($title, 110) }}">
<meta property="og:site_name" content="Sanaa Co.">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
@if($publishedTime)
<meta property="article:published_time" content="{{ $publishedTime }}">
@endif
@if($modifiedTime)
<meta property="article:modified_time" content="{{ $modifiedTime }}">
<meta property="og:updated_time" content="{{ $modifiedTime }}">
@endif

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

{{-- WebSite Schema with SearchAction --}}
@if(!isset($disable_website_schema) || !$disable_website_schema)
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Sanaa Co.",
  "url": "https://sanaa.ug",
  "potentialAction": {
    "@type": "SearchAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "https://sanaa.ug/blog?q={search_term_string}"
    },
    "query-input": "required name=search_term_string"
  },
  "inLanguage": ["en", "fr", "sw"],
  "publisher": {
    "@type": "Organization",
    "name": "Sanaa Co.",
    "url": "https://sanaa.ug",
    "logo": {
      "@type": "ImageObject",
      "url": "https://sanaa.ug/storage/images/sanaa.png",
      "width": 512,
      "height": 512
    },
    "sameAs": [
      "https://twitter.com/sanaaco",
      "https://facebook.com/sanaaco",
      "https://linkedin.com/company/sanaaco"
    ],
    "foundingDate": "2021",
    "founders": [
      {
        "@type": "Person",
        "name": "Aguma Banks"
      }
    ],
    "areaServed": [
      {
        "@type": "Country",
        "name": "Uganda"
      },
      {
        "@type": "Country",
        "name": "Democratic Republic of the Congo"
      }
    ],
    "contactPoint": {
      "@type": "ContactPoint",
      "contactType": "customer support",
      "url": "https://sanaa.ug/contact"
    }
  }
}
</script>
@endif
