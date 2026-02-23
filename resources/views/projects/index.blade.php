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
    /* ── Section wrapper ── */
    .projects-scroll-section { padding: 60px 0; }

    /* ── Scroll track wrapper (clips the animated belt) ── */
    .projects-scroll-track-wrapper {
        overflow: hidden;
    }

    /* ── Scroll track (auto-scrolling belt) ── */
    @keyframes scrollProjects {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .projects-scroll-track {
        display: flex;
        gap: 1.5rem;
        padding: 0.5rem 0 1rem;
        animation: scrollProjects 30s linear infinite;
        will-change: transform;
    }
    .projects-scroll-track:hover {
        animation-play-state: paused;
    }

    /* ── Individual card ── */
    .project-card {
        flex: 0 0 320px;
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,0.09);
        border: 1px solid rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.14);
    }

    /* ── Card image ── */
    .project-card-img {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .project-card-img img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .project-card:hover .project-card-img img { transform: scale(1.06); }
    .project-card-img-fallback {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, var(--primary) 0%, #390e01 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .project-card-img-fallback i { font-size: 3rem; color: rgba(255,255,255,0.5); }

    /* ── Card body ── */
    .project-card-body {
        padding: 1.25rem 1.25rem 1rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .project-event-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--primary);
        background: rgba(218,51,34,0.07);
        border-radius: 20px;
        padding: 3px 10px;
        margin-bottom: 0.6rem;
        width: fit-content;
    }

    .project-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .project-card-excerpt {
        font-size: 0.875rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 1rem;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .project-card-footer {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid rgba(0,0,0,0.06);
        margin-top: auto;
    }

    @media (max-width: 768px) {
        .project-card { flex: 0 0 280px; }
    }

    @media (min-width: 1200px) {
        .project-card { flex: 0 0 360px; }
    }
</style>
@endpush

@section('content')
<!-- Page Hero -->
<x-page-hero :hero="$hero" />

@if(!$hero || !$hero->is_active)
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <h1 class="text-center">Our Projects & Programs</h1>
    </div>
</section>
@endif

<!-- Projects Horizontal Scroll -->
<section class="projects-scroll-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3">Our Projects</h2>
            <p class="text-muted">Discover our impactful programs and initiatives designed to empower women in film</p>
        </div>

        @if($projects->count() > 0)
        <div class="projects-scroll-track-wrapper">
            <div class="projects-scroll-track" id="projectsTrack">
                @foreach($projects as $project)
                <div class="project-card">
                    <div class="project-card-img">
                        @if($project->featured_image_url)
                        <img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}" loading="lazy">
                        @else
                        <div class="project-card-img-fallback">
                            <i class="fas fa-film"></i>
                        </div>
                        @endif
                    </div>
                    <div class="project-card-body">
                        @if($project->event_date || $project->event_location)
                        <div class="project-event-badge">
                            <i class="fas fa-calendar-alt"></i>
                            @if($project->event_date){{ $project->event_date->format('d M Y') }}@endif
                            @if($project->event_location) &mdash; {{ $project->event_location }}@endif
                        </div>
                        @endif

                        <h3 class="project-card-title">{{ $project->title }}</h3>
                        <p class="project-card-excerpt">{{ strip_tags($project->description) }}</p>

                        <div class="project-card-footer">
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-primary btn-sm">
                                Learn More
                            </a>
                            @if($project->allow_applications)
                            <a href="{{ route('projects.show', $project->slug) }}#apply" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-pen me-1"></i>
                                @if($project->application_deadline && $project->application_deadline->isPast())
                                    Closed
                                @else
                                    Apply
                                @endif
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="alert alert-info border-start border-4">
            <i class="fas fa-info-circle me-2"></i>No projects available at the moment. Check back soon!
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var track = document.getElementById('projectsTrack');
    if (!track) return;
    // Duplicate cards so the CSS keyframe loop is seamless
    Array.from(track.children).forEach(function (card) {
        var clone = card.cloneNode(true);
        clone.setAttribute('aria-hidden', 'true');
        track.appendChild(clone);
    });
});
</script>
@endpush
