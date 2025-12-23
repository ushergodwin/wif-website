@extends('layouts.app')

@section('title', 'Join Our Community - Women in Film Organization')
@push('meta')
    <meta name="description" content="Join the Women in Film Organization community and get access to training, mentorship, and opportunities in the Ugandan film industry.">
    <meta name="keywords" content="join women in film, community signup, film training, film mentorship">
    <meta property="og:title" content="Join Our Community - Women in Film Organization">
    <meta property="og:description" content="Join our community and get access to training, mentorship, and opportunities.">
@endpush

@section('content')
<!-- Join Community Section -->
<section class="section-padding bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="mb-4">Join Our Community</h1>
                <p class="lead mb-4">Be part of a growing network of women filmmakers and creatives. Get access to training, mentorship, and opportunities.</p>
            </div>
        </div>
    </div>
</section>

<!-- Signup Form Section -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-4">Community Signup Form</h3>
                        
                        @if(session('success'))
                        <div class="alert alert-success border-start border-4">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                        @endif
                        
                        @if($errors->any())
                        <div class="alert alert-danger border-start border-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <form action="{{ route('subscribers.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="area_of_interest" class="form-label">Area of Interest</label>
                                <select class="form-select" id="area_of_interest" name="area_of_interest">
                                    <option value="">Select your area of interest</option>
                                    <option value="acting" {{ old('area_of_interest') == 'acting' ? 'selected' : '' }}>Acting</option>
                                    <option value="directing" {{ old('area_of_interest') == 'directing' ? 'selected' : '' }}>Directing</option>
                                    <option value="producing" {{ old('area_of_interest') == 'producing' ? 'selected' : '' }}>Producing</option>
                                    <option value="screenwriting" {{ old('area_of_interest') == 'screenwriting' ? 'selected' : '' }}>Screenwriting</option>
                                    <option value="cinematography" {{ old('area_of_interest') == 'cinematography' ? 'selected' : '' }}>Cinematography</option>
                                    <option value="editing" {{ old('area_of_interest') == 'editing' ? 'selected' : '' }}>Editing</option>
                                    <option value="other" {{ old('area_of_interest') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Join Now</button>
                        </form>
                        
                        <div class="mt-4 text-center">
                            <p class="text-muted">Or explore our <a href="https://wif.piu.ac.ug/" target="_blank"><strong>Mentorship Program</strong></a> for personalized guidance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

