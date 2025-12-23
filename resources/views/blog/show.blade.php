@extends('layouts.app')

@section('title', $post->title . ' - Women in Film Organization')
@push('meta')
    <meta name="description" content="{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 160) }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 160) }}">
    @if($post->featured_image)
    <meta property="og:image" content="{{ $post->featured_image_url }}">
    @endif
@endpush

@section('content')
<!-- Blog Post Detail -->
<section class="section-padding">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit(strip_tags($post->title), 30) }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <span class="badge bg-secondary mb-2">{{ ucfirst($post->category) }}</span>
                    <h1 class="mb-3">{{ strip_tags($post->title) }}</h1>
                    <p class="text-muted mb-4">
                        <i class="fas fa-calendar me-1"></i>{{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}
                    </p>
                    
                    @if($post->featured_image)
                    <img src="{{ $post->featured_image_url }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}">
                    @endif
                    
                    @if($post->excerpt)
                    <div class="lead mb-4">
                        {!! $post->excerpt !!}
                    </div>
                    @endif
                    
                    <div class="post-content">
                        {!! $post->content !!}
                    </div>
                </article>
            </div>
            
            <div class="col-lg-4">
                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Related Posts</h5>
                    </div>
                    <div class="card-body">
                        @foreach($relatedPosts as $related)
                        <div class="mb-3 pb-3 border-bottom">
                            <h6><a href="{{ route('blog.show', $related->slug) }}" class="text-decoration-none">{{ $related->title }}</a></h6>
                            <small class="text-muted">{{ $related->published_at ? $related->published_at->format('M d, Y') : $related->created_at->format('M d, Y') }}</small>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Back to Blog -->
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-arrow-left me-2"></i>Back to Blog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

