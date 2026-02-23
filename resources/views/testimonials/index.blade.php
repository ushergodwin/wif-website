@extends('layouts.app')

@section('title', 'Testimonials - Women in Film Organization')
@push('meta')
    <meta name="description" content="Read testimonials from women who have benefited from our programs and initiatives in the Ugandan film industry.">
    <meta name="keywords" content="testimonials, women in film, film training success stories, uganda film industry">
    <meta property="og:title" content="Testimonials - Women in Film Organization">
    <meta property="og:description" content="Hear from women who have benefited from our programs and initiatives.">
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<style>
    /* Featured Video */
    .testimonial-video-wrapper {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        border-radius: 12px;
    }
    .testimonial-video-wrapper iframe {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        border: 0;
    }

    /* Slider shell */
    .testimonials-swiper-section { padding: 60px 0 80px; }
    .swiper-testimonials { padding-bottom: 56px !important; }

    /* Card */
    .testimonial-slide-card {
        background: #fff;
        border-radius: 14px;
        padding: 1.75rem;
        height: 100%;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
    }
    .testimonial-slide-card .quote-icon {
        font-size: 3rem;
        line-height: 1;
        color: var(--primary);
        opacity: 0.18;
        font-family: Georgia, serif;
        margin-bottom: 0.25rem;
    }
    .testimonial-slide-card .testimonial-text {
        flex: 1;
        font-size: 0.95rem;
        line-height: 1.75;
        color: #444;
        margin-bottom: 1.25rem;
    }
    .testimonial-slide-card .author-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border-top: 1px solid rgba(0,0,0,0.06);
        padding-top: 1rem;
        margin-top: auto;
    }
    .testimonial-slide-card .author-avatar {
        width: 52px; height: 52px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }
    .testimonial-slide-card .author-initials {
        width: 52px; height: 52px;
        border-radius: 50%;
        background: var(--secondary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .testimonial-slide-card .author-name {
        font-weight: 700;
        font-size: 0.95rem;
        margin: 0 0 2px;
        color: var(--text-dark);
    }
    .testimonial-slide-card .author-meta {
        font-size: 0.78rem;
        color: #777;
        margin: 0;
    }
    .testimonial-slide-card .program-badge {
        display: inline-block;
        background: rgba(218,51,34,0.08);
        color: var(--primary);
        font-size: 0.72rem;
        padding: 2px 8px;
        border-radius: 20px;
        margin-top: 3px;
    }

    /* Swiper arrows */
    .swiper-button-prev, .swiper-button-next {
        color: var(--primary) !important;
        background: #fff;
        width: 44px !important;
        height: 44px !important;
        border-radius: 50%;
        box-shadow: 0 2px 12px rgba(0,0,0,0.15);
    }
    .swiper-button-prev::after, .swiper-button-next::after {
        font-size: 1rem !important;
        font-weight: 700;
    }

    /* Swiper dots */
    .swiper-pagination-bullet-active { background: var(--primary) !important; }
</style>
@endpush

@section('content')
<!-- Page Hero -->
<x-page-hero :hero="$hero" />

@if(!$hero || !$hero->is_active)
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <h1 class="text-center">What Our Participants Say</h1>
    </div>
</section>
@endif

{{-- Featured Video Section --}}
@if($featuredVideo && $featuredVideo->content)
@php
    $videoUrl = trim(strip_tags($featuredVideo->content));
    if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $videoUrl, $m)) {
        $embedUrl = 'https://www.youtube.com/embed/' . $m[1];
    } elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $videoUrl, $m)) {
        $embedUrl = 'https://www.youtube.com/embed/' . $m[1];
    } elseif (preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $m)) {
        $embedUrl = 'https://player.vimeo.com/video/' . $m[1];
    } else {
        $embedUrl = $videoUrl;
    }
@endphp
<section class="testimonials-video-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="mb-2" style="color: var(--accent-yellow);">
                    {{ $featuredVideo->title ?? 'Our Story in Video' }}
                </h2>
                @if($featuredVideo->subtitle)
                <p style="color: rgba(255,255,255,0.8);">{{ $featuredVideo->subtitle }}</p>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="testimonial-video-wrapper shadow-lg">
                    <iframe src="{{ $embedUrl }}"
                            allowfullscreen
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            title="{{ $featuredVideo->title ?? 'Featured Video' }}">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Testimonials Slider -->
<section class="testimonials-swiper-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3">Testimonials</h2>
            <p class="text-muted">We live to inspire the next generation of female filmmakers and this is what people are saying about us.</p>
        </div>

        @if($testimonials->count() > 0)
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                <div class="swiper-slide" style="height: auto;">
                    <div class="testimonial-slide-card">
                        <div class="quote-icon">&ldquo;</div>
                        <p class="testimonial-text">{{ strip_tags($testimonial->testimonial_text) }}</p>
                        <div class="author-row">
                            @if($testimonial->photo)
                            <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->participant_name }}" class="author-avatar">
                            @else
                            <div class="author-initials">{{ strtoupper(substr($testimonial->participant_name, 0, 1)) }}</div>
                            @endif
                            <div class="flex-grow-1">
                                <p class="author-name">{{ $testimonial->participant_name }}</p>
                                @if($testimonial->role)
                                <p class="author-meta">{{ $testimonial->role }}</p>
                                @endif
                                @if($testimonial->program_attended)
                                <span class="program-badge"><i class="fas fa-certificate me-1"></i>{{ $testimonial->program_attended }}</span>
                                @endif
                                <div class="social-links mt-1">
                                    @if($testimonial->facebook_url)
                                    <a href="{{ $testimonial->facebook_url }}" target="_blank"><i class="fab fa-facebook"></i></a>
                                    @endif
                                    @if($testimonial->twitter_url)
                                    <a href="{{ $testimonial->twitter_url }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                    @endif
                                    @if($testimonial->instagram_url)
                                    <a href="{{ $testimonial->instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                    @endif
                                    @if($testimonial->linkedin_url)
                                    <a href="{{ $testimonial->linkedin_url }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                    @endif
                                </div>
                                @if($testimonial->video_url)
                                <a href="{{ $testimonial->video_url }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="fas fa-video me-1"></i>Watch Video
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        @else
        <div class="alert alert-info border-start border-4">
            <i class="fas fa-info-circle me-2"></i>No testimonials available at the moment.
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.swiper-testimonials', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640:  { slidesPerView: 2, spaceBetween: 20 },
            1024: { slidesPerView: 3, spaceBetween: 24 },
        },
    });
});
</script>
@endpush
