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

        $query = GalleryItem::where('is_active', true)
            ->select('id', 'title', 'description', 'image', 'project_id', 'year', 'order');

        // filled() checks that the value is non-empty, fixing the empty-string bug
        if ($request->filled('project')) {
            $query->where('project_id', $request->integer('project'));
        }

        if ($request->filled('year')) {
            $query->where('year', $request->integer('year'));
        }

        $galleryItems = $query
            ->orderBy('order')
            ->paginate(20)
            ->withQueryString(); // keeps filter params on pagination links

        $projects = Project::where('is_active', true)
            ->select('id', 'title')
            ->orderBy('title')
            ->get();

        $years = GalleryItem::where('is_active', true)
            ->whereNotNull('year')
            ->orderByDesc('year')
            ->distinct()
            ->pluck('year');

        return view('gallery.index', compact('hero', 'galleryItems', 'projects', 'years'));
    }
}
