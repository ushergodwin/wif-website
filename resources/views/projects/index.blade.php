@extends('layouts.app')

@section('title', 'Projects - Women in Film Organization')
@push('meta')
    <meta name="description" content="Explore our projects and programs designed to empower women in the Ugandan film industry through training, mentorship, and advocacy.">
    <meta name="keywords" content="film projects, women in film programs, film training, film workshops, uganda film industry">
    <meta property="og:title" content="Projects - Women in Film Organization">
    <meta property="og:description" content="Discover our impactful programs and initiatives designed to empower women in film.">
@endpush

@push('styles')
<style>
    .projects-carousel-section {
        padding: 60px 0;
    }

    .project-slide-card {
        position: relative;
        min-height: 520px;
        display: flex;
        align-items: flex-end;
        overflow: hidden;
        border-radius: 16px;
        cursor: pointer;
    }

    .project-slide-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        transition: transform 0.6s ease;
    }

    .project-slide-card:hover .project-slide-bg {
        transform: scale(1.04);
    }

    .project-slide-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, transparent 25%, rgba(30,5,0,0.9) 100%);
    }

    .project-slide-content {
        position: relative;
        z-index: 2;
        padding: 2.5rem;
        color: white;
        width: 100%;
    }

    .project-slide-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.75rem;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
    }

    .project-slide-excerpt {
        font-size: 1.05rem;
        color: rgba(255,255,255,0.88);
        margin-bottom: 1.5rem;
        max-width: 650px;
        line-height: 1.7;
    }

    .project-event-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(251,209,79,0.2);
        border: 1px solid var(--accent-yellow);
        color: var(--accent-yellow);
        border-radius: 20px;
        padding: 0.3rem 0.85rem;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    /* Custom carousel controls */
    .projects-carousel .carousel-control-prev,
    .projects-carousel .carousel-control-next {
        width: 52px;
        height: 52px;
        background: rgba(218,51,34,0.85);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 1;
        transition: background 0.3s;
    }

    .projects-carousel .carousel-control-prev {
        left: 1.5rem;
    }

    .projects-carousel .carousel-control-next {
        right: 1.5rem;
    }

    .projects-carousel .carousel-control-prev:hover,
    .projects-carousel .carousel-control-next:hover {
        background: var(--primary);
    }

    .projects-carousel .carousel-control-prev-icon,
    .projects-carousel .carousel-control-next-icon {
        background-color: transparent;
        width: 24px;
        height: 24px;
    }

    .projects-carousel .carousel-indicators {
        bottom: -2rem;
    }

    .projects-carousel .carousel-indicators button {
        background-color: rgba(218,51,34,0.4);
        border-color: var(--primary);
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .projects-carousel .carousel-indicators button.active {
        background-color: var(--primary);
    }

    .projects-carousel-wrapper {
        padding-bottom: 3rem;
    }

    @media (max-width: 768px) {
        .project-slide-card {
            min-height: 380px;
        }
        .project-slide-title {
            font-size: 1.5rem;
        }
        .project-slide-content {
            padding: 1.5rem;
        }
    }
</style>
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

<!-- Projects Slider -->
<section class="projects-carousel-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="mb-3">Our Projects</h2>
                <p class="text-muted">Discover our impactful programs and initiatives designed to empower women in film</p>
            </div>
        </div>

        @if($projects->count() > 0)
        <div class="projects-carousel-wrapper">
            <div id="projectsCarousel" class="carousel slide projects-carousel" data-bs-ride="false">
                <div class="carousel-indicators">
                    @foreach($projects as $i => $project)
                    <button type="button" data-bs-target="#projectsCarousel"
                            data-bs-slide-to="{{ $i }}"
                            class="{{ $i === 0 ? 'active' : '' }}"
                            aria-label="Project {{ $i + 1 }}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach($projects as $i => $project)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        <div class="project-slide-card">
                            @if($project->featured_image_url)
                            <div class="project-slide-bg" style="background-image: url('{{ $project->featured_image_url }}');"></div>
                            @else
                            <div class="project-slide-bg" style="background: linear-gradient(135deg, var(--primary) 0%, var(--accent-orange) 100%);"></div>
                            @endif

                            <div class="project-slide-content">
                                @if($project->event_date)
                                <div class="project-event-badge">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $project->event_date->format('d M Y') }}
                                    @if($project->event_location) &mdash; {{ $project->event_location }} @endif
                                </div>
                                @endif

                                <h2 class="project-slide-title">{{ $project->title }}</h2>
                                <p class="project-slide-excerpt">{{ Str::limit(strip_tags($project->description), 180) }}</p>

                                <div class="d-flex flex-wrap gap-3">
                                    <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-accent-yellow">
                                        Learn More
                                    </a>
                                    @if($project->allow_applications)
                                    <a href="{{ route('projects.show', $project->slug) }}#apply" class="btn btn-outline-light">
                                        <i class="fas fa-pen me-1"></i>
                                        @if($project->application_deadline && $project->application_deadline->isPast())
                                            Applications Closed
                                        @else
                                            Apply / Sign Up
                                        @endif
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($projects->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#projectsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#projectsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                @endif
            </div>
        </div>
        @else
        <div class="col-12">
            <div class="alert alert-info border-start border-4">
                <i class="fas fa-info-circle me-2"></i>No projects available at the moment. Check back soon!
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
