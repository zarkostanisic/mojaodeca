<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ url('sitemap/kategorije') }}</loc>
        <lastmod>{{ $products->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
     @foreach ($categories as $category)
       <sitemap>
            <loc>{{url('/sitemap')}}/{{urlencode($category->name)}}</loc>
        	<lastmod>{{ $products->created_at->tz('UTC')->toAtomString() }}</lastmod>
        </sitemap>
    @endforeach
</sitemapindex>