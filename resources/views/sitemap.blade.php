<?php echo '<xml version="1.0" encoding="UTF-8">'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($sites as $site)
        <url>
            <loc>{{route('get_desc' . $site->id) }}</loc>
            <lastmod>{{ $site->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
