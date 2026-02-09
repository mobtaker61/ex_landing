# Email Configuration Guide

## Email Setup for Request Form

The request form sends emails using PHP's `mail()` function. For proper email delivery, you may need to configure your server.

### Current Configuration

The form sends two emails:
1. **To Admin** (media@roniplus.ae) - Notification of new request
2. **To Customer** - Confirmation email

### Server Requirements

1. **PHP mail() function** must be enabled
2. **SMTP configuration** may be required on some servers

### cPanel Email Setup

If emails are not being sent, you may need to:

1. **Use SMTP instead of mail()**:
   - Install PHPMailer library
   - Configure SMTP settings in cPanel
   - Update `request.php` to use SMTP

2. **Check Email Settings**:
   - Go to cPanel → Email Accounts
   - Create an email account (e.g., noreply@roniplus.ae)
   - Use this for sending emails

### Alternative: Use PHPMailer (Recommended)

For better email delivery, consider using PHPMailer:

1. Download PHPMailer
2. Upload to your server
3. Update `request.php` to use PHPMailer with SMTP

### Testing

After setup, test the form:
1. Fill out the request form
2. Check admin email inbox
3. Check customer email inbox (including spam folder)

### Troubleshooting

- **Emails not sending**: Check PHP error logs
- **Emails going to spam**: Configure SPF/DKIM records
- **SMTP errors**: Verify SMTP credentials in cPanel

### Important Notes

- Update `$adminEmail` in `request.php` with your actual email
- Update "From" email addresses to match your domain
- Consider using a professional email service (SendGrid, Mailgun) for production
