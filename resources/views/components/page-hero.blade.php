@props(['hero'])

@if($hero && $hero->is_active)
<section class="page-hero-section">
    <div class="page-hero-image">
        <img src="{{ $hero->image_url }}" alt="{{ $hero->page_slug }} Hero" class="w-100">
    </div>
</section>
@endif
