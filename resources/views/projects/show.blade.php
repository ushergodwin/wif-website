@extends('layouts.app')

@section('title', $project->title . ' - Women in Film Organization')
@push('meta')
    <meta name="description" content="{{ Str::limit(strip_tags($project->description), 160) }}">
    <meta property="og:title" content="{{ $project->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($project->description), 160) }}">
    @if($project->featured_image)
    <meta property="og:image" content="{{ $project->featured_image_url }}">
    @endif
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    /* Project Hero Section */
    .project-hero {
        position: relative;
        min-height: 450px;
        display: flex;
        align-items: flex-end;
        overflow: hidden;
    }

    .project-hero-bg {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .project-hero-bg::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, rgba(57,14,1,0.1) 0%, rgba(57,14,1,0.45) 50%, rgba(57,14,1,0.88) 100%);
    }

    .project-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 3rem 0;
    }

    .project-hero-title {
        color: white;
        font-size: 2.75rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        margin-bottom: 0.5rem;
    }

    .project-hero-fallback {
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent-orange) 100%);
    }

    .project-event-info {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(251,209,79,0.2);
        border: 1px solid var(--accent-yellow);
        color: var(--accent-yellow);
        border-radius: 20px;
        padding: 0.3rem 1rem;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    /* Content Cards */
    .project-section-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 2rem;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .project-section-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .project-section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(218,51,34,0.1);
    }

    .project-section-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent-orange) 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .project-section-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .project-section-content {
        color: var(--text-dark);
        line-height: 1.8;
    }

    .project-section-content p:last-child { margin-bottom: 0; }

    /* Video play button on hero */
    .video-play-btn {
        position: absolute;
        bottom: 2rem;
        right: 2rem;
        z-index: 3;
        width: 64px;
        height: 64px;
        border-radius: 50%;
        border: 3px solid rgba(255,255,255,0.85);
        background: rgba(0,0,0,0.35);
        backdrop-filter: blur(6px);
        color: white;
        font-size: 1.6rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.25s ease;
        padding: 0;
    }
    .video-play-btn:hover {
        background: var(--primary);
        border-color: white;
        transform: scale(1.1);
    }
    .video-play-btn .bi-play-fill { margin-left: 4px; } /* optical centre */

    /* Gallery */
    .project-gallery-section {
        background: linear-gradient(135deg, rgba(218,51,34,0.02) 0%, rgba(251,209,79,0.02) 100%);
        padding: 3rem 0;
        margin-top: 2rem;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.25rem;
    }

    .gallery-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 4/3;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .gallery-card img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .gallery-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, transparent 60%, rgba(57,14,1,0.7) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-card:hover img { transform: scale(1.08); }
    .gallery-card:hover::after { opacity: 1; }

    .gallery-card-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 1.25rem;
        z-index: 2;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .gallery-card:hover .gallery-card-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .gallery-zoom-icon {
        width: 40px; height: 40px;
        background: rgba(255,255,255,0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.1rem;
        margin-left: auto;
    }

    /* Back button */
    .back-to-projects {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        background: rgba(218,51,34,0.08);
        transition: all 0.3s ease;
    }

    .back-to-projects:hover {
        background: rgba(218,51,34,0.15);
        color: var(--primary);
        transform: translateX(-4px);
    }

    /* Application form */
    .apply-section {
        background: linear-gradient(135deg, var(--primary) 0%, #390e01 100%);
        border-radius: 16px;
        padding: 2.5rem;
        color: white;
        margin-bottom: 1.5rem;
    }

    .apply-section h2, .apply-section p { color: white !important; }

    .apply-section .form-control,
    .apply-section .form-select {
        background: rgba(255,255,255,0.95);
        border: none;
    }

    .deadline-badge {
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
        margin-bottom: 1rem;
    }

    /* Success alert */
    .alert-success-custom {
        background: rgba(0,156,132,0.1);
        border-left: 4px solid var(--secondary);
        color: var(--text-dark);
        border-radius: 8px;
        padding: 1rem 1.25rem;
    }

    @media (max-width: 991px) {
        .project-hero { min-height: 350px; }
        .project-hero-title { font-size: 2rem; }
    }

    @media (max-width: 576px) {
        .project-hero { min-height: 300px; }
        .project-hero-title { font-size: 1.65rem; }
        .project-section-card { padding: 1.5rem; }
        .gallery-grid { grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); }
        .apply-section { padding: 1.5rem; }
    }
</style>
@endpush

@section('content')
<!-- Project Hero Section -->
<section class="project-hero @if(!$project->featured_image) project-hero-fallback @endif">
    @if($project->featured_image)
    <div class="project-hero-bg" style="background-image: url('{{ $project->featured_image_url }}');"></div>
    @endif
    <div class="project-hero-content">
        <div class="container">
            @if($project->event_date || $project->event_location)
            <div class="project-event-info">
                <i class="bi bi-calendar-event"></i>
                @if($project->event_date) {{ $project->event_date->format('d M Y') }} @endif
                @if($project->event_location) &mdash; {{ $project->event_location }} @endif
            </div>
            @endif

            <h1 class="project-hero-title">{{ $project->title }}</h1>
        </div>
    </div>

    @if($project->video_embed_url)
    <button class="video-play-btn"
            data-bs-toggle="modal"
            data-bs-target="#videoModal"
            aria-label="Watch video">
        <i class="bi bi-play-fill"></i>
    </button>
    @endif
</section>

<!-- What's Happening / Announcement -->
@if($project->announcement_text)
<div class="project-announcement">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <p class="mb-0 fw-semibold">
                <i class="fas fa-bullhorn me-2 text-primary"></i>{{ $project->announcement_text }}
            </p>
            @if($project->announcement_link)
            <a href="{{ $project->announcement_link }}" target="_blank" rel="noopener noreferrer"
               class="btn btn-sm btn-primary flex-shrink-0">
                {{ $project->announcement_link_label ?: 'Latest Updates' }}
                <i class="fas fa-external-link-alt ms-1"></i>
            </a>
            @endif
        </div>
    </div>
</div>
@endif

<!-- Flash message -->
@if(session('success'))
<div class="container mt-4">
    <div class="alert-success-custom">
        <i class="bi bi-check-circle-fill text-success me-2"></i>{{ session('success') }}
    </div>
</div>
@endif

<!-- Project Content -->
<section class="section-padding">
    <div class="container">
        <!-- Back Button -->
        <a href="{{ route('projects.index') }}" class="back-to-projects mb-4 d-inline-flex">
            <i class="bi bi-arrow-left"></i>
            Back to Projects
        </a>

        <!-- Description Card -->
        <div class="project-section-card mt-3">
            <div class="project-section-header">
                <div class="project-section-icon"><i class="bi bi-file-text"></i></div>
                <h2 class="project-section-title">About This Project</h2>
            </div>
            <div class="project-section-content">
                {!! $project->description !!}
            </div>
        </div>

        {{-- Materials card --}}
        @if($project->materials->count() > 0)
        <div class="project-section-card">
            <div class="project-section-header">
                <div class="project-section-icon"><i class="bi bi-folder2-open"></i></div>
                <h2 class="project-section-title">Project Materials</h2>
                <span class="badge bg-secondary ms-auto">{{ $project->materials->count() }}</span>
            </div>
            <p class="text-muted mb-3">Guides, documents, and resources available for this project.</p>
            <div class="d-flex flex-wrap gap-2 mb-4">
                @foreach($project->materials->take(4) as $material)
                <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3 border" style="background:#f8f9fa;">
                    <i class="bi {{ $material->file_icon }}" style="color:{{ $material->file_color }};font-size:1.15rem;"></i>
                    <span class="small fw-semibold" style="max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $material->title }}</span>
                </div>
                @endforeach
                @if($project->materials->count() > 4)
                <div class="d-flex align-items-center px-3 py-2 text-muted small">
                    +{{ $project->materials->count() - 4 }} more
                </div>
                @endif
            </div>
            <a href="{{ route('projects.materials', $project->slug) }}" class="btn btn-primary">
                <i class="bi bi-folder2-open me-2"></i>View All Materials
            </a>
        </div>
        @endif

        @if($project->objectives)
        <div class="project-section-card">
            <div class="project-section-header">
                <div class="project-section-icon"><i class="bi bi-bullseye"></i></div>
                <h2 class="project-section-title">Objectives</h2>
            </div>
            <div class="project-section-content">{!! $project->objectives !!}</div>
        </div>
        @endif

        @if($project->target_beneficiaries)
        <div class="project-section-card">
            <div class="project-section-header">
                <div class="project-section-icon"><i class="bi bi-people"></i></div>
                <h2 class="project-section-title">Target Beneficiaries</h2>
            </div>
            <div class="project-section-content">{!! $project->target_beneficiaries !!}</div>
        </div>
        @endif

        @if($project->activities)
        <div class="project-section-card">
            <div class="project-section-header">
                <div class="project-section-icon"><i class="bi bi-list-check"></i></div>
                <h2 class="project-section-title">Activities</h2>
            </div>
            <div class="project-section-content">{!! $project->activities !!}</div>
        </div>
        @endif

        @if($project->impact_summary)
        <div class="project-section-card">
            <div class="project-section-header">
                <div class="project-section-icon"><i class="bi bi-graph-up-arrow"></i></div>
                <h2 class="project-section-title">Impact Summary</h2>
            </div>
            <div class="project-section-content">{!! $project->impact_summary !!}</div>
        </div>
        @endif

        {{-- Application / Sign-up Section --}}
        @if($project->allow_applications)
        @php
            $deadline = $project->application_deadline;
            $deadlinePassed = $deadline && $deadline->isPast();
        @endphp
        <div id="apply" class="apply-section">
            <h2 class="mb-2">
                <i class="bi bi-pen me-2"></i>Apply / Sign Up
            </h2>

            @if($deadline)
            <div class="deadline-badge">
                <i class="bi bi-clock"></i>
                @if($deadlinePassed)
                    Applications closed on {{ $deadline->format('d M Y') }}
                @else
                    Deadline: {{ $deadline->format('d M Y') }}
                @endif
            </div>
            @endif

            @if($deadlinePassed)
            <p class="opacity-75">Applications for this project/event are now closed.</p>
            @elseif($project->application_form_url)
            <p class="mb-4">Click the button below to access the application form.</p>
            <a href="{{ $project->application_form_url }}" target="_blank" rel="noopener noreferrer"
               class="btn btn-accent-yellow btn-lg">
                <i class="bi bi-box-arrow-up-right me-2"></i>Open Application Form
            </a>
            @else
            <p class="mb-4">Fill in the form below to register your interest or apply for this project/event.</p>
            @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('projects.apply', $project->slug) }}" method="POST" id="project-apply-form">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Full Name <span class="text-warning">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Your full name">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email Address <span class="text-warning">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="you@example.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Phone Number</label>
                        <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+256 ...">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Message / Motivation (optional)</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Tell us a bit about yourself and why you'd like to join...">{{ old('message') }}</textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-accent-yellow btn-lg">
                            <i class="bi bi-send me-2"></i>Submit Application
                        </button>
                    </div>
                </div>
            </form>
            @endif
        </div>
        @endif
    </div>
