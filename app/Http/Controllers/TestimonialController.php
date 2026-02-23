<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\PageHero;
use App\Models\PageSection;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $hero = PageHero::where('page_slug', 'testimonials')
            ->where('is_active', true)
            ->first();

        $featuredVideo = PageSection::where('page', 'testimonials')
            ->where('section_key', 'featured-video')
            ->where('is_active', true)
            ->first();

        $query = Testimonial::where('is_active', true);

        if ($request->has('program')) {
            $query->where('program_attended', $request->program);
        }

        $testimonials = $query->orderBy('order')->get();

        return view('testimonials.index', compact('hero', 'testimonials', 'featuredVideo'));
    }
}
