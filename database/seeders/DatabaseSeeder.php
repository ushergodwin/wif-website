<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarouselItem;
use App\Models\PageHero;
use App\Models\AdvisoryBoardMember;
use App\Models\BoardOfDirector;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\BlogPost;
use App\Models\GalleryItem;
use App\Models\PageSection;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Carousel Items
        $this->seedCarouselItems();
        
        // Page Heroes
        $this->seedPageHeroes();
        
        // Board of Directors
        $this->seedBoardOfDirectors();
        
        // Advisory Board
        $this->seedAdvisoryBoard();
        
        // Projects
        $this->seedProjects();
        
        // Testimonials
        $this->seedTestimonials();
        
        // Partners
        $this->seedPartners();
        
        // Blog Posts
        $this->seedBlogPosts();
        
        // Gallery Items
        $this->seedGalleryItems();
        
        // Page Sections
        $this->seedPageSections();
    }
    
    private function seedCarouselItems()
    {
        $items = [
            [
                'image' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=1920&h=600&fit=crop',
                'overlay_text' => '<strong>Empowering Women in Film</strong><br>Building a dynamic and equitable African film industry',
                'button_text' => 'Join Our Community',
                'button_url' => '/join',
                'is_active' => true,
                'order' => 0,
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?w=1920&h=600&fit=crop',
                'overlay_text' => '<strong>Training & Mentorship</strong><br>Empowering the next generation of female filmmakers',
                'button_text' => 'Explore Programs',
                'button_url' => '/projects',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=1920&h=600&fit=crop',
                'overlay_text' => '<strong>Your Dreams Are Valid</strong><br>Pitch that film today and make your mark',
                'button_text' => 'Learn More',
                'button_url' => '/about',
                'is_active' => true,
                'order' => 2,
            ],
        ];
        
        foreach ($items as $item) {
            CarouselItem::updateOrCreate(
                ['image' => $item['image'], 'overlay_text' => $item['overlay_text']],
                $item
            );
        }
    }
    
    private function seedPageHeroes()
    {
        $heroes = [
            [
                'page_slug' => 'about',
                'image' => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?w=1920&h=400&fit=crop',
                'overlay_text' => 'About Women in Film',
                'is_active' => true,
            ],
            [
                'page_slug' => 'projects',
                'image' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=1920&h=400&fit=crop',
                'overlay_text' => 'Our Projects & Programs',
                'is_active' => true,
            ],
            [
                'page_slug' => 'testimonials',
                'image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=1920&h=400&fit=crop',
                'overlay_text' => 'What Our Participants Say',
                'is_active' => true,
            ],
            [
                'page_slug' => 'partnerships',
                'image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1920&h=400&fit=crop',
                'overlay_text' => 'Our Partners',
                'is_active' => true,
            ],
            [
                'page_slug' => 'gallery',
                'image' => 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=1920&h=400&fit=crop',
                'overlay_text' => 'Gallery',
                'is_active' => true,
            ],
            [
                'page_slug' => 'blog',
                'image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1920&h=400&fit=crop',
                'overlay_text' => 'News & Updates',
                'is_active' => true,
            ],
        ];
        
        foreach ($heroes as $hero) {
            PageHero::updateOrCreate(
                ['page_slug' => $hero['page_slug']],
                $hero
            );
        }
    }
    
    private function seedBoardOfDirectors()
    {
        $directors = [
            ['name' => 'Jesca Ahimbisibwe', 'title' => 'Director', 'photo' => 'https://i.pravatar.cc/400?img=1', 'is_active' => true, 'order' => 0],
            ['name' => 'Rujema Mutesi', 'title' => 'Project Lead', 'photo' => 'https://i.pravatar.cc/400?img=2', 'is_active' => true, 'order' => 1],
            ['name' => 'Theos Barham', 'title' => 'Associate Project Lead', 'photo' => 'https://i.pravatar.cc/400?img=3', 'is_active' => true, 'order' => 2],
            ['name' => 'Sarah Nakato', 'title' => 'Secretary', 'photo' => 'https://i.pravatar.cc/400?img=4', 'is_active' => true, 'order' => 3],
            ['name' => 'Grace Nalubega', 'title' => 'Treasurer', 'photo' => 'https://i.pravatar.cc/400?img=5', 'is_active' => true, 'order' => 4],
        ];
        
        foreach ($directors as $director) {
            BoardOfDirector::updateOrCreate(
                ['name' => $director['name'], 'title' => $director['title']],
                $director
            );
        }
    }
    
    private function seedAdvisoryBoard()
    {
        $members = [
            ['name' => 'Nana Kagga', 'title' => 'Acting Masterclass Instructor', 'photo' => 'https://i.pravatar.cc/400?img=6', 'is_active' => true, 'order' => 0],
            ['name' => 'Patience Nitumwesiga', 'title' => 'Film Producer & Advisor', 'photo' => 'https://i.pravatar.cc/400?img=7', 'is_active' => true, 'order' => 1],
            ['name' => 'Angela Kalule', 'title' => 'Cinematography Expert', 'photo' => 'https://i.pravatar.cc/400?img=8', 'is_active' => true, 'order' => 2],
            ['name' => 'Doreen Mirembe', 'title' => 'Screenwriting Consultant', 'photo' => 'https://i.pravatar.cc/400?img=9', 'is_active' => true, 'order' => 3],
        ];
        
        foreach ($members as $member) {
            AdvisoryBoardMember::updateOrCreate(
                ['name' => $member['name'], 'title' => $member['title']],
                $member
            );
        }
    }
    
    private function seedProjects()
    {
        $projects = [
            [
                'title' => 'Equip a Woman Program',
                'slug' => 'equip-a-woman-program',
                'description' => 'A comprehensive training program designed to equip women with essential filmmaking skills and knowledge.',
                'objectives' => 'To provide hands-on training in various aspects of film production including directing, producing, and technical skills.',
                'target_beneficiaries' => 'Women aged 18-45 interested in pursuing careers in filmmaking.',
                'activities' => 'Workshops, masterclasses, practical exercises, and mentorship sessions.',
                'impact_summary' => 'Over 200 women trained in the past year with many securing positions in the film industry.',
                'featured_image' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=800&h=500&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'order' => 0,
            ],
            [
                'title' => 'Monologue Challenge',
                'slug' => 'monologue-challenge',
                'description' => 'An annual competition that showcases the acting talents of women in the Ugandan film industry.',
                'objectives' => 'To discover and promote talented female actors while providing them with a platform to showcase their skills.',
                'target_beneficiaries' => 'Actresses and aspiring actresses of all ages.',
                'activities' => 'Auditions, training sessions, competition rounds, and awards ceremony.',
                'impact_summary' => 'Launched careers of 15+ actresses who are now working in major productions.',
                'featured_image' => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?w=800&h=500&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Film Workshops',
                'slug' => 'film-workshops',
                'description' => 'Regular workshops covering various aspects of filmmaking from pre-production to post-production.',
                'objectives' => 'To provide continuous learning opportunities and skill development for women in film.',
                'target_beneficiaries' => 'All women interested in filmmaking at any skill level.',
                'activities' => 'Monthly workshops, guest speakers, hands-on training, and networking sessions.',
                'impact_summary' => 'Over 500 participants have benefited from our workshops.',
                'featured_image' => 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=800&h=500&fit=crop',
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
        ];
        
        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['slug' => $project['slug']],
                $project
            );
        }
    }
    
    private function seedTestimonials()
    {
        $testimonials = [
            [
                'participant_name' => 'Rujema Mutesi',
                'role' => 'Actress',
                'program_attended' => 'Monologue Challenge',
                'testimonial_text' => 'I learned a lot, especially from the acting master classes from Ms Nana Kagga. She not only taught but also demonstrated different acting styles and how to work with your emotions and embrace the character you are portraying in the given film, I found it so powerful.',
                'photo' => 'https://i.pravatar.cc/400?img=2',
                'is_featured' => true,
                'is_active' => true,
                'order' => 0,
            ],
            [
                'participant_name' => 'Natukunda Fortunate',
                'role' => 'Film Producer',
                'program_attended' => 'Film Workshops',
                'testimonial_text' => 'I learned quite a lot from the workshops and I say; Never in my life had I ever thought I would be a film producer; But thanks to CinemaUG who organized the women in film workshops that exposed me and other women to other filmmakers that made me realize that it was possible. I finished my first project as a film producer.',
                'photo' => 'https://i.pravatar.cc/400?img=10',
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'participant_name' => 'Yvette Christine',
                'role' => 'Actress',
                'program_attended' => 'Equip a Woman Program',
                'testimonial_text' => 'I had fun through them as a passionate actor, I had space to interact with already established actresses in the film industry and had a one-on-one which I found interesting and helped to pick their minds on different topics.',
                'photo' => 'https://i.pravatar.cc/400?img=11',
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
        ];
        
        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['participant_name' => $testimonial['participant_name'], 'program_attended' => $testimonial['program_attended']],
                $testimonial
            );
        }
    }
    
    private function seedPartners()
    {
        $partners = [
            ['name' => 'CinemaUG', 'is_active' => true, 'order' => 0],
            ['name' => 'Uganda Film Festival', 'is_active' => true, 'order' => 1],
            ['name' => 'Pearl International University', 'is_active' => true, 'order' => 2],
            ['name' => 'National Film Board', 'is_active' => true, 'order' => 3],
        ];
        
        foreach ($partners as $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name']],
                $partner
            );
        }
    }
    
    private function seedBlogPosts()
    {
        $posts = [
            [
                'title' => 'Producers\' Workshop: Building the Future of Ugandan Film',
                'slug' => 'producers-workshop-building-future-ugandan-film',
                'excerpt' => 'On August 27, 2025, the National Producers Guild of Uganda convened filmmakers, producers, and partners for a workshop centered on building the future of Ugandan film.',
                'content' => '<p>On August 27, 2025, the National Producers Guild of Uganda convened filmmakers, producers, and partners for a workshop centered on building the future of Ugandan film. The event brought together industry leaders to discuss challenges and opportunities in the local film industry.</p><p>Key topics included funding strategies, distribution channels, and the importance of supporting women in film production roles.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=800&h=500&fit=crop',
                'category' => 'news',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Creative Sector Voices Amplified at the CEO Forum Retreat',
                'slug' => 'creative-sector-voices-amplified-ceo-forum-retreat',
                'excerpt' => 'The film and creative industry in Uganda continues to make its presence felt in national conversations on economic growth.',
                'content' => '<p>The film and creative industry in Uganda continues to make its presence felt in national conversations on economic growth. At the CEO Forum Retreat, representatives from Women in Film highlighted the economic potential of the creative sector and the need for greater investment in women-led projects.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800&h=500&fit=crop',
                'category' => 'news',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
        ];
        
        foreach ($posts as $post) {
            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
    }
    
    private function seedGalleryItems()
    {
        $items = [
            ['title' => 'Workshop Session', 'image' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=600&h=400&fit=crop', 'year' => 2024, 'category' => 'workshop', 'is_active' => true, 'order' => 0],
            ['title' => 'Monologue Challenge', 'image' => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?w=600&h=400&fit=crop', 'year' => 2024, 'category' => 'event', 'is_active' => true, 'order' => 1],
            ['title' => 'Film Production', 'image' => 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=600&h=400&fit=crop', 'year' => 2024, 'category' => 'production', 'is_active' => true, 'order' => 2],
        ];
        
        foreach ($items as $item) {
            GalleryItem::updateOrCreate(
                ['title' => $item['title'], 'image' => $item['image']],
                $item
            );
        }
    }
    
    private function seedPageSections()
    {
        // Homepage Sections
        $homeSections = [
            [
                'page' => 'home',
                'section_key' => 'about-snapshot',
                'section_type' => 'image_text',
                'title' => 'About Women in Film',
                'subtitle' => 'Women in Film (WIF) empowers women in the Ugandan film industry through mentorship, training, access to funding, and advocacy.',
                'content' => '<p>We strive to increase representation, foster professional growth, and create sustainable opportunities for women in all areas of filmmaking.</p>',
                'image' => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?w=500&h=400&fit=crop',
                'background_color' => 'light',
                'order' => 0,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'featured-projects',
                'section_type' => 'text',
                'title' => 'Featured Projects',
                'subtitle' => 'Discover our impactful programs and initiatives',
                'background_color' => 'white',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'testimonials',
                'section_type' => 'text',
                'title' => 'What Our Participants Say',
                'subtitle' => 'Hear from women who have benefited from our programs',
                'background_color' => 'light',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'partners',
                'section_type' => 'text',
                'title' => 'Our Partners',
                'subtitle' => 'Organizations supporting our mission',
                'background_color' => 'white',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'join-community',
                'section_type' => 'cta',
                'title' => 'Join Our Community',
                'subtitle' => 'Be part of a growing network of women filmmakers and creatives. Get access to training, mentorship, and opportunities.',
                'background_color' => 'primary',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'section_key' => 'latest-news',
                'section_type' => 'text',
                'title' => 'Latest News & Updates',
                'subtitle' => 'Stay informed about our activities and achievements',
                'background_color' => 'light',
                'order' => 5,
                'is_active' => true,
            ],
        ];
        
        // About Page Sections
        $aboutSections = [
            [
                'page' => 'about',
                'section_key' => 'who-we-are',
                'section_type' => 'text',
                'title' => 'Who We Are',
                'subtitle' => 'Women in Film (WIF) is a Ugandan NGO dedicated to empowering women in the film industry through training, mentorship, and advocacy.',
                'content' => '<p>We are committed to breaking down barriers, challenging gender norms, and creating sustainable opportunities for women in all areas of filmmaking - from production and direction to screenwriting, editing, and beyond.</p>',
                'background_color' => 'white',
                'order' => 0,
                'is_active' => true,
            ],
            [
                'page' => 'about',
                'section_key' => 'vision',
                'section_type' => 'text',
                'title' => 'Our Vision',
                'subtitle' => 'To establish a dynamic and equitable African film industry where women thrive as creators, leaders, and innovators, shaping powerful narratives that inspire and transform society.',
                'background_color' => 'light',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'page' => 'about',
                'section_key' => 'mission',
                'section_type' => 'text',
                'title' => 'Our Mission',
                'subtitle' => 'Women in Film (WIF) empowers women in the Ugandan film industry through mentorship, training, access to funding, and advocacy.',
                'content' => '<p>We strive to increase representation, foster professional growth, and create sustainable opportunities for women in all areas of filmmaking.</p>',
                'background_color' => 'white',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'page' => 'about',
                'section_key' => 'core-values',
                'section_type' => 'values',
                'title' => 'Our Core Values',
                'items' => [
                    ['title' => 'Empowerment', 'description' => 'Equipping women with the skills, resources, and confidence to excel in the film industry.'],
                    ['title' => 'Inclusivity', 'description' => 'Ensuring diverse voices and perspectives are represented in all aspects of storytelling and production.'],
                    ['title' => 'Collaboration', 'description' => 'Building strong networks within the Ugandan and global film industries.'],
                    ['title' => 'Integrity', 'description' => 'Upholding ethical filmmaking practices and professionalism.'],
                    ['title' => 'Advocacy', 'description' => 'Championing policies and initiatives that support gender equality in film.'],
                ],
                'background_color' => 'light',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'page' => 'about',
                'section_key' => 'objectives',
                'section_type' => 'objectives',
                'title' => 'Our Objectives',
                'items' => [
                    ['title' => 'Empower Through Training', 'description' => 'Empower women through film training and skills development programs.'],
                    ['title' => 'Increase Participation', 'description' => 'Increase women\'s participation and leadership in film.'],
                    ['title' => 'Build Networks', 'description' => 'Build sustainable networks and opportunities for women in film.'],
                ],
                'background_color' => 'white',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'page' => 'about',
                'section_key' => 'work-plan',
                'section_type' => 'list',
                'title' => 'Work Plan (2026-2027)',
                'subtitle' => 'Our strategic focus areas for the coming years include:',
                'items' => [
                    ['title' => 'Capacity building through comprehensive training programs', 'icon' => 'fas fa-check-circle'],
                    ['title' => 'Advocacy for gender equality in the film industry', 'icon' => 'fas fa-check-circle'],
                    ['title' => 'Skills development workshops and masterclasses', 'icon' => 'fas fa-check-circle'],
                    ['title' => 'Strategic partnerships with industry stakeholders', 'icon' => 'fas fa-check-circle'],
                    ['title' => 'Mentorship programs connecting established professionals with emerging talent', 'icon' => 'fas fa-check-circle'],
                ],
                'background_color' => 'light',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'page' => 'about',
                'section_key' => 'cta',
                'section_type' => 'cta',
                'title' => 'Join Us in Our Mission',
                'subtitle' => 'Be part of the movement to empower women in film. Whether you\'re a filmmaker, supporter, or partner, there\'s a place for you.',
                'items' => [
                    ['title' => 'Join Our Community', 'url' => '/join'],
                    ['title' => 'Partner With Us', 'url' => '/partnerships'],
                    ['title' => 'Explore Mentorship', 'url' => 'https://wif.piu.ac.ug/'],
                ],
                'background_color' => 'primary',
                'order' => 6,
                'is_active' => true,
            ],
        ];
        
        foreach (array_merge($homeSections, $aboutSections) as $section) {
            PageSection::updateOrCreate(
                ['page' => $section['page'], 'section_key' => $section['section_key']],
                $section
            );
        }
    }
}
