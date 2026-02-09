<?php
/**
 * Dynamic Sitemap Generator
 * This file generates a sitemap.xml dynamically based on tours and media
 * 
 * Usage: Access via browser or run via cron job
 * URL: https://yourdomain.com/generate-sitemap.php
 */

require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/xml; charset=utf-8');

$siteUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$siteUrl .= "://" . $_SERVER['HTTP_HOST'];
$siteUrl .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$siteUrl = rtrim($siteUrl, '/');

// Get all tours and media
$tours = getTours();
$media = getMedia();

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
echo '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
echo '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n";
echo '        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n\n";

// Homepage
echo "    <url>\n";
echo "        <loc>" . htmlspecialchars($siteUrl) . "/</loc>\n";
echo "        <lastmod>" . date('Y-m-d') . "</lastmod>\n";
echo "        <changefreq>weekly</changefreq>\n";
echo "        <priority>1.0</priority>\n";
echo "    </url>\n\n";

// Media List
echo "    <url>\n";
echo "        <loc>" . htmlspecialchars($siteUrl) . "/media-list.php</loc>\n";
echo "        <lastmod>" . date('Y-m-d') . "</lastmod>\n";
echo "        <changefreq>weekly</changefreq>\n";
echo "        <priority>0.8</priority>\n";
echo "    </url>\n\n";

// Tours List
echo "    <url>\n";
echo "        <loc>" . htmlspecialchars($siteUrl) . "/tours-list.php</loc>\n";
echo "        <lastmod>" . date('Y-m-d') . "</lastmod>\n";
echo "        <changefreq>weekly</changefreq>\n";
echo "        <priority>0.8</priority>\n";
echo "    </url>\n\n";

// Individual Media Pages
foreach ($media as $item) {
    echo "    <url>\n";
    echo "        <loc>" . htmlspecialchars($siteUrl) . "/media-detail.php?id=" . urlencode($item['id']) . "</loc>\n";
    echo "        <lastmod>" . date('Y-m-d') . "</lastmod>\n";
    echo "        <changefreq>monthly</changefreq>\n";
    echo "        <priority>0.6</priority>\n";
    echo "    </url>\n\n";
}

// Individual Tour Pages
foreach ($tours as $tour) {
    echo "    <url>\n";
    echo "        <loc>" . htmlspecialchars($siteUrl) . "/tour-view.php?id=" . urlencode($tour['id']) . "</loc>\n";
    echo "        <lastmod>" . date('Y-m-d') . "</lastmod>\n";
    echo "        <changefreq>monthly</changefreq>\n";
    echo "        <priority>0.6</priority>\n";
    echo "    </url>\n\n";
}

echo '</urlset>';
?>
