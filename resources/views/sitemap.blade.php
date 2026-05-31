<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

  {{-- ============================================
       STATIC PAGES
       ============================================ --}}
  @foreach($staticPages as $page)
  <url>
    <loc>{{ url($page['url']) }}</loc>
    <lastmod>{{ now()->toAtomString() }}</lastmod>
    <changefreq>{{ $page['changefreq'] }}</changefreq>
    <priority>{{ $page['priority'] }}</priority>
  </url>
  @endforeach

  {{-- ============================================
       DYNAMIC: NEWS ARTICLES
       ============================================ --}}
  @foreach($newsItems as $news)
  <url>
    <loc>{{ url('/berita/' . $news->id) }}</loc>
    <lastmod>{{ $news->updated_at->toAtomString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  @endforeach

  {{-- ============================================
       DYNAMIC: TEACHER / LECTURER PROFILES
       ============================================ --}}
  @foreach($teachers as $teacher)
  <url>
    <loc>{{ url('/dosen/' . $teacher->id) }}</loc>
    <lastmod>{{ $teacher->updated_at->toAtomString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  @endforeach

</urlset>
