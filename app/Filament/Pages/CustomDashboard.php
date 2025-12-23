<?php

namespace App\Filament\Pages;

use App\Models\BlogPost;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\GalleryItem;
use App\Models\Subscriber;
use App\Models\PartnerInquiry;
use Filament\Pages\Page;

class CustomDashboard extends Page
{
    protected string $view = 'filament.pages.custom-dashboard';

    protected static ?string $title = 'Website Overview';

    protected static ?string $slug = 'dashboard';

    protected static ?int $navigationSort = 1;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-home';
    }

    public function getStats(): array
    {
        return [
            [
                'label' => 'Total Blog Posts',
                'value' => BlogPost::count(),
                'description' => BlogPost::where('is_published', true)->count() . ' published',
                'icon' => 'heroicon-o-document-text',
                'color' => 'success',
            ],
            [
                'label' => 'Total Projects',
                'value' => Project::count(),
                'description' => Project::where('is_active', true)->count() . ' active',
                'icon' => 'heroicon-o-film',
                'color' => 'info',
            ],
            [
                'label' => 'Total Testimonials',
                'value' => Testimonial::count(),
                'description' => Testimonial::where('is_featured', true)->count() . ' featured',
                'icon' => 'heroicon-o-chat-bubble-left-right',
                'color' => 'warning',
            ],
            [
                'label' => 'Total Partners',
                'value' => Partner::count(),
                'description' => Partner::where('is_active', true)->count() . ' active',
                'icon' => 'heroicon-o-building-office',
                'color' => 'success',
            ],
            [
                'label' => 'Gallery Items',
                'value' => GalleryItem::count(),
                'description' => 'Total media items',
                'icon' => 'heroicon-o-photo',
                'color' => 'info',
            ],
            [
                'label' => 'Subscribers',
                'value' => Subscriber::count(),
                'description' => Subscriber::where('is_active', true)->count() . ' active',
                'icon' => 'heroicon-o-user-group',
                'color' => 'warning',
            ],
            [
                'label' => 'Partner Inquiries',
                'value' => PartnerInquiry::count(),
                'description' => 'Total partnership requests',
                'icon' => 'heroicon-o-envelope',
                'color' => 'danger',
            ],
        ];
    }

    public function getRecentPosts()
    {
        return BlogPost::latest()->limit(5)->get();
    }

    public function getRecentInquiries()
    {
        return PartnerInquiry::latest()->limit(5)->get();
    }
}

