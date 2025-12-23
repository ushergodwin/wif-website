<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\BlogPost;
use App\Models\CarouselItem;
use App\Models\PageSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $carouselItems = CarouselItem::where('is_active', true)
            ->orderBy('order')
            ->get();

        $featuredProjects = Project::where('is_featured', true)
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(3)
            ->get();

        $testimonials = Testimonial::where('is_featured', true)
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(3)
            ->get();

        $partners = Partner::where('is_active', true)
            ->orderBy('order')
            ->limit(6)
            ->get();

        $latestPosts = BlogPost::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Get page sections
        $pageSections = PageSection::where('page', 'home')
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->keyBy('section_key');

        return view('home', compact('carouselItems', 'featuredProjects', 'testimonials', 'partners', 'latestPosts', 'pageSections'));
    }
}
