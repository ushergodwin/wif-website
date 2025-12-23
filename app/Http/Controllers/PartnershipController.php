<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\PageHero;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    public function index()
    {
        $hero = PageHero::where('page_slug', 'partnerships')
            ->where('is_active', true)
            ->first();
            
        $partners = Partner::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('partnerships.index', compact('hero', 'partners'));
    }
}
