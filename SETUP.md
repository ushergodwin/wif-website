# Setup Guide - WIF Website

## Quick Start

1. **Database Setup**
   - Create a MySQL database named `wif_website`
   - Update `.env` with your database credentials (already set to root/ROOT@ADMIN)

2. **Run Migrations**
   ```bash
   php artisan migrate
   ```

3. **Create Admin User**
   ```bash
   php artisan make:filament-user
   ```
   Follow the prompts to create your first admin user.

4. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

5. **Build Assets**
   ```bash
   npm run build
   ```

6. **Start Servers**
   ```bash
   # Terminal 1 - Laravel
   php artisan serve
   
   # Terminal 2 - Vite (for development)
   npm run dev
   ```

## Access Points

- **Frontend**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin
- **Mentorship Program**: https://wif.piu.ac.ug/ (external link)

## Creating Remaining Filament Resources

The ProjectResource has been created as an example. To create the remaining resources, run:

```bash
php artisan make:filament-resource Page
# When prompted for title attribute, enter: title

php artisan make:filament-resource Testimonial
# When prompted for title attribute, enter: participant_name

php artisan make:filament-resource Partner
# When prompted for title attribute, enter: name

php artisan make:filament-resource GalleryItem
# When prompted for title attribute, leave blank or enter: title

php artisan make:filament-resource BlogPost
# When prompted for title attribute, enter: title

php artisan make:filament-resource Subscriber
# When prompted for title attribute, enter: name

php artisan make:filament-resource PartnerInquiry
# When prompted for title attribute, enter: organization_name
```

Then customize each resource following the pattern in `ProjectResource.php`.

## Views to Create

The following views still need to be created (controllers are ready):

- `resources/views/projects/index.blade.php`
- `resources/views/projects/show.blade.php`
- `resources/views/testimonials/index.blade.php`
- `resources/views/partnerships/index.blade.php`
- `resources/views/gallery/index.blade.php`
- `resources/views/blog/index.blade.php`
- `resources/views/blog/show.blade.php`
- `resources/views/subscribers/create.blade.php`

You can use the `home.blade.php` and `about.blade.php` as templates for styling consistency.

## Mentorship Integration

The mentorship program at https://wif.piu.ac.ug/ is integrated in:
- Main navigation (button)
- Homepage hero section
- Footer links
- About page CTA section

All links open in a new tab to keep users on the main site.

## Brand Colors

All brand colors are defined in `resources/css/app.css`:
- Primary: `#da3322`
- Secondary: `#009c84`
- Accent Yellow: `#fbd14f`
- Accent Orange: `#f28615`
- Text Dark: `#390e01`, `#4f1301`

## Next Steps

1. Complete remaining Filament resources
2. Create remaining view files
3. Add image optimization
4. Set up email notifications
5. Add SEO meta tags
6. Implement caching
7. Add social media sharing
8. Set up analytics

