@extends('layouts.app')

@section('title', 'Blog & News - Women in Film Organization')
@push('meta')
    <meta name="description" content="Stay updated with the latest news, articles, and updates from Women in Film Organization.">
    <meta name="keywords" content="blog, news, film industry news, women in film updates, uganda film">
    <meta property="og:title" content="Blog & News - Women in Film Organization">
    <meta property="og:description" content="Stay updated with the latest news and updates from Women in Film.">
@endpush

@section('content')
<!-- Page Hero -->
<x-page-hero :hero="$hero" />

@if(!$hero || !$hero->is_active)
<!-- Fallback Hero Section -->
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <h1 class="text-center">News & Updates</h1>
    </div>
</section>
@endif

<!-- Blog Section -->
<section class="section-padding">
    <div class="container">
        <!-- Search and Filter -->
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET" action="{{ route('blog.index') }}" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Search posts..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="category" class="form-select" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            <option value="blog" {{ request('category') == 'blog' ? 'selected' : '' }}>Blog</option>
                            <option value="news" {{ request('category') == 'news' ? 'selected' : '' }}>News</option>
                            <option value="announcement" {{ request('category') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Blog Posts -->
        <div class="row">
            @forelse($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($post->featured_image)
                    <img src="{{ $post->featured_image_url }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                    @else
                    <img src="https://via.placeholder.com/400x200/009c84/ffffff?text=News" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        <span class="badge bg-secondary mb-2">{{ ucfirst($post->category) }}</span>
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 100) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Read More</a>
                    </div>
                    <div class="card-footer text-muted bg-transparent">
                        <small><i class="fas fa-calendar me-1"></i>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info border-start border-4">
                    <i class="fas fa-info-circle me-2"></i>No blog posts available at the moment.
                </div>
            </div>
            @endforelse
        </div>
        
        @if($posts->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                {{ $posts->links() }}
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

