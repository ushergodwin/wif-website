<?php

namespace App\Http\Controllers;

use App\Models\PageHero;
use App\Models\AdvisoryBoardMember;
use App\Models\BoardOfDirector;
use App\Models\PageSection;
use App\Models\WorkPlan;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function workPlan()
    {
        $workPlan = WorkPlan::where('is_active', true)
            ->with(['events' => fn($q) => $q->orderBy('date')->orderBy('order')])
            ->latest('year')
            ->first();

        $events = $workPlan ? $workPlan->events : collect();

        return view('work-plan', compact('workPlan', 'events'));
    }

    public function index()
    {
        $hero = PageHero::where('page_slug', 'about')
            ->where('is_active', true)
            ->first();

        $advisoryBoard = AdvisoryBoardMember::where('is_active', true)
            ->orderBy('order')
            ->get();

        $boardOfDirectors = BoardOfDirector::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Get page sections
        $pageSections = PageSection::where('page', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->keyBy('section_key');

        // Get preview events from the active work plan (first 4, sorted by date)
        $workPlan = WorkPlan::where('is_active', true)
            ->with(['events' => fn($q) => $q->orderBy('date')->orderBy('order')->limit(4)])
            ->latest('year')
            ->first();

        $previewEvents = $workPlan ? $workPlan->events : collect();

        return view('about', compact('hero', 'advisoryBoard', 'boardOfDirectors', 'pageSections', 'workPlan', 'previewEvents'));
    }
}
