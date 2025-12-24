@extends('layouts.app')

@section('title', 'About Us - Women in Film Organization')
@push('meta')
    <meta name="description" content="Learn about Women in Film Organization - our vision, mission, core values, and objectives. Empowering women in the Ugandan film industry through training, mentorship, and advocacy.">
    <meta name="keywords" content="about women in film, wif uganda, film organization, women empowerment, film industry uganda">
    <meta property="og:title" content="About Us - Women in Film Organization">
    <meta property="og:description" content="Learn about Women in Film Organization - our vision, mission, core values, and objectives in empowering women in the Ugandan film industry.">
    <meta name="twitter:title" content="About Us - Women in Film Organization">
    <meta name="twitter:description" content="Learn about Women in Film Organization - our vision, mission, core values, and objectives in empowering women in the Ugandan film industry.">
@endpush

@section('content')
<!-- Page Hero -->
<x-page-hero :hero="$hero" />

@if(!$hero || !$hero->is_active)
<!-- Fallback Hero Section -->
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <h1 class="text-center">About Women in Film</h1>
    </div>
</section>
@endif

<!-- Who We Are -->
<div class="container">
    <div class="row my-5">
        <div class="col-md-4 mt-3">
            @if(isset($pageSections['who-we-are']))
            @php $section = $pageSections['who-we-are']; @endphp
            <section class="card h-100 shadow">
                <div class="card-body">
                    @if($section->title)
                        <h2 class="mb-4 text-center text-secondary">{{ $section->title }}</h2>
                    @endif
                    @if($section->subtitle)
                        <p class="lead">{{ $section->subtitle }}</p>
                    @endif
                    @if($section->content)
                        <div>{!! $section->content !!}</div>
                    @endif
                </div>
            </section>
            @endif
        </div>
        
        <div class="col-md-4 mt-3">
            @if(isset($pageSections['vision']))
                @php $section = $pageSections['vision']; @endphp
                <section class="card h-100 shadow">
                    <div class="card-body">
                        @if($section->title)
                            <h2 class="mb-4 text-center text-primary">{{ $section->title }}</h2>
                        @endif
                        @if($section->subtitle)
                            <p class="lead">{{ $section->subtitle }}</p>
                        @endif
                        @if($section->content)
                            <div>{!! $section->content !!}</div>
                        @endif
                    </div>
                </section>
            @endif
        </div>

        <div class="col-md-4 mt-3">
            @if(isset($pageSections['mission']))
            @php $section = $pageSections['mission']; @endphp
            <section class="card h-100 shadow">
                <div class="card-body">
                    @if($section->title)
                        <h2 class="mb-4 text-center text-dark">{{ $section->title }}</h2>
                    @endif
                    @if($section->subtitle)
                        <p class="lead">{{ $section->subtitle }}</p>
                    @endif
                    @if($section->content)
                        <div>{!! $section->content !!}</div>
                    @endif
                </div>
            </section>
            @endif
        </div>
    </div>
</div>

