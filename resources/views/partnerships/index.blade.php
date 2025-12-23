@extends('layouts.app')

@section('title', 'Partnerships - Women in Film Organization')
@push('meta')
    <meta name="description" content="Partner with Women in Film Organization to support and empower women in the Ugandan film industry.">
    <meta name="keywords" content="partnerships, film industry partnerships, support women in film, uganda film">
    <meta property="og:title" content="Partnerships - Women in Film Organization">
    <meta property="og:description" content="Join us in supporting and empowering women in the Ugandan film industry.">
@endpush

@section('content')
<!-- Page Hero -->
<x-page-hero :hero="$hero" />

@if(!$hero || !$hero->is_active)
<!-- Fallback Hero Section -->
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <h1 class="text-center">Our Partners</h1>
    </div>
</section>
@endif

<!-- Partners Section -->
<section class="section-padding">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="mb-3">Our Partners</h2>
                <p class="text-muted">Organizations supporting our mission to empower women in film</p>
            </div>
        </div>
        
        <div class="row">
            @foreach($partners as $partner)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                <div class="partner-logo-wrapper">
                    @if($partner->logo_url)
                    <a href="#myModal-{{ $partner->id }}" data-bs-toggle="modal"
                       rel="noopener noreferrer"
                       class="partner-logo-link"
                       title="{{ $partner->name ?? 'Partner' }}">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name ?? 'Partner' }}" class="partner-logo-img">
                    </a>
                    @else
                    <div class="partner-logo-placeholder">
                        <span>{{ $partner->name ?? 'Partner' }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div id="myModal-{{ $partner->id }}" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $partner->name ?? 'Partner' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $partner->description ?? 'No description available.' }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ $partner->website_url ?? '#' }}" type="button" class="btn btn-primary">Visit Website</a>
                    </div>
                </div>
            </div>
        </div>
            @endforeach
        </div>
        
        @if($partners->isEmpty())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info border-start border-4">
                    <i class="fas fa-info-circle me-2"></i>Partner information coming soon!
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Partnership Inquiry Section -->
<section class="section-padding bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="mb-4">Become a Partner</h2>
                <p class="lead mb-4">Join us in empowering women in the Ugandan film industry. Partner with us to make a lasting impact.</p>
                <a href="#partnership-form" class="btn btn-accent-yellow btn-lg">Send Partnership Inquiry</a>
            </div>
        </div>
    </div>
</section>

<!-- Partnership Form Section -->
<section class="section-padding" id="partnership-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-4">Partnership Inquiry Form</h3>
                        <form action="{{ route('partnerships.inquiry.store') }}" method="POST" id="partnership-inquiry-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="organization_name" class="form-label">Organization Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="organization_name" name="organization_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_person" class="form-label">Contact Person <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="partnership_type" class="form-label">Partnership Type</label>
                                <select class="form-select" id="partnership_type" name="partnership_type">
                                    <option value="">Select type</option>
                                    <option value="corporate">Corporate</option>
                                    <option value="ngo">NGO</option>
                                    <option value="media">Media</option>
                                    <option value="training">Training</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="partnership_interest" class="form-label">Partnership Interest <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="partnership_interest" name="partnership_interest" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Additional Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Inquiry</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

