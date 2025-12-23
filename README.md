# Women in Film Organization (WIF) - Website

A professional Laravel web application for the Women in Film Organization, empowering women in the Ugandan film industry.

## Features

-   **Dynamic Content Management**: Laravel Filament admin panel for easy content updates
-   **Responsive Design**: Bootstrap 5 with custom brand colors
-   **Core Pages**: Homepage, About, Projects, Testimonials, Partnerships, Gallery, Blog
-   **Community Features**: Subscriber signup, partner inquiry forms
-   **Mentorship Integration**: Direct links to the mentorship program at https://wif.piu.ac.ug/

## Brand Colors

-   Primary: `#da3322` (Punch/Red)
-   Secondary: `#009c84` (Persian Green)
-   Accent Yellow: `#fbd14f` (Dandelion)
-   Accent Orange: `#f28615` (Tango)
-   Text Dark: `#390e01` (Bean Brown), `#4f1301` (Indian Tan)

## Installation

1. **Clone the repository**

    ```bash
    cd wif-website
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Node dependencies**

    ```bash
    npm install
    ```

4. **Configure environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Update database credentials in `.env`**

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=wif_website
    DB_USERNAME=root
    DB_PASSWORD=ROOT@ADMIN
    ```

6. **Run migrations**

    ```bash
    php artisan migrate
    ```

7. **Create storage link**

    ```bash
    php artisan storage:link
    ```

8. **Create admin user**

    ```bash
    php artisan make:filament-user
    ```

9. **Build assets**

    ```bash
    npm run build
    ```

10. **Start development server**
    ```bash
    php artisan serve
    npm run dev
    ```

## Access Points

-   **Frontend**: http://localhost:8000
-   **Admin Panel**: http://localhost:8000/admin
-   **Mentorship Program**: https://wif.piu.ac.ug/

## Database Structure

### Models Created

-   **Pages**: Manage static page content
-   **Projects**: Programs and initiatives
-   **Testimonials**: Participant feedback
-   **Partners**: Partner organizations
-   **GalleryItems**: Photo/video gallery
-   **BlogPosts**: News and blog articles
-   **Subscribers**: Community members
-   **PartnerInquiries**: Partnership requests

## Filament Admin Resources

To create Filament resources for content management:

```bash
php artisan make:filament-resource Page
php artisan make:filament-resource Project
php artisan make:filament-resource Testimonial
php artisan make:filament-resource Partner
php artisan make:filament-resource GalleryItem
php artisan make:filament-resource BlogPost
php artisan make:filament-resource Subscriber
php artisan make:filament-resource PartnerInquiry
```

When prompted for the "title attribute", use:

-   Page: `title`
-   Project: `title`
-   Testimonial: `participant_name`
-   Partner: `name`
-   GalleryItem: `title` (or leave blank)
-   BlogPost: `title`
-   Subscriber: `name`
-   PartnerInquiry: `organization_name`

## Routes

### Frontend Routes

-   `/` - Homepage
-   `/about` - About Us page
-   `/projects` - Projects listing
-   `/projects/{slug}` - Individual project page
-   `/testimonials` - Testimonials listing
-   `/partnerships` - Partnerships page
-   `/gallery` - Photo gallery
-   `/blog` - Blog listing
-   `/blog/{slug}` - Individual blog post
-   `/join` - Community signup form

### Admin Routes

-   `/admin` - Filament admin panel

## Key Features Implementation

### 1. Homepage Sections

-   Hero with CTAs
-   About snapshot
-   Featured projects carousel
-   Testimonials slider
-   Partners logo grid
-   Community signup form
-   Latest blog posts

### 2. Content Management

All content is manageable through Filament admin panel:

-   WYSIWYG editors for rich content
-   Image uploads with optimization
-   Featured toggles for homepage display
-   Sortable ordering
-   Category/tag management

### 3. Mentorship Integration

The site includes prominent links to the mentorship program at https://wif.piu.ac.ug/ in:

-   Navigation menu
-   Homepage CTAs
-   About page
-   Footer

## Development Notes

-   Uses Bootstrap 5 for frontend styling
-   Custom CSS with brand colors in `resources/css/app.css`
-   Blade templates in `resources/views/`
-   Controllers in `app/Http/Controllers/`
-   Models in `app/Models/`

## Next Steps

1. Complete Filament resources for all models
2. Add image optimization
3. Implement newsletter functionality
4. Add social media integration
5. Set up email notifications
6. Add SEO optimization
7. Implement caching for better performance

## Support

For questions or issues, please contact the development team.
