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

@push('styles')
<style>
/* Suppress the global h2::after underline — this page uses .about-divider instead */
.section-padding h2::after,
.objectives-section h2::after { content: none !important; }

/* ── Shared helpers ── */
.about-alt-bg { background-color: #f0faf8; }

.about-section-label {
    display: inline-block;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--secondary);
    margin-bottom: 0.5rem;
}
.about-section-label.label-primary { color: var(--primary); }

.about-divider {
    width: 48px;
    height: 3px;
    border-radius: 2px;
    background: var(--secondary);
    margin: 0.75rem 0 1.5rem;
}
.about-divider.divider-primary { background: var(--primary); }
.about-divider.divider-white    { background: rgba(255,255,255,0.6); }
.about-divider.mx-auto          { margin-left: auto; margin-right: auto; }

/* ── Who We Are ── */
.who-card {
    border: none;
    border-left: 5px solid var(--secondary);
    border-radius: 0 16px 16px 0;
    box-shadow: 0 6px 30px rgba(0,0,0,0.07);
}
.who-card .card-body { padding: 2.25rem 2.5rem; }

/* ── Vision pull-quote ── */
.vision-quote-wrap {
    position: relative;
    background: white;
    border-radius: 16px;
    box-shadow: 0 6px 30px rgba(0,0,0,0.07);
    padding: 2.5rem 2.5rem 2.5rem 4rem;
    overflow: hidden;
}
.vision-quote-mark {
    position: absolute;
    top: -0.5rem;
    left: 1rem;
    font-size: 8rem;
    font-family: Georgia, serif;
    line-height: 1;
    color: var(--secondary);
    opacity: 0.12;
    pointer-events: none;
    user-select: none;
}
.vision-icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: var(--secondary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    margin-bottom: 1.25rem;
}

/* ── Mission ── */
.mission-card {
    border: none;
    box-shadow: 0 6px 30px rgba(0,0,0,0.07);
    border-radius: 16px;
    overflow: hidden;
}
.mission-accent-bar {
    height: 6px;
    background: linear-gradient(90deg, var(--primary) 0%, var(--accent-orange) 100%);
}
.mission-body { padding: 2.25rem 2.5rem; }
.mission-lead {
    font-size: 1.15rem;
    font-style: italic;
    border-left: 4px solid var(--primary);
    padding-left: 1.25rem;
    color: var(--text-dark);
}

/* ── Core Values ── */
.value-card {
    border: none;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    height: 100%;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.value-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}
.value-card-header {
    background: var(--primary);
    padding: 1.25rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.85rem;
}
.value-number {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.25);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.95rem;
}
.value-card-header h4 {
    margin: 0;
    color: white;
    font-size: 1rem;
    font-weight: 700;
}
.value-card-body {
    background: white;
    padding: 1.25rem 1.5rem;
}
.value-card-body p { margin: 0; font-size: 0.92rem; color: #555; }

/* ── Objectives on green ── */
.objectives-section {
    background: var(--secondary);
}
.objectives-section .about-section-label { color: rgba(255,255,255,0.7); }
.objectives-section h2 { color: white; }
.objectives-section > .container > p { color: rgba(255,255,255,0.85); }
.objective-item {
    display: flex;
    gap: 1.25rem;
    align-items: flex-start;
    padding: 1.25rem 1.5rem;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 12px;
    margin-bottom: 1rem;
    transition: background 0.2s ease;
}
.objective-item:hover { background: rgba(255,255,255,0.18); }
.objective-num {
    width: 44px;
    height: 44px;
    min-width: 44px;
    border-radius: 50%;
    background: white;
    color: var(--secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1rem;
    flex-shrink: 0;
}
.objective-item h5 { color: white; margin-bottom: 0.25rem; font-size: 1rem; }
.objective-item p  { color: rgba(255,255,255,0.85); margin: 0; font-size: 0.9rem; }

/* ── Team grid (fills available width evenly) ── */
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 2rem 1.25rem;
}

.team-member-item {
    text-align: center;
    cursor: default;
}
.team-avatar-wrap {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 0.85rem;
}
.team-avatar-wrap img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--secondary);
    display: block;
}
.team-avatar-placeholder {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    border: 3px solid var(--secondary);
}
.team-member-name {
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.2rem;
    line-height: 1.3;
}
.team-member-title {
    font-size: 0.76rem;
    color: #777;
    line-height: 1.3;
}
</style>
@endpush

