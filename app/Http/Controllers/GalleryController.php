<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\Project;
use App\Models\PageHero;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $hero = PageHero::where('page_slug', 'gallery')
            ->where('is_active', true)
            ->first();
            
        $query = GalleryItem::where('is_active', true);

        if ($request->has('project')) {
            $query->where('project_id', $request->project);
        }

        if ($request->has('year')) {
            $query->where('year', $request->year);
        }

        $galleryItems = $query->orderBy('order')->paginate(20);
        $projects = Project::where('is_active', true)->get();
        $years = GalleryItem::where('is_active', true)
            ->whereNotNull('year')
            ->distinct()
            ->pluck('year')
            ->sort()
            ->reverse();

        return view('gallery.index', compact('hero', 'galleryItems', 'projects', 'years'));
    }
}
