<?xml version="1.0" encoding="UTF-8"?>
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
						
			<?php foreach($videos as $video) : ?>
			
				<url>
							<loc>http://doyou.watch/video/<?php echo $video->domain; ?>/<?php echo Url::generateSafeSlug($video->title); ?>/<?php echo $video->video_id; ?></loc>
							<lastmod><?php echo date('Y-m-d'); ?></lastmod>
							<changefreq>monthly</changefreq>
							<priority>1</priority>
				</url>
			<?php endforeach; ?>
	</urlset>