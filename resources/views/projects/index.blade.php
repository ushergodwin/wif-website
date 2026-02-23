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

    /* ── Scroll track ── */
    .projects-scroll-track-wrapper {
        position: relative;
    }

    .projects-scroll-track {
        display: flex;
        gap: 1.5rem;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        padding: 0.5rem 0.25rem 1.5rem; /* bottom for scrollbar clearance */
        /* hide scrollbar visually */
        scrollbar-width: none;
    }
    .projects-scroll-track::-webkit-scrollbar { display: none; }

    /* ── Individual card ── */
    .project-card {
        flex: 0 0 320px;
        scroll-snap-align: start;
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
        background: linear-gradient(135deg, var(--primary) 0%, #a82519 100%);
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
        /* clamp to 2 lines */
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
        /* clamp to 3 lines */
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

    /* ── Scroll arrow buttons ── */
    .scroll-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-60%); /* offset for the bottom padding */
        z-index: 10;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: none;
        background: #fff;
        color: var(--primary);
        box-shadow: 0 2px 12px rgba(0,0,0,0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
        font-size: 1rem;
    }
    .scroll-arrow:hover { background: var(--primary); color: #fff; }
    .scroll-arrow-left  { left: -22px; }
    .scroll-arrow-right { right: -22px; }
    .scroll-arrow.hidden { opacity: 0; pointer-events: none; }

    @media (max-width: 768px) {
        .project-card { flex: 0 0 280px; }
        .scroll-arrow { display: none; } /* touch scroll handles it */
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
            <!-- Arrows (hidden on mobile) -->
            <button class="scroll-arrow scroll-arrow-left hidden" id="scrollLeft" aria-label="Scroll left">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="scroll-arrow scroll-arrow-right" id="scrollRight" aria-label="Scroll right">
                <i class="fas fa-chevron-right"></i>
            </button>

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
    const track  = document.getElementById('projectsTrack');
    const btnLeft  = document.getElementById('scrollLeft');
    const btnRight = document.getElementById('scrollRight');
    if (!track || !btnLeft || !btnRight) return;

    const step = 400; // px per arrow click

    function updateArrows() {
        btnLeft.classList.toggle('hidden', track.scrollLeft <= 10);
        btnRight.classList.toggle('hidden', track.scrollLeft + track.clientWidth >= track.scrollWidth - 10);
    }

    btnLeft.addEventListener('click', () => { track.scrollBy({ left: -step, behavior: 'smooth' }); });
    btnRight.addEventListener('click', () => { track.scrollBy({ left: step, behavior: 'smooth' }); });
    track.addEventListener('scroll', updateArrows);
    updateArrows();

    // Drag-to-scroll (desktop mouse drag)
    let isDown = false, startX, scrollLeft;
    track.addEventListener('mousedown', e => { isDown = true; track.classList.add('dragging'); startX = e.pageX - track.offsetLeft; scrollLeft = track.scrollLeft; });
    track.addEventListener('mouseleave', () => { isDown = false; track.classList.remove('dragging'); });
    track.addEventListener('mouseup', () => { isDown = false; track.classList.remove('dragging'); });
    track.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - track.offsetLeft;
        track.scrollLeft = scrollLeft - (x - startX) * 1.5;
    });
});
</script>
@endpush
