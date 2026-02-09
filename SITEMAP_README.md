# Sitemap Configuration Guide

## Sitemap Files

### 1. `sitemap.php` (Recommended - Dynamic)
- **Location**: Root directory
- **Access**: `https://yourdomain.com/sitemap.xml` (via .htaccess rewrite)
- **Features**: 
  - Automatically includes all tours and media
  - Updates when new projects are added
  - Includes image sitemap for thumbnails
  - Uses actual file modification dates

### 2. `generate-sitemap.php` (Static Generator)
- **Location**: Root directory
- **Usage**: Access via browser to generate static sitemap.xml
- **When to use**: If you prefer a static sitemap file

### 3. `sitemap.xml` (Placeholder)
- Currently a placeholder file
- Will be replaced by dynamic sitemap via .htaccess

## How It Works

### Dynamic Sitemap (Recommended)
1. When `sitemap.xml` is requested, `.htaccess` routes it to `sitemap.php`
2. `sitemap.php` reads all tours and media from folders
3. Generates complete sitemap with:
   - All static pages (home, lists, request)
   - All individual tour pages
   - All individual media pages
   - Image sitemap for thumbnails

### Included Pages
- ✅ Homepage (`/`)
- ✅ Media List (`/media-list.php`)
- ✅ Tours List (`/tours-list.php`)
- ✅ Request Form (`/request.php`)
- ✅ All individual media pages (`/media-detail.php?id=...`)
- ✅ All individual tour pages (`/tour-view.php?id=...`)

## Configuration

### Update Domain
In `sitemap.php`, update the domain (optional, auto-detected):
```php
// For production, uncomment and set:
// $siteUrl = "https://roniplus.ae";
```

### Priority Levels
- **Homepage**: 1.0 (highest)
- **List Pages**: 0.9
- **Individual Pages**: 0.8
- **Request Page**: 0.7

### Change Frequency
- **Homepage & Lists**: weekly
- **Individual Pages**: monthly
- **Request Page**: monthly

## Testing

1. **Access sitemap**: `https://yourdomain.com/sitemap.xml`
2. **Validate**: Use Google Search Console Sitemap validator
3. **Check**: Ensure all pages are included

## Submit to Search Engines

### Google Search Console
1. Go to https://search.google.com/search-console
2. Add property (your domain)
3. Go to Sitemaps section
4. Submit: `https://yourdomain.com/sitemap.xml`

### Bing Webmaster Tools
1. Go to https://www.bing.com/webmasters
2. Add site
3. Submit sitemap: `https://yourdomain.com/sitemap.xml`

## Automatic Updates

The dynamic sitemap automatically updates when:
- New tours are added to `/tours/` folder
- New media packages are added to `/media/` folder
- Files are modified (lastmod date updates)

## Troubleshooting

- **404 Error**: Check .htaccess rewrite rules
- **Empty sitemap**: Verify tours and media folders exist
- **Missing pages**: Check file permissions
- **XML errors**: Validate XML syntax

## Best Practices

1. Submit sitemap to Google Search Console
2. Monitor sitemap status regularly
3. Keep sitemap under 50,000 URLs (current setup handles this)
4. Use lastmod dates for better crawling efficiency
