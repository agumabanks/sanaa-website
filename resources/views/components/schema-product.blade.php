@props(['name', 'description', 'url', 'category' => 'SoftwareApplication'])

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "{{ $name }}",
  "description": "{{ $description }}",
  "url": "{{ $url }}",
  "applicationCategory": "{{ $category }}",
  "operatingSystem": "Web",
  "offers": {"@type": "Offer", "availability": "https://schema.org/InStock"},
  "publisher": {"@type": "Organization", "name": "Sanaa Co.", "url": "https://sanaa.ug"}
}
</script>
