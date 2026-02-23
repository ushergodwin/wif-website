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
    <!-- SweetAlert2 Bootstrap theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
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
                        <a href="https://www.instagram.com/womeninfilmug/" target="_blank" rel="noopener noreferrer" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://x.com/WomenInFilmUg" target="_blank" rel="noopener noreferrer" title="X (Twitter)"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/showcase/women-in-film-organisation/posts/?feedView=all" target="_blank" rel="noopener noreferrer" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
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
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Global Axios config
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['Accept'] = 'application/json';

        /**
         * Handle form submission via Axios with SweetAlert2 feedback.
         *
         * @param {string} formId  - The id attribute of the <form> element
         * @param {object} options - { successTitle, successText, errorTitle }
         */
        function handleFormSubmit(formId, options = {}) {
            const form = document.getElementById(formId);
            if (!form) return;

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const submitBtn = form.querySelector('[type="submit"]');
                const originalText = submitBtn ? submitBtn.innerHTML : null;
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Sending...';
                }

                // Clear previous field errors
                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

                try {
                    const data = new FormData(form);
                    await axios.post(form.action, data);

                    Swal.fire({
                        icon: 'success',
                        title: options.successTitle || 'Success!',
                        text: options.successText || 'Your submission was received.',
                        confirmButtonColor: '#da3322',
                    }).then(() => {
                        if (options.redirect) {
                            window.location.href = options.redirect;
                        } else {
                            form.reset();
                        }
                    });
                } catch (err) {
                    if (err.response && err.response.status === 422) {
                        // Validation errors — highlight each field and list messages in alert
                        const errors = err.response.data.errors || {};
                        let firstInvalid = null;
                        const errorLines = [];

                        Object.entries(errors).forEach(([field, messages]) => {
                            errorLines.push(messages[0]);
                            const input = form.querySelector('[name="' + field + '"]');
                            if (input) {
                                input.classList.add('is-invalid');
                                const feedback = document.createElement('div');
                                feedback.className = 'invalid-feedback';
                                feedback.textContent = messages[0];
                                input.parentNode.appendChild(feedback);
                                if (!firstInvalid) firstInvalid = input;
                            }
                        });

                        Swal.fire({
                            icon: 'warning',
                            title: 'Please check your input',
                            html: errorLines.map(m => '<p class="mb-1">' + m + '</p>').join(''),
                            confirmButtonColor: '#da3322',
                        }).then(() => {
                            if (firstInvalid) firstInvalid.focus();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: options.errorTitle || 'Something went wrong',
                            text: err.response?.data?.message || 'Please try again later.',
                            confirmButtonColor: '#da3322',
                        });
                    }
                } finally {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>

