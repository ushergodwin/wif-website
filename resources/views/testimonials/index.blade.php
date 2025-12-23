@extends('layouts.app')

@section('title', 'Testimonials - Women in Film Organization')
@push('meta')
    <meta name="description" content="Read testimonials from women who have benefited from our programs and initiatives in the Ugandan film industry.">
    <meta name="keywords" content="testimonials, women in film, film training success stories, uganda film industry">
    <meta property="og:title" content="Testimonials - Women in Film Organization">
    <meta property="og:description" content="Hear from women who have benefited from our programs and initiatives.">
@endpush

@section('content')
<!-- Page Hero -->
<x-page-hero :hero="$hero" />

@if(!$hero || !$hero->is_active)
<!-- Fallback Hero Section -->
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <h1 class="text-center">What Our Participants Say</h1>
    </div>
</section>
@endif

<!-- Testimonials Section -->
<section class="section-padding">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="mb-3">Testimonials</h2>
                <p class="text-muted">We live to inspire the next generation of female filmmakers and this is what people are saying about us.</p>
            </div>
        </div>
        <div class="row">
            @forelse($testimonials as $testimonial)
            <div class="col-md-6 mb-4">
                <div class="card h-100 testimonial-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            @if($testimonial->photo)
                            <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->participant_name }}" class="rounded-circle me-3" width="60" height="60" style="object-fit: cover;">
                            @else
                            <div class="rounded-circle me-3 bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                {{ substr($testimonial->participant_name, 0, 1) }}
                            </div>
                            @endif
                            <div class="flex-grow-1">
                                <h5 class="mb-1">{{ $testimonial->participant_name }}</h5>
                                <div class="d-flex gap-3">
                                    @if($testimonial->role)
                                        <p class="text-muted mb-1"><small>{{ $testimonial->role }}</small></p>
                                    @endif
                                    
                                    @if($testimonial->program_attended)
                                        <p class="text-primary mb-0"><small><i class="fas fa-certificate me-1"></i>{{ $testimonial->program_attended }}</small></p>
                                    @endif
                                </div>
                                <div class="social-links mb-1">
                                    <a href="{{ $testimonial->facebook_url }}" target="_blank"><i class="fab fa-facebook"></i></a>
                                    <a href="{{ $testimonial->twitter_url }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                    <a href="{{ $testimonial->instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ $testimonial->linkedin_url }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">{{ strip_tags($testimonial->testimonial_text) }}</p>
                        @if($testimonial->video_url)
                        <div class="mt-3">
                            <a href="{{ $testimonial->video_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-video me-1"></i>Watch Video
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info border-start border-4">
                    <i class="fas fa-info-circle me-2"></i>No testimonials available at the moment.
                </div>
            </div>
            @endforelse
        </div>
        
        @if($testimonials->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                {{ $testimonials->links() }}
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

