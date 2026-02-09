<?php
/**
 * Dynamic Sitemap Generator
 * This file generates sitemap.xml dynamically
 * Access via: https://yourdomain.com/sitemap.php
 * Or rename to sitemap.xml and configure .htaccess to execute PHP
 */

require_once __DIR__ . '/includes/functions.php';

// Get site URL
$siteUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$siteUrl .= "://" . $_SERVER['HTTP_HOST'];
$siteUrl .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$siteUrl = rtrim($siteUrl, '/');

// For production, you can hardcode:
// $siteUrl = "https://roniplus.ae";

// Get all tours and media
$tours = getTours();
$media = getMedia();

// Set content type
header('Content-Type: application/xml; charset=utf-8');

// Output XML
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
echo '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
echo '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"' . "\n";
echo '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n";
echo '        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n\n";

// Homepage
echo "    <url>\n";
echo "        <loc>" . htmlspecialchars($siteUrl) . "/</loc>\n";
echo "        <lastmod>" . date('Y-m-d') . "</lastmod>\n";
echo "        <changefreq>weekly</changefreq>\n";
echo "        <priority>1.0</priority>\n";
echo "    </url>\n\n";

// Media List Page
echo "    <url>\n";
echo "        <loc>" . htmlspecialchars($siteUrl) . "/media-list.php</loc>\n";
echo "        <lastmod>" . date('Y-m-d') . "</lastmod>\n";
echo "        <changefreq>weekly</changefreq>\n";
echo "        <priority>0.9</priority>\n";
echo "    </url>\n\n";

// Tours List Page
echo "    <url>\n";
echo "        <loc>" . htmlspecialchars($siteUrl) . "/tours-list.php</loc>\n";
echo "        <lastmod>" . date('Y-m-d') . "</lastmod>\n";
echo "        <changefreq>weekly</changefreq>\n";
echo "        <priority>0.9</priority>\n";
echo "    </url>\n\n";

// Request Page
echo "    <url>\n";
echo "        <loc>" . htmlspecialchars($siteUrl) . "/request.php</loc>\n";
echo "        <lastmod>" . date('Y-m-d') . "</lastmod>\n";
echo "        <changefreq>monthly</changefreq>\n";
echo "        <priority>0.7</priority>\n";
echo "    </url>\n\n";

// Individual Media Pages
foreach ($media as $item) {
    $mediaUrl = $siteUrl . "/media-detail.php?id=" . urlencode($item['id']);
    $lastmod = file_exists(__DIR__ . '/media/' . $item['id']) ? 
        date('Y-m-d', filemtime(__DIR__ . '/media/' . $item['id'])) : 
        date('Y-m-d');
    
    echo "    <url>\n";
    echo "        <loc>" . htmlspecialchars($mediaUrl) . "</loc>\n";
    echo "        <lastmod>" . $lastmod . "</lastmod>\n";
    echo "        <changefreq>monthly</changefreq>\n";
    echo "        <priority>0.8</priority>\n";
    
    // Add image if thumbnail exists
    if (isset($item['thumbnail']) && $item['thumbnail']) {
        $imagePath = __DIR__ . '/' . $item['thumbnail'];
        if (file_exists($imagePath)) {
            $imageUrl = $siteUrl . '/' . $item['thumbnail'];
            echo "        <image:image>\n";
            echo "            <image:loc>" . htmlspecialchars($imageUrl) . "</image:loc>\n";
            echo "            <image:title>" . htmlspecialchars($item['name']) . "</image:title>\n";
            echo "        </image:image>\n";
        }
    }
    
    echo "    </url>\n\n";
}

// Individual Tour Pages
foreach ($tours as $tour) {
    $tourUrl = $siteUrl . "/tour-view.php?id=" . urlencode($tour['id']);
    $lastmod = file_exists(__DIR__ . '/tours/' . $tour['id']) ? 
        date('Y-m-d', filemtime(__DIR__ . '/tours/' . $tour['id'])) : 
        date('Y-m-d');
    
    echo "    <url>\n";
    echo "        <loc>" . htmlspecialchars($tourUrl) . "</loc>\n";
    echo "        <lastmod>" . $lastmod . "</lastmod>\n";
    echo "        <changefreq>monthly</changefreq>\n";
    echo "        <priority>0.8</priority>\n";
    
    // Add image if thumbnail exists
    if (isset($tour['thumbnail']) && $tour['thumbnail']) {
        $imagePath = __DIR__ . '/' . $tour['thumbnail'];
        if (file_exists($imagePath)) {
            $imageUrl = $siteUrl . '/' . $tour['thumbnail'];
            echo "        <image:image>\n";
            echo "            <image:loc>" . htmlspecialchars($imageUrl) . "</image:loc>\n";
            echo "            <image:title>" . htmlspecialchars($tour['name']) . "</image:title>\n";
            echo "        </image:image>\n";
        }
    }
    
    echo "    </url>\n\n";
}

echo '</urlset>';
?>
