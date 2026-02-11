<?php
/**
 * Meta Tags Generator for SEO and Social Media
 * 
 * Usage:
 * $pageTitle = "Page Title";
 * $pageDescription = "Page description";
 * $pageImage = "path/to/image.jpg";
 * $pageUrl = "https://example.com/page";
 * include 'includes/meta-tags.php';
 */

// Default values
$siteName = "RoniPlus - Special Exhibition Media Services";
$siteUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$siteUrl .= "://" . $_SERVER['HTTP_HOST'];
$siteUrl .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$siteUrl = rtrim($siteUrl, '/');
// For production, you can hardcode: $siteUrl = "https://roniplus.ae";
$defaultImage = $siteUrl . "/assets/images/logo.png";
$siteDescription = "Professional 360° Virtual Tours and Media Packages for exhibitions, events, and businesses. Experience immersive virtual environments and high-quality media solutions.";

// Page-specific values (can be overridden)
$pageTitle = isset($pageTitle) ? $pageTitle : $siteName;
$pageDescription = isset($pageDescription) ? $pageDescription : $siteDescription;
$pageImage = isset($pageImage) ? (strpos($pageImage, 'http') === 0 ? $pageImage : $siteUrl . '/' . $pageImage) : $defaultImage;
$pageUrl = isset($pageUrl) ? (strpos($pageUrl, 'http') === 0 ? $pageUrl : $siteUrl . '/' . $pageUrl) : $siteUrl;
$pageType = isset($pageType) ? $pageType : "website";
$keywords = isset($keywords) ? $keywords : "virtual tour, 360 tour, media packages, exhibition services, virtual reality, Dubai, UAE";
?>

<!-- Primary Meta Tags -->
<meta name="title" content="<?php echo htmlspecialchars($pageTitle); ?>">
<meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($keywords); ?>">
<meta name="author" content="RoniPlus">
<meta name="robots" content="index, follow">
<meta name="language" content="English">
<meta name="revisit-after" content="7 days">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="<?php echo htmlspecialchars($pageType); ?>">
<meta property="og:url" content="<?php echo htmlspecialchars($pageUrl); ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($pageImage); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="<?php echo htmlspecialchars($siteName); ?>">
<meta property="og:locale" content="en_US">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="<?php echo htmlspecialchars($pageUrl); ?>">
<meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
<meta name="twitter:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
<meta name="twitter:image" content="<?php echo htmlspecialchars($pageImage); ?>">
<meta name="twitter:site" content="@roniplus"> <!-- Update with your Twitter handle -->
<meta name="twitter:creator" content="@roniplus"> <!-- Update with your Twitter handle -->

<!-- Additional SEO -->
<link rel="canonical" href="<?php echo htmlspecialchars($pageUrl); ?>">
<meta name="theme-color" content="#FF6600">
<meta name="msapplication-TileColor" content="#000C7B">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="RoniPlus">

<!-- Schema.org JSON-LD for Organization -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "<?php echo htmlspecialchars($siteName); ?>",
  "url": "<?php echo htmlspecialchars($siteUrl); ?>",
  "logo": "<?php echo htmlspecialchars($defaultImage); ?>",
  "description": "<?php echo htmlspecialchars($siteDescription); ?>",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "217, Business Village B, Port Saeed",
    "addressLocality": "Dubai",
    "addressRegion": "Dubai",
    "postalCode": "",
    "addressCountry": "AE"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+971-52-229-9108",
    "contactType": "Customer Service",
    "email": "media@roniplus.ae",
    "availableLanguage": ["English", "Arabic"],
    "areaServed": "AE"
  },
  "sameAs": [
    "https://www.facebook.com/roniplus.ae",
    "https://www.instagram.com/roniplus.ae",
    "https://www.linkedin.com/company/roniplus",
    "https://x.com/roniplusae"
  ],
  "foundingDate": "2020",
  "numberOfEmployees": {
    "@type": "QuantitativeValue",
    "value": "10-50"
  },
  "serviceArea": {
    "@type": "GeoCircle",
    "geoMidpoint": {
      "@type": "GeoCoordinates",
      "latitude": "25.2048",
      "longitude": "55.2708"
    }
  },
  "areaServed": {
    "@type": "Country",
    "name": "United Arab Emirates"
  },
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Exhibition Media Services",
    "itemListElement": [
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "360° Virtual Tour",
          "description": "Interactive 360° virtual tours for exhibitions and events"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Video Documentation",
          "description": "Professional video documentation and media packages"
        }
      }
    ]
  }
}
</script>

<!-- Breadcrumb Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "<?php echo htmlspecialchars($siteUrl); ?>"
    }
    <?php if (isset($breadcrumbItems)): ?>
      <?php foreach ($breadcrumbItems as $index => $item): ?>
        ,{
          "@type": "ListItem",
          "position": <?php echo $index + 2; ?>,
          "name": "<?php echo htmlspecialchars($item['name']); ?>",
          "item": "<?php echo htmlspecialchars($item['url']); ?>"
        }
      <?php endforeach; ?>
    <?php endif; ?>
  ]
}
</script>

<?php
// Add page-specific schema if needed
if (isset($pageType) && $pageType === 'article') {
    echo '<script type="application/ld+json">';
    echo json_encode([
        "@context" => "https://schema.org",
        "@type" => "Article",
        "headline" => $pageTitle,
        "description" => $pageDescription,
        "image" => $pageImage,
        "author" => [
            "@type" => "Organization",
            "name" => $siteName
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $siteName,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $defaultImage
            ]
        ],
        "datePublished" => isset($datePublished) ? $datePublished : date('Y-m-d'),
        "dateModified" => isset($dateModified) ? $dateModified : date('Y-m-d')
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    echo '</script>';
}
include __DIR__ . '/analytics.php';
?>
