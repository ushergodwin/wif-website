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

@section('content')
<!-- Project Detail -->
<section class="section-padding">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $project->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                @if($project->featured_image)
                <img src="{{ $project->featured_image_url }}" class="img-fluid rounded mb-4" alt="{{ $project->title }}">
                @endif
                
                <h1 class="mb-4">{{ $project->title }}</h1>
                
                <div class="project-content">
                    <h3 class="text-primary mb-3">Description</h3>
                    <div class="mb-4">
                        {!! $project->description !!}
                    </div>
                    
                    @if($project->objectives)
                    <h3 class="text-primary mb-3">Objectives</h3>
                    <div class="mb-4">
                        {!! $project->objectives !!}
                    </div>
                    @endif
                    
                    @if($project->target_beneficiaries)
                    <h3 class="text-primary mb-3">Target Beneficiaries</h3>
                    <div class="mb-4">
                        {!! $project->target_beneficiaries !!}
                    </div>
                    @endif
                    
                    @if($project->activities)
                    <h3 class="text-primary mb-3">Activities</h3>
                    <div class="mb-4">
                        {!! $project->activities !!}
                    </div>
                    @endif
                    
                    @if($project->impact_summary)
                    <h3 class="text-primary mb-3">Impact Summary</h3>
                    <div class="mb-4">
                        {!! $project->impact_summary !!}
                    </div>
                    @endif
                </div>
                
                @if($project->gallery_images_urls && count($project->gallery_images_urls) > 0)
                <div class="project-gallery mt-5">
                    <h3 class="text-primary mb-3">Gallery</h3>
                    <div class="row">
                        @foreach($project->gallery_images_urls as $imageUrl)
                        <div class="col-md-4 mb-3">
                            <img src="{{ $imageUrl }}" class="img-fluid rounded" alt="Gallery Image">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Project Information</h5>
                        @if($project->video_url)
                        <div class="mb-3">
                            <a href="{{ $project->video_url }}" target="_blank" class="btn btn-primary w-100">
                                <i class="fas fa-video me-2"></i>Watch Video
                            </a>
                        </div>
                        @endif
                        <div class="d-grid gap-2">
                            <a href="{{ route('subscribers.create') }}" class="btn btn-secondary">
                                <i class="fas fa-user-plus me-2"></i>Join This Program
                            </a>
                            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Projects
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