<!-- Core Values -->
@if(isset($pageSections['core-values']))
@php $section = $pageSections['core-values']; @endphp
<section class="section-padding bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                @if($section->title)
                <h2 class="mb-4">{{ $section->title }}</h2>
                @endif
                @if($section->subtitle)
                <p class="text-muted">{{ $section->subtitle }}</p>
                @endif
            </div>
        </div>
        @if($section->items && count($section->items) > 0)
        <div class="row">
            @foreach($section->items as $index => $item)
            <div class="col-md-6 mb-4">
                <div class="card h-100 text-center shadow bg-secondary text-white">
                    <div class="card-body">
                        @if($item['title'] ?? null)
                        <h4 class="mb-3">{{ $index + 1 }}. {{ $item['title'] }}</h4>
                        @endif
                        @if($item['description'] ?? null)
                        <p>{{ $item['description'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif

<!-- Objectives -->
@if(isset($pageSections['objectives']))
@php $section = $pageSections['objectives']; @endphp
<section class="section-padding {{ $section->background_color == 'light' ? 'bg-light' : ($section->background_color == 'primary' ? 'bg-primary text-white' : ($section->background_color == 'secondary' ? 'bg-secondary text-white' : '')) }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if($section->title)
                <h2 class="mb-4">{{ $section->title }}</h2>
                @endif
                @if($section->subtitle)
                <p class="mb-4">{{ $section->subtitle }}</p>
                @endif
                @if($section->items && count($section->items) > 0)
                <div class="row">
                    @foreach($section->items as $index => $item)
                    <div class="card card-body shadow mb-3">
                        <div class="col-md-12 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <strong>{{ $index + 1 }}</strong>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    @if($item['title'] ?? null)
                                    <h5>{{ $item['title'] }}</h5>
                                    @endif
                                    @if($item['description'] ?? null)
                                    <p>{{ $item['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Work Plan -->
@if(isset($pageSections['work-plan']))
@php $section = $pageSections['work-plan']; @endphp
<section class="section-padding">
    <div class="container card card-body bg-dark text-white shadow">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if($section->title)
                <h2 class="mb-4">{{ $section->title }}</h2>
                @endif
                @if($section->subtitle)
                <p class="mb-4">{{ $section->subtitle }}</p>
                @endif
                @if($section->items && count($section->items) > 0)
                <ul class="list-unstyled">
                    @foreach($section->items as $item)
                    <li class="mb-3">
                        <i class="{{ $item['icon'] ?? 'fas fa-check-circle' }} text-primary me-2"></i>
                        {{ $item['title'] ?? $item['description'] ?? '' }}
                    </li>
                    @endforeach
                </ul>
                @elseif($section->content)
                <div>{!! $section->content !!}</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Board of Directors -->
@if($boardOfDirectors->count() > 0)
<section class="section-padding bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="mb-3">Board of Directors</h2>
                <p class="text-muted">Our leadership team guiding the organization</p>
            </div>
        </div>
        <div class="row">
            @foreach($boardOfDirectors as $director)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 text-center team-member-card shadow">
                    @if($director->photo)
                    <img src="{{ $director->photo_url }}" class="card-img-top team-member-photo" alt="{{ $director->name }}">
                    @else
                    <div class="team-member-placeholder">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $director->name }}</h5>
                        <p class="card-text text-muted">{{ $director->title }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Advisory Board -->
@if($advisoryBoard->count() > 0)
<section class="section-padding">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="mb-3">Advisory Board</h2>
                <p class="text-muted">Industry experts and advisors supporting our mission</p>
            </div>
        </div>
        <div class="row">
            @foreach($advisoryBoard as $member)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 text-center team-member-card">
                    @if($member->photo)
                    <img src="{{ $member->photo_url }}" class="card-img-top team-member-photo" alt="{{ $member->name }}">
                    @else
                    <div class="team-member-placeholder">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $member->name }}</h5>
                        <p class="card-text text-muted">{{ $member->title }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
@if(isset($pageSections['cta']))
@php $section = $pageSections['cta']; @endphp
<section class="section-padding {{ $section->background_color == 'primary' ? 'bg-primary text-white' : ($section->background_color == 'secondary' ? 'bg-secondary text-white' : ($section->background_color == 'light' ? 'bg-light' : '')) }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                @if($section->title)
                <h2 class="mb-4">{{ $section->title }}</h2>
                @endif
                @if($section->subtitle)
                <p class="lead mb-4">{{ $section->subtitle }}</p>
                @elseif($section->content)
                <div class="lead mb-4">{!! $section->content !!}</div>
                @endif
                @if($section->items && count($section->items) > 0)
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    @foreach($section->items as $item)
                    <a href="{{ $item['url'] ?? '#' }}" 
                       class="btn {{ $loop->first ? 'btn-accent-yellow' : 'btn-outline-light' }} btn-lg"
                       @if(isset($item['url']) && filter_var($item['url'], FILTER_VALIDATE_URL)) target="_blank" rel="noopener noreferrer" @endif>
                        {{ $item['title'] ?? $item['description'] ?? 'Button' }}
                    </a>
                    @endforeach
                </div>
                @else
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="{{ route('subscribers.create') }}" class="btn btn-accent-yellow btn-lg">Join Our Community</a>
                    <a href="{{ route('partnerships.index') }}" class="btn btn-outline-light btn-lg">Partner With Us</a>
                    <a href="https://wif.piu.ac.ug/" target="_blank" class="btn btn-outline-light btn-lg">Explore Mentorship</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif
@endsection



