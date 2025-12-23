@props(['hero'])

@if($hero && $hero->is_active)
<section class="page-hero-section">
    <div class="page-hero-image">
        <img src="{{ $hero->image_url }}" alt="{{ $hero->page_slug }} Hero" class="w-100">
        <div class="page-hero-overlay">
            <div class="container">
                <div class="row align-items-center min-vh-40">
                    <div class="col-lg-8 mx-auto text-center">
                        <h1 class="page-hero-title">{!! $hero->overlay_text !!}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

