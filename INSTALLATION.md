# Installation Guide - RoniPlus

## Quick Setup for cPanel

### Step 1: Upload Files
1. Upload all files to your cPanel hosting (usually `public_html` directory)
2. Maintain the folder structure as provided

### Step 2: Configure Permissions
Set folder permissions:
- `tours/` folder: 755
- `media/` folder: 755
- All PHP files: 644

### Step 3: Customize Settings

#### Update WhatsApp Number
Edit these files and replace `1234567890` with your actual WhatsApp number:
- `includes/header.php` (line with `wa.me/1234567890`)
- `includes/footer.php` (line with `wa.me/1234567890`)

Format: Country code + number (no + sign, no spaces)
Example: `989123456789` for Iran

#### Add Your Logo
1. Place your logo file as `assets/images/logo.png`
2. Recommended size: 200x60px
3. Supported formats: PNG (preferred) or JPG

#### Update Contact Information
Edit `includes/footer.php` and update:
- Phone number
- Email address
- Physical address
- Business hours
- Social media links

### Step 4: Upload Projects

#### Virtual Tours
1. Create folders in `tours/` directory
2. Each folder = one virtual tour project
3. Place all tour files in the folder
4. Ensure `index.html` or `index.htm` exists
5. (Optional) Add `thumbnail.png` for preview

#### Media Packages

**Option 1: Local Video File**
1. Create folders in `media/` directory
2. Each folder = one media package
3. Place video file(s) in the folder
4. Supported formats: mp4, webm, ogg, mov
5. (Optional) Add `thumbnail.png` for cover

**Option 2: YouTube Video**
1. Create folders in `media/` directory
2. Each folder = one media package
3. Create a file named `youtube.txt` in the folder
4. Paste YouTube video URL in the file (one URL per line)
5. Supported URL formats:
   - `https://www.youtube.com/watch?v=VIDEO_ID`
   - `https://youtu.be/VIDEO_ID`
   - `https://www.youtube.com/embed/VIDEO_ID`
   - Or just the `VIDEO_ID` (11 characters)
6. (Optional) Add `thumbnail.png` for custom cover (otherwise YouTube thumbnail will be used)

**Note:** If both video file and `youtube.txt` exist, YouTube will take priority.

### Step 5: Test
1. Visit your website
2. Check if projects appear correctly
3. Test navigation and links
4. Verify WhatsApp link works

## Troubleshooting

### Projects not appearing?
- Check folder permissions (should be 755)
- Ensure `index.html`/`index.htm` exists in tour folders
- Ensure video files exist in media folders
- Check file names match supported formats

### Images not loading?
- Verify file paths are correct
- Check file permissions
- Ensure image files exist

### PHP errors?
- Check PHP version (requires 7.4+)
- Verify all PHP files have correct syntax
- Check error logs in cPanel

## Support

For issues or questions, contact via WhatsApp or email.
