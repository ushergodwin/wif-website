@extends('layouts.app')

@section('title', 'Projects - Women in Film Organization')
@push('meta')
    <meta name="description" content="Explore our projects and programs designed to empower women in the Ugandan film industry through training, mentorship, and advocacy.">
    <meta name="keywords" content="film projects, women in film programs, film training, film workshops, uganda film industry">
    <meta property="og:title" content="Projects - Women in Film Organization">
    <meta property="og:description" content="Discover our impactful programs and initiatives designed to empower women in film.">
@endpush

@section('content')
<!-- Page Hero -->
<x-page-hero :hero="$hero" />

@if(!$hero || !$hero->is_active)
<!-- Fallback Hero Section -->
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <h1 class="text-center">Our Projects & Programs</h1>
    </div>
</section>
@endif

<!-- Projects Section -->
<section class="section-padding">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="mb-3">Our Projects</h2>
                <p class="text-muted">Discover our impactful programs and initiatives designed to empower women in film</p>
            </div>
        </div>
        <div class="row">
            @forelse($projects as $project)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($project->featured_image)
                    <img src="{{ $project->featured_image_url }}" class="card-img-top" alt="{{ $project->title }}" style="height: 250px; object-fit: cover;">
                    @else
                    <img src="https://via.placeholder.com/400x250/da3322/ffffff?text={{ urlencode($project->title) }}" class="card-img-top" alt="{{ $project->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ Str::limit(strip_tags($project->description), 120) }}</p>
                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info border-start border-4">
                    <i class="fas fa-info-circle me-2"></i>No projects available at the moment. Check back soon!
                </div>
            </div>
            @endforelse
        </div>
        
        @if($projects->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                {{ $projects->links() }}
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

