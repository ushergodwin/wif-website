<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Women in Film Organization - Empowering Women in Ugandan Film Industry')</title>
    <meta name="title" content="@yield('meta_title', 'Women in Film Organization - Empowering Women in Ugandan Film Industry')">
    <meta name="description" content="@yield('meta_description', 'Women in Film (WIF) empowers women in the Ugandan film industry through mentorship, training, access to funding, and advocacy. Join us in building a dynamic and equitable African film industry.')">
    <meta name="keywords" content="@yield('meta_keywords', 'women in film, uganda film industry, film training, film mentorship, women filmmakers, african cinema, film advocacy, uganda cinema, film education, women empowerment')">
    <meta name="author" content="Women in Film Organization">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'Women in Film Organization - Empowering Women in Ugandan Film Industry')">
    <meta property="og:description" content="@yield('og_description', 'Women in Film (WIF) empowers women in the Ugandan film industry through mentorship, training, access to funding, and advocacy.')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:site_name" content="Women in Film Organization">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('twitter_title', 'Women in Film Organization - Empowering Women in Ugandan Film Industry')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Women in Film (WIF) empowers women in the Ugandan film industry through mentorship, training, access to funding, and advocacy.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/logo.png'))">
    
    <!-- Favicon -->
    @if(file_exists(public_path('images/logo.png')))
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo.png') }}">
    @else
        <!-- Fallback favicon - you can replace this with an actual favicon.ico -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif
    <link rel="shortcut icon" href="@if(file_exists(public_path('images/logo.png'))){{ asset('images/logo.png') }}@else{{ asset('favicon.ico') }}@endif">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Additional SEO -->
    <meta name="theme-color" content="#da3322">
    <meta name="msapplication-TileColor" content="#da3322">
    
    <!-- Bootstrap CSS - Load first -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Custom CSS - Load after Bootstrap to override -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="Women in Film" height="40">
                @else
                    <div class="logo-placeholder" style="width: 40px; height: 40px; background: var(--primary); border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 18px;">WIF</div>
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('testimonials.*') ? 'active' : '' }}" href="{{ route('testimonials.index') }}">Testimonials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('partnerships.*') ? 'active' : '' }}" href="{{ route('partnerships.index') }}">Partnerships</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}" href="{{ route('gallery.index') }}">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white ms-2" href="https://wif.piu.ac.ug/" target="_blank">
                                Mentorship Program
                            </a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-logo mb-3">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="Women in Film" height="60" class="mb-3">
                        @else
                            <div class="logo-placeholder mb-3" style="width: 60px; height: 60px; background: var(--primary); border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 24px;">WIF</div>
                        @endif
                    </div>
                    <div class="footer-description">
                        <p >Elevating Women in Film in Uganda and Africa.</p>
                        <p >We are on a mission to empower and advance female creatives in Uganda and African cinema through training, mentorship, and networking.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="{{ route('about') }}">About Us</a></li>
                        <li class="mb-2"><a href="{{ route('projects.index') }}">Our Projects</a></li>
                        <li class="mb-2"><a href="{{ route('partnerships.index') }}">Partnerships</a></li>
                        <li class="mb-2"><a href="{{ route('testimonials.index') }}">Testimonials</a></li>
                        <li class="mb-2"><a href="{{ route('gallery.index') }}">Gallery</a></li>
                        <li class="mb-2"><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li class="mb-2"><a href="https://wif.piu.ac.ug/" target="_blank">Mentorship Program</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Get In Touch</h5>
                    <div class="mb-3">
                        <strong>Address:</strong><br>
                        <span class="footer-text">Arriva building, Bombo Road, Kampala - Uganda</span>
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong><br>
                        <a href="mailto:hello@joinwomeninfilm.org" class="footer-email">hello@joinwomeninfilm.org</a><br>
                        <a href="mailto:womeninfilmcug@gmail.com" class="footer-email">womeninfilmcug@gmail.com</a>
                    </div>
                    <div class="mb-3">
                        <strong>Hours:</strong><br>
                        <span class="footer-text">Monday - Friday, 08am - 05pm</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Info</h5>
                    <div class="mb-3">
                        <a href="tel:+256784084218" class="footer-phone">+256 784 084218</a><br>
                        <small>Rujema Mutesi (Project Lead)</small>
                    </div>
                    <div class="mb-3">
                        <a href="tel:+256705098317" class="footer-phone">+256 705 098317</a><br>
                        <small>Jesca Ahimbisibwe (Director)</small>
                    </div>
                    <div class="mb-3">
                        <a href="tel:+256776761554" class="footer-phone">+256 776 761554</a><br>
                        <small>Theos Barham (Ass Project Lead)</small>
                    </div>
                    <div class="social-links mt-3">
                        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-light">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; {{ date('Y') }} Women in Film Organization. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @stack('scripts')
</body>
</html>

