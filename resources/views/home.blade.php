@extends('layouts.app')

@section('title', 'Home - Women in Film Organization')
@push('meta')
    <meta name="description" content="Women in Film (WIF) empowers women in the Ugandan film industry through mentorship, training, access to funding, and advocacy. Join our community and explore our programs.">
    <meta name="keywords" content="women in film, uganda film industry, film training, film mentorship, women filmmakers, african cinema">
    <meta property="og:title" content="Women in Film Organization - Empowering Women in Ugandan Film Industry">
    <meta property="og:description" content="Join Women in Film (WIF) in building a dynamic and equitable African film industry where women thrive as creators, leaders, and innovators.">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta name="twitter:title" content="Women in Film Organization - Empowering Women in Ugandan Film Industry">
    <meta name="twitter:description" content="Join Women in Film (WIF) in building a dynamic and equitable African film industry where women thrive as creators, leaders, and innovators.">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/logo.png'))">
@endpush

@section('content')
<!-- Hero Carousel -->
@if($carouselItems->count() > 0)
<section class="hero-carousel">
    <div id="homeCarousel" class="carousel slide carousel-fade" data-bs-ride="true" data-bs-interval="3000">
        <div class="carousel-indicators">
            @foreach($carouselItems as $index => $item)
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($carouselItems as $index => $item)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ $item->image_url }}" class="d-block w-100" alt="Carousel Image {{ $index + 1 }}">
                <div class="carousel-overlay">
                    <div class="container">
                        <div class="carousel-content">
                            @if($item->overlay_text)
                                <h1 class="carousel-title animate__animated animate__slideInUp">{{ strip_tags($item->overlay_text) }}</h1>
                            @endif
                            @if($item->button_text && $item->button_url)
                            <a href="{{ $item->button_url }}"
                               class="btn btn-accent-yellow btn-lg animate__animated animate__fadeInUp"
                               @if(filter_var($item->button_url, FILTER_VALIDATE_URL)) target="_blank" rel="noopener noreferrer" @endif>
                                {{ $item->button_text }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($carouselItems->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        @endif
    </div>
</section>
@else
<!-- Fallback Hero Section if no carousel items -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1>Empowering Women in Film</h1>
                <p class="lead mb-2">Building a dynamic and equitable African film industry where women thrive as creators, leaders, and innovators.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('subscribers.create') }}" class="btn btn-accent-yellow btn-lg">Join Our Community</a>
                    <a href="{{ route('partnerships.index') }}" class="btn btn-outline-light btn-lg">Partner With Us</a>
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-light btn-lg">Explore Our Projects</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- About Snapshot -->
@if(isset($pageSections['about-snapshot']))
@php $section = $pageSections['about-snapshot']; @endphp
<section class="section-padding {{ $section->background_color == 'light' ? 'bg-light' : ($section->background_color == 'primary' ? 'bg-primary text-white' : ($section->background_color == 'secondary' ? 'bg-secondary text-white' : '')) }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                @if($section->title)
                <h2 class="mb-2">{{ $section->title }}</h2>
                @endif
                @if($section->subtitle)
                <p class="lead">{{ $section->subtitle }}</p>
                @endif
                @if($section->content)
                <div>{!! $section->content !!}</div>
                @endif
                <a href="{{ route('about') }}" class="btn btn-primary mt-1 mb-2">Learn More</a>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                @if($section->image)
                <img src="{{ $section->image_url }}" alt="{{ $section->title ?? 'About WIF' }}" class="img-fluid rounded">
                @else
                <img src="https://via.placeholder.com/500x400/009c84/ffffff?text=About+WIF" alt="About WIF" class="img-fluid rounded">
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Featured Projects -->
<section class="section-padding">
    <div class="container">
        <div class="row mb-2 animate__animated animate__fadeIn">
            <div class="col-12 text-center">
                @if(isset($pageSections['featured-projects']))
                <h2>{{ $pageSections['featured-projects']->title ?? 'Featured Projects' }}</h2>
                @if($pageSections['featured-projects']->subtitle)
                <p class="text-muted">{{ $pageSections['featured-projects']->subtitle }}</p>
                @else
                <p class="text-muted">Discover our impactful programs and initiatives</p>
                @endif
                @else
                <h2>Featured Projects</h2>
                <p class="text-muted">Discover our impactful programs and initiatives</p>
                @endif
            </div>
        </div>
        <div class="row">
            @forelse($featuredProjects as $project)
            <div class="col-md-4 mb-2">
                <div class="card h-100 animate__animated animate__fadeIn">
                    @if($project->featured_image_url)
                    <img src="{{ $project->featured_image_url }}" class="card-img-top" alt="{{ $project->title }}">
                    @else
                    <img src="https://via.placeholder.com/400x250/4f1301/ffffff?text={{ urlencode($project->title) }}" class="card-img-top" alt="{{ $project->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ Str::limit(strip_tags($project->description), 100) }}</p>
                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info border-start border-4">
                    <i class="fas fa-info-circle me-2"></i>No featured projects at the moment. Check back soon!
                </div>
            </div>
            @endforelse
        </div>
        <div class="text-center">
            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">View All Projects</a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row mb-2 animate__animated animate__fadeIn">
            <div class="col-12 text-center">
                @if(isset($pageSections['testimonials']))
                <h2>{{ $pageSections['testimonials']->title ?? 'What Our Participants Say' }}</h2>
                @if($pageSections['testimonials']->subtitle)
                <p class="text-muted">{{ $pageSections['testimonials']->subtitle }}</p>
                @else
                <p class="text-muted">Women who have benefited from our program</p>
                @endif
                @else
                <h2>What Our Participants Say</h2>
                <p class="text-muted">Women who have benefited from our program</p>
                @endif
            </div>
        </div>
        <div class="row">
            @forelse($testimonials as $index => $testimonial)
            @php
                $colorClass = ['testimonial-card-1', 'testimonial-card-2', 'testimonial-card-3'][$index % 3];
            @endphp
            <div class="col-md-4 mb-2">
                <div class="card shadow h-100 animate__animated animate__slideInUp {{ $colorClass }}">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                @if($testimonial->photo_url)
                                    <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->participant_name }}" class="rounded me-3" width="80" height="80" style="object-fit:cover;">
                                @else
                                    <div class="rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(255,255,255,0.25);">
                                        <span style="font-size:1.5rem;font-weight:700;">{{ substr($testimonial->participant_name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>{{ $testimonial->participant_name }}</h5>
                                @if($testimonial->role)
                                <p class="mb-0"><small>{{ $testimonial->role }}</small></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr class="opacity-25"/>
                    <div class="card-body">
                        {{ Str::limit(strip_tags($testimonial->testimonial_text), 150) }}
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
        <div class="text-center mt-2">
            <a href="{{ route('testimonials.index') }}" class="btn btn-outline-primary">Read All Testimonials</a>
        </div>
    </div>
</section>

<!-- Partners Slider -->
<section class="section-padding partners-slider-section">
    <div class="container">
        <div class="row mb-2 animate__animated animate__fadeIn">
            <div class="col-12 text-center">
                @if(isset($pageSections['partners']))
                <h2>{{ $pageSections['partners']->title ?? 'Our Partners' }}</h2>
                @if($pageSections['partners']->subtitle)
                <p class="text-muted">{{ $pageSections['partners']->subtitle }}</p>
                @else
                <p class="text-muted">Organizations supporting our mission</p>
                @endif
                @else
                <h2>Our Partners</h2>
                <p class="text-muted">Organizations supporting our mission</p>
                @endif
            </div>
        </div>
    </div>

    @if($partners->count() > 0)
    <div class="partners-track-wrapper">
        <div class="partners-track">
            {{-- First pass --}}
            @foreach($partners as $partner)
            <div class="partners-track-item">
                <div class="partner-logo-wrapper" style="width:160px;">
                    @if($partner->logo_url)
                    <a href="{{ $partner->website_url ?? '#' }}"
                       target="{{ $partner->website_url ? '_blank' : '_self' }}"
                       rel="noopener noreferrer"
                       class="partner-logo-link">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name ?? 'Partner' }}" class="partner-logo-img">
                    </a>
                    @else
                    <div class="partner-logo-placeholder">
                        <span>{{ $partner->name ?? 'Partner' }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            {{-- Duplicate for seamless loop --}}
            @foreach($partners as $partner)
            <div class="partners-track-item" aria-hidden="true">
                <div class="partner-logo-wrapper" style="width:160px;">
                    @if($partner->logo_url)
                    <a href="{{ $partner->website_url ?? '#' }}"
                       target="{{ $partner->website_url ? '_blank' : '_self' }}"
                       rel="noopener noreferrer"
                       class="partner-logo-link">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name ?? 'Partner' }}" class="partner-logo-img">
                    </a>
                    @else
                    <div class="partner-logo-placeholder">
                        <span>{{ $partner->name ?? 'Partner' }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</section>

<!-- Latest Blog Posts — Swiper Slider -->
<section class="section-padding bg-light shadow">
    <div class="container">
        <div class="row mb-2 animate__animated animate__fadeIn">
            <div class="col-12 text-center">
                @if(isset($pageSections['latest-news']))
                <h2>{{ $pageSections['latest-news']->title ?? 'Latest News & Updates' }}</h2>
                @if($pageSections['latest-news']->subtitle)
                <p class="text-muted">{{ $pageSections['latest-news']->subtitle }}</p>
                @else
                <p class="text-muted">Stay informed about our activities and achievements</p>
                @endif
                @else
                <h2>Latest News & Updates</h2>
                <p class="text-muted">Stay informed about our activities and achievements</p>
                @endif
            </div>
        </div>

        @if($latestPosts->count() > 0)
        <div class="position-relative blog-swiper-wrap">
            <div class="swiper blog-swiper">
                <div class="swiper-wrapper">
                    @foreach($latestPosts as $post)
                    <div class="swiper-slide">
                        <div class="card h-100 blog-slide-card">
                            <div class="blog-slide-img">
                                @if($post->featured_image_url)
                                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" loading="lazy">
                                @else
                                <div class="blog-slide-img-fallback"><i class="fas fa-newspaper"></i></div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-secondary mb-2 align-self-start">{{ ucfirst($post->category) }}</span>
                                <h6 class="card-title blog-slide-title">{{ $post->title }}</h6>
                                <p class="card-text blog-slide-excerpt">{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 80) }}</p>
                                <div class="mt-auto pt-2">
                                    <small class="text-muted">{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</small>
                                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary btn-sm">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Nav arrows -->
            <div class="blog-swiper-prev swiper-nav-btn"><i class="fas fa-chevron-left"></i></div>
            <div class="blog-swiper-next swiper-nav-btn"><i class="fas fa-chevron-right"></i></div>
        </div>
        @else
        <div class="alert alert-info border-start border-4">
            <i class="fas fa-info-circle me-2"></i>No blog posts available at the moment.
        </div>
        @endif

        <div class="text-center mt-2">
            <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">View All Posts</a>
        </div>
    </div>
</section>

<!-- Join Community Section -->
<section class="section-padding bg-primary text-white animate__animated animate__slideInDown">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                @if(isset($pageSections['join-community']))
                <h2 class="mb-2">{{ $pageSections['join-community']->title ?? 'Join Our Community' }}</h2>
                @if($pageSections['join-community']->subtitle)
                <p class="lead mb-2">{{ $pageSections['join-community']->subtitle }}</p>
                @elseif($pageSections['join-community']->content)
                <div class="lead mb-2">{!! $pageSections['join-community']->content !!}</div>
                @else
                <p class="lead mb-2">Be part of a growing network of women filmmakers and creatives. Get access to training, mentorship, and opportunities.</p>
                @endif
                @else
                <h2 class="mb-2">Join Our Community</h2>
                <p class="lead mb-2">Be part of a growing network of women filmmakers and creatives. Get access to training, mentorship, and opportunities.</p>
                @endif
                <form action="{{ route('subscribers.store') }}" method="POST" class="row g-3 justify-content-center"
                id="join-community-form">
                    @csrf
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="col-md-4">
                        <select name="area_of_interest" class="form-select">
                            <option value="">Area of Interest</option>
                            <option value="acting">Acting</option>
                            <option value="directing">Directing</option>
                            <option value="producing">Producing</option>
                            <option value="screenwriting">Screenwriting</option>
                            <option value="cinematography">Cinematography</option>
                            <option value="editing">Editing</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-accent-yellow btn-lg">Join Now</button>
                    </div>
                </form>
                <div class="mt-2">
                    <p>Or explore our <a href="https://wif.piu.ac.ug/" target="_blank" class="text-white text-decoration-underline"><strong>Mentorship Program</strong></a> for personalized guidance.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<style>
/* Blog Swiper */
.blog-swiper-wrap { padding: 0 40px; }
.blog-swiper { overflow: hidden; }
.blog-slide-card {
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    overflow: hidden;
    height: 100%;
}
.blog-slide-img {
    height: 160px;
    overflow: hidden;
    background: var(--secondary);
}
.blog-slide-img img { width: 100%; height: 100%; object-fit: cover; }
.blog-slide-img-fallback {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, var(--secondary), #007a6b);
    color: rgba(255,255,255,0.5);
    font-size: 2.5rem;
}
.blog-slide-title {
    font-size: 0.95rem;
    font-weight: 700;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.blog-slide-excerpt {
    font-size: 0.82rem;
    color: #666;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}
/* Nav buttons */
.swiper-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 36px; height: 36px;
    border-radius: 50%;
    background: #fff;
    color: var(--primary);
    box-shadow: 0 2px 8px rgba(0,0,0,0.18);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
    font-size: 0.85rem;
}
.swiper-nav-btn:hover { background: var(--primary); color: #fff; }
.blog-swiper-prev { left: 0; }
.blog-swiper-next { right: 0; }
/* Remove text-shadow from carousel btn */
.carousel-content .btn { text-shadow: none !important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Force carousel auto-start
    var carouselEl = document.getElementById('homeCarousel');
    if (carouselEl) {
        new bootstrap.Carousel(carouselEl, { interval: 3000, ride: true });
    }

    // Blog Swiper
    new Swiper('.blog-swiper', {
        slidesPerView: 1,
        spaceBetween: 16,
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false, pauseOnMouseEnter: true },
        navigation: { prevEl: '.blog-swiper-prev', nextEl: '.blog-swiper-next' },
        breakpoints: {
            576:  { slidesPerView: 2 },
            992:  { slidesPerView: 3 },
            1200: { slidesPerView: 5 },
        },
    });

    handleFormSubmit('join-community-form', {
        successTitle: 'You\'re In!',
        successText: 'Welcome to our community! We look forward to keeping you informed.',
    });
});
</script>
@endpush
