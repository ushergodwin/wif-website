<?php

namespace App\Http\Controllers;

use App\Models\PageHero;
use App\Models\AdvisoryBoardMember;
use App\Models\BoardOfDirector;
use App\Models\PageSection;
use Illuminate\Http\Request;

class AboutController extends Controller
{
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
            
        return view('about', compact('hero', 'advisoryBoard', 'boardOfDirectors', 'pageSections'));
    }
}
