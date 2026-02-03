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
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .project-hero-bg::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            to bottom,
            rgba(57, 14, 1, 0.1) 0%,
            rgba(57, 14, 1, 0.4) 50%,
            rgba(57, 14, 1, 0.85) 100%
        );
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
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 0;
    }

    .project-hero-fallback {
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent-orange) 100%);
    }

    /* Project Content Cards */
    .project-section-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .project-section-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .project-section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(218, 51, 34, 0.1);
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

    .project-section-content p:last-child {
        margin-bottom: 0;
    }

    /* Gallery Styles */
    .project-gallery-section {
        background: linear-gradient(135deg, rgba(218, 51, 34, 0.02) 0%, rgba(251, 209, 79, 0.02) 100%);
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
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .gallery-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .gallery-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to bottom,
            transparent 60%,
            rgba(57, 14, 1, 0.7) 100%
        );
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-card:hover img {
        transform: scale(1.08);
    }

    .gallery-card:hover::after {
        opacity: 1;
    }

    .gallery-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
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
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.1rem;
        margin-left: auto;
    }

    /* Breadcrumb Styling */
    .project-breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
    }

    .project-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .project-breadcrumb .breadcrumb-item a:hover {
        color: white;
    }

    .project-breadcrumb .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.7);
    }

    .project-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.5);
    }

    /* Back Button */
    .back-to-projects {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        background: rgba(218, 51, 34, 0.08);
        transition: all 0.3s ease;
    }

    .back-to-projects:hover {
        background: rgba(218, 51, 34, 0.15);
        color: var(--primary);
        transform: translateX(-4px);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .project-hero {
            min-height: 350px;
        }

        .project-hero-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .project-hero {
            min-height: 300px;
        }

        .project-hero-title {
            font-size: 1.65rem;
        }

        .project-section-card {
            padding: 1.5rem;
        }

        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
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
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb project-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($project->title, 40) }}</li>
                </ol>
            </nav>
            <h1 class="project-hero-title">{{ $project->title }}</h1>
        </div>
    </div>
</section>

<!-- Project Content -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-10 col-xl-8 mx-auto">
                <!-- Back Button -->
                <a href="{{ route('projects.index') }}" class="back-to-projects mb-4">
                    <i class="bi bi-arrow-left"></i>
                    Back to Projects
                </a>

                <!-- Description Card -->
                <div class="project-section-card">
                    <div class="project-section-header">
                        <div class="project-section-icon">
                            <i class="bi bi-file-text"></i>
                        </div>
                        <h2 class="project-section-title">About This Project</h2>
                    </div>
                    <div class="project-section-content">
                        {!! $project->description !!}
                    </div>
                </div>

                @if($project->objectives)
                <!-- Objectives Card -->
                <div class="project-section-card">
                    <div class="project-section-header">
                        <div class="project-section-icon">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h2 class="project-section-title">Objectives</h2>
                    </div>
                    <div class="project-section-content">
                        {!! $project->objectives !!}
                    </div>
                </div>
                @endif

                @if($project->target_beneficiaries)
                <!-- Target Beneficiaries Card -->
                <div class="project-section-card">
                    <div class="project-section-header">
                        <div class="project-section-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h2 class="project-section-title">Target Beneficiaries</h2>
                    </div>
                    <div class="project-section-content">
                        {!! $project->target_beneficiaries !!}
                    </div>
                </div>
                @endif

                @if($project->activities)
                <!-- Activities Card -->
                <div class="project-section-card">
                    <div class="project-section-header">
                        <div class="project-section-icon">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <h2 class="project-section-title">Activities</h2>
                    </div>
                    <div class="project-section-content">
                        {!! $project->activities !!}
                    </div>
                </div>
                @endif

                @if($project->impact_summary)
                <!-- Impact Summary Card -->
                <div class="project-section-card">
                    <div class="project-section-header">
                        <div class="project-section-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h2 class="project-section-title">Impact Summary</h2>
                    </div>
                    <div class="project-section-content">
                        {!! $project->impact_summary !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryCards = document.querySelectorAll('.gallery-card');
    const modalImg = document.getElementById('galleryModalImg');

    galleryCards.forEach(card => {
        card.addEventListener('click', function() {
            const imgSrc = this.getAttribute('data-img');
            modalImg.src = imgSrc;
        });
    });
});
</script>
@endif
@endsection
