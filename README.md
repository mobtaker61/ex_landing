# Special Exhibition Media Services - RoniPlus

A dynamic PHP-based website for showcasing 360° Virtual Tours and Media Packages for exhibitions and events.

## Features

- ✨ Modern landing page with Hero section
- 🎯 Dynamic listing of virtual tours and media packages
- 📱 Fully responsive design with Bootstrap 5
- 🔄 Automatic updates when new projects are uploaded
- 🎨 Professional header and footer
- 📞 WhatsApp integration for easy contact

## Requirements

- PHP 7.4 or higher
- Apache web server with mod_rewrite enabled
- cPanel compatible

## Installation

1. **Upload files to your cPanel hosting:**
   - Upload all files to your public_html directory (or subdirectory)

2. **Set folder permissions:**
   - Ensure `tours` and `media` folders are writable (755 or 775)

3. **Configure:**
   - Update WhatsApp phone number in `includes/header.php` and `includes/footer.php`
   - Add your logo to `assets/images/logo.png`
   - Update contact information in `includes/footer.php`

4. **Upload projects:**
   - Place virtual tour projects in the `tours` folder
   - Place media packages in the `media` folder

## Project Structure

```
Tour_RoniPlus/
├── api/                    # API endpoints
│   ├── get_tours.php      # Get virtual tours list
│   └── get_media.php      # Get media packages list
├── assets/                 # Static assets
│   ├── css/
│   │   └── style.css      # Custom styles
│   ├── js/
│   │   └── main.js        # Custom JavaScript
│   └── images/            # Images (logo, etc.)
├── includes/               # PHP includes
│   ├── header.php         # Site header
│   └── footer.php         # Site footer
├── tours/                  # Virtual tour projects
│   └── [project-name]/    # Each tour in separate folder
│       ├── index.html
│       └── thumbnail.png
├── media/                  # Media packages
│   └── [project-name]/    # Each media in separate folder
│       ├── video.mp4
│       └── thumbnail.png
├── index.php              # Homepage
├── tours-list.php         # All virtual tours page
├── tour-view.php          # Single tour view page
├── media-list.php         # All media packages page
├── media-detail.php       # Single media view page
└── .htaccess             # Apache configuration
```

## Adding Projects

### Virtual Tours

1. Create a folder in `tours/` directory
2. Place all tour files in the folder
3. Ensure `index.html` or `index.htm` exists
4. (Optional) Add `thumbnail.png` for preview

### Media Packages

1. Create a folder in `media/` directory
2. Place video file(s) in the folder (mp4, webm, ogg, mov)
3. (Optional) Add `thumbnail.png` for cover image

Projects will automatically appear in the listings once uploaded.

## Customization

### Logo
- Place your logo file as `assets/images/logo.png`
- Recommended size: 200x60px or similar aspect ratio

### Colors
- Edit Bootstrap color variables in `assets/css/style.css`
- Or override Bootstrap classes as needed

### Contact Information
- Update phone number, email, and address in `includes/footer.php`
- Update WhatsApp link in header and footer

### WhatsApp Integration
- Replace `1234567890` with your actual WhatsApp number
- Format: country code + number (e.g., 989123456789 for Iran)

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

ISC

## Support

For support, contact via WhatsApp or email provided in the footer.