</section>

<!-- Video Modal -->
@if($project->video_embed_url)
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-black border-0">
            <div class="modal-header border-0 pb-0 px-3 pt-2">
                <span class="text-white fw-semibold small opacity-75">{{ $project->title }}</span>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2 pt-0">
                <div class="ratio ratio-16x9">
                    <iframe id="videoIframe"
                            src=""
                            data-src="{{ $project->video_embed_url }}"
                            allowfullscreen
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            title="{{ $project->title }} Video">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Gallery Section -->
@if($project->gallery_images_urls && count($project->gallery_images_urls) > 0)
<section class="project-gallery-section">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="mb-2" style="color: var(--text-dark);">
                <i class="bi bi-images text-primary me-2"></i>Project Gallery
            </h2>
            <p class="text-muted">Moments captured from this project</p>
        </div>

        <div class="gallery-grid">
            @foreach($project->gallery_images_urls as $index => $imageUrl)
            <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal" data-img="{{ $imageUrl }}">
                <img src="{{ $imageUrl }}" alt="Gallery Image {{ $index + 1 }}" loading="lazy">
                <div class="gallery-card-overlay">
                    <div class="gallery-zoom-icon">
                        <i class="bi bi-zoom-in"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 text-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 10;"></button>
                <img src="" id="galleryModalImg" class="img-fluid rounded" alt="Gallery Image" style="max-height: 85vh;">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryCards = document.querySelectorAll('.gallery-card');
    const modalImg = document.getElementById('galleryModalImg');
    galleryCards.forEach(card => {
        card.addEventListener('click', function() {
            modalImg.src = this.getAttribute('data-img');
        });
    });
});
</script>
@endpush
@endif

{{-- Video modal JS + apply form handler (outside gallery @if so they always load) --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Video modal: load src on open, stop video on close
    var videoModal = document.getElementById('videoModal');
    if (videoModal) {
        var iframe = document.getElementById('videoIframe');
        videoModal.addEventListener('show.bs.modal', function () {
            iframe.src = iframe.getAttribute('data-src');
        });
        videoModal.addEventListener('hide.bs.modal', function () {
            iframe.src = '';
        });
    }
});

handleFormSubmit('project-apply-form', {
    successTitle: 'Application Submitted!',
    successText: 'Your application has been received. We will be in touch soon.',
});
</script>
@endpush
@endsection
