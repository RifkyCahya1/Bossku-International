<?php
// resources/views/sitemap.php
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($urls as $url): ?>
        <url>
            <loc><?= htmlspecialchars($url['loc']) ?></loc>
            <lastmod><?= htmlspecialchars($url['lastmod']) ?></lastmod>
            <priority><?= htmlspecialchars($url['priority']) ?></priority>
        </url>
    <?php endforeach; ?>
</urlset>