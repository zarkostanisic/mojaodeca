<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
        <loc>http://mojaodeca.com/magazin</loc>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
    </url>
    @foreach ($categories as $category)
        <url>
            <loc>http://mojaodeca.com/magazin/{{urlencode($category->name)}}</loc>
            <changefreq>daily</changefreq>
            <priority>0.85</priority>
        </url>
    @endforeach
</urlset>