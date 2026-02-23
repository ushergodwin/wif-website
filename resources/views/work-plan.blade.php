@extends('layouts.app')

@section('title', ($workPlan->title ?? 'Work Plan') . ' - Women in Film Organization')
@push('meta')
    <meta name="description" content="View our full work plan and upcoming events for the year.">
@endpush

@section('content')
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <h1 class="text-center">{{ $workPlan->title ?? 'Work Plan' }}</h1>
        @if($workPlan && $workPlan->description)
        <p class="text-center text-muted mt-2">{{ $workPlan->description }}</p>
        @endif
    </div>
</section>

<section class="py-5">
    <div class="container">
        @if($events->count() > 0)
        <div class="row">
            @foreach($events as $event)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
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
                        <h5 class="card-title mb-2">{{ $event->title }}</h5>
                        @if($event->theme)
                        <span class="badge bg-secondary mb-2">{{ $event->theme }}</span>
                        @endif
                        @if($event->description)
                        <p class="card-text text-muted small">{{ $event->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
            <p class="text-muted">No events have been scheduled yet. Check back soon.</p>
        </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('about') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to About Us
            </a>
        </div>
    </div>
</section>
@endsection