@section('content')
<!-- Page Hero -->
<x-page-hero :hero="$hero" />

@if(!$hero || !$hero->is_active)
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <h1 class="text-center">About Women in Film</h1>
    </div>
</section>
@endif

<!-- (1) Who We Are — white bg -->
@if(isset($pageSections['who-we-are']))
@php $section = $pageSections['who-we-are']; @endphp
<section class="section-padding">
    <div class="container">
        <div class="who-card card">
            <div class="card-body">
                <span class="about-section-label">About Us</span>
                @if($section->title)
                <h2 class="mb-0">{{ $section->title }}</h2>
                @endif
                <div class="about-divider"></div>
                @if($section->subtitle)
                <p class="lead">{{ $section->subtitle }}</p>
                @endif
                @if($section->content)
                <div>{!! $section->content !!}</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- (2) Vision — light green bg -->
@if(isset($pageSections['vision']))
@php $section = $pageSections['vision']; @endphp
<section class="section-padding about-alt-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="vision-quote-wrap">
                    <span class="vision-quote-mark">&ldquo;</span>
                    <div class="vision-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <span class="about-section-label">Our Vision</span>
                    @if($section->title)
                    <h2 class="mb-0">{{ $section->title }}</h2>
                    @endif
                    <div class="about-divider"></div>
                    @if($section->subtitle)
                    <p class="lead fst-italic">{{ $section->subtitle }}</p>
                    @endif
                    @if($section->content)
                    <div>{!! $section->content !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- (3) Mission — white bg -->
@if(isset($pageSections['mission']))
@php $section = $pageSections['mission']; @endphp
<section class="section-padding">
    <div class="container">
        <div class="mission-card card">
            <div class="mission-accent-bar"></div>
            <div class="mission-body">
                <span class="about-section-label label-primary">Our Mission</span>
                @if($section->title)
                <h2 class="mb-0">{{ $section->title }}</h2>
                @endif
                <div class="about-divider divider-primary"></div>
                @if($section->subtitle)
                <p class="mission-lead mb-3">{{ $section->subtitle }}</p>
                @endif
                @if($section->content)
                <div>{!! $section->content !!}</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- (4) Core Values — light green bg -->
@if(isset($pageSections['core-values']))
@php $section = $pageSections['core-values']; @endphp
<section class="section-padding about-alt-bg">
    <div class="container">
        <div class="text-center mb-5">
            <span class="about-section-label">What We Stand For</span>
            @if($section->title)
            <h2 class="mb-0">{{ $section->title }}</h2>
            @endif
            <div class="about-divider mx-auto"></div>
            @if($section->subtitle)
            <p class="text-muted">{{ $section->subtitle }}</p>
            @endif
        </div>
        @if($section->items && count($section->items) > 0)
        <div class="row g-4">
            @foreach($section->items as $index => $item)
            <div class="col-md-6">
                <div class="value-card">
                    <div class="value-card-header">
                        <div class="value-number">{{ $index + 1 }}</div>
                        @if($item['title'] ?? null)
                        <h4>{{ $item['title'] }}</h4>
                        @endif
                    </div>
                    @if($item['description'] ?? null)
                    <div class="value-card-body">
                        <p>{{ $item['description'] }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif

<!-- (5) Objectives — GREEN bg -->
@if(isset($pageSections['objectives']))
@php $section = $pageSections['objectives']; @endphp
<section class="section-padding objectives-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="about-section-label">What We Aim to Achieve</span>
            @if($section->title)
            <h2 class="mb-0">{{ $section->title }}</h2>
            @endif
            <div class="about-divider divider-white mx-auto"></div>
            @if($section->subtitle)
            <p>{{ $section->subtitle }}</p>
            @endif
        </div>
        @if($section->items && count($section->items) > 0)
        <div class="row g-0">
            <div class="col-lg-10 mx-auto">
                @foreach($section->items as $index => $item)
                <div class="objective-item">
                    <div class="objective-num">{{ $index + 1 }}</div>
                    <div>
                        @if($item['title'] ?? null)
                        <h5>{{ $item['title'] }}</h5>
                        @endif
                        @if($item['description'] ?? null)
                        <p>{{ $item['description'] }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endif

<!-- (6) Work Plan — light green bg -->
@if($workPlan)
<section class="section-padding about-alt-bg">
    <div class="container">
        <div class="text-center mb-5">
            <span class="about-section-label">Upcoming Activities</span>
            <h2 class="mb-0">{{ $workPlan->title }}</h2>
            <div class="about-divider mx-auto"></div>
            @if($workPlan->description)
            <p class="text-muted">{{ $workPlan->description }}</p>
            @endif
        </div>
        @if($previewEvents->count() > 0)
        <div class="row g-3">
            @foreach($previewEvents as $event)
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 14px; overflow: hidden;">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="text-center px-2 py-1 rounded" style="background: var(--primary); color: white; min-width: 54px;">
                                <div style="font-size: 1.4rem; font-weight: 700; line-height: 1;">{{ $event->date->format('d') }}</div>
                                <div style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;">{{ $event->date->format('M Y') }}</div>
                            </div>
                            @if($event->location)
                            <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</small>
                            @endif
                        </div>
                        <h5 class="card-title mb-2" style="font-size: 0.95rem;">{{ $event->title }}</h5>
                        @if($event->theme)
                        <span class="badge bg-secondary mb-2">{{ $event->theme }}</span>
                        @endif
                        @if($event->description)
                        <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('work-plan') }}" class="btn btn-outline-primary">
                <i class="fas fa-calendar-alt me-2"></i>View All Work Plan Events
            </a>
        </div>
        @endif
    </div>
</section>
@endif

<!-- (7) Board of Directors — white bg — horizontal scroll -->
@if($boardOfDirectors->count() > 0)
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="about-section-label label-primary">Leadership</span>
            <h2 class="mb-0">Board of Directors</h2>
            <div class="about-divider divider-primary mx-auto"></div>
            <p class="text-muted">Our leadership team guiding the organization</p>
        </div>
        <div class="team-grid">
            @foreach($boardOfDirectors as $director)
            <div class="team-member-item">
                <div class="team-avatar-wrap">
                    @if($director->photo)
                    <img src="{{ $director->photo_url }}" alt="{{ $director->name }}">
                    @else
                    <div class="team-avatar-placeholder">
                        <i class="fas fa-user"></i>
                    </div>
                    @endif
                </div>
                <div class="team-member-name">{{ $director->name }}</div>
                <div class="team-member-title">{{ $director->title }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- (8) Advisory Board — light green bg — horizontal scroll -->
@if($advisoryBoard->count() > 0)
<section class="section-padding about-alt-bg">
    <div class="container">
        <div class="text-center mb-5">
            <span class="about-section-label">Advisors</span>
            <h2 class="mb-0">Advisory Board</h2>
            <div class="about-divider mx-auto"></div>
            <p class="text-muted">Industry experts and advisors supporting our mission</p>
        </div>
        <div class="team-grid">
            @foreach($advisoryBoard as $member)
            <div class="team-member-item">
                <div class="team-avatar-wrap">
                    @if($member->photo)
                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}">
                    @else
                    <div class="team-avatar-placeholder">
                        <i class="fas fa-user"></i>
                    </div>
                    @endif
                </div>
                <div class="team-member-name">{{ $member->name }}</div>
                <div class="team-member-title">{{ $member->title }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- (9) CTA — primary bg -->
@if(isset($pageSections['cta']))
@php $section = $pageSections['cta']; @endphp
<section class="py-5 {{ $section->background_color == 'primary' ? 'bg-primary text-white' : ($section->background_color == 'secondary' ? 'bg-secondary text-white' : ($section->background_color == 'light' ? 'bg-light' : '')) }}">
    <div class="container">
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
</section>
@endif
@endsection
