{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($items as $i)
  <url>
    <loc>{{ $i['loc'] }}</loc>
    @if(!empty($i['lastmod']))<lastmod>{{ $i['lastmod'] }}</lastmod>@endif
    @if(!empty($i['changefreq']))<changefreq>{{ $i['changefreq'] }}</changefreq>@endif
    @if(!empty($i['priority']))<priority>{{ $i['priority'] }}</priority>@endif
  </url>
@endforeach
</urlset>
