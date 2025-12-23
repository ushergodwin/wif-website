<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\PageHero;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $hero = PageHero::where('page_slug', 'projects')
            ->where('is_active', true)
            ->first();
            
        $projects = Project::where('is_active', true)
            ->orderBy('order')
            ->paginate(12);

        return view('projects.index', compact('hero', 'projects'));
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('projects.show', compact('project'));
    }
}
