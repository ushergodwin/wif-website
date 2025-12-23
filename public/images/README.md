# Images Directory

## Logo
Place your logo file here as `logo.png`. The logo will be used in:
- Navigation bar
- Favicon (if no separate favicon.ico exists)
- Open Graph images (if no separate og-image.jpg exists)

## Recommended Logo Specifications
- **Navigation Logo**: 40px height, transparent background preferred
- **Favicon**: 32x32px or 16x16px PNG, or use favicon.ico in public root
- **Open Graph Image**: 1200x630px JPG/PNG for social media sharing

## Favicon Setup
For best results, create multiple favicon sizes:
- `favicon.ico` (16x16, 32x32, 48x48) in `public/` root
- `logo.png` (32x32) in `public/images/` for modern browsers
- `apple-touch-icon.png` (180x180) in `public/images/` for iOS devices

The current setup will use `logo.png` as favicon if it exists, otherwise falls back to `favicon.ico`.

