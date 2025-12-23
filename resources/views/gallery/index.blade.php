@extends('layouts.app')

@section('title', 'Gallery - Women in Film Organization')
@push('meta')
    <meta name="description" content="Browse our gallery showcasing events, workshops, and activities from Women in Film Organization.">
    <meta name="keywords" content="gallery, film events, workshops, women in film photos, uganda film industry">
    <meta property="og:title" content="Gallery - Women in Film Organization">
    <meta property="og:description" content="Browse our gallery showcasing events, workshops, and activities.">
@endpush

@section('content')
<!-- Page Hero -->
<x-page-hero :hero="$hero" />

@if(!$hero || !$hero->is_active)
<!-- Fallback Hero Section -->
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <h1 class="text-center">Gallery</h1>
    </div>
</section>
@endif

<!-- Gallery Section -->
<section class="section-padding">
    <div class="container">
        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET" action="{{ route('gallery.index') }}" class="row g-3">
                    @if($projects->count() > 0)
                    <div class="col-md-4">
                        <select name="project" class="form-select" onchange="this.form.submit()">
                            <option value="">All Projects</option>
                            @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ request('project') == $project->id ? 'selected' : '' }}>
                                {{ $project->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if($years->count() > 0)
                    <div class="col-md-4">
                        <select name="year" class="form-select" onchange="this.form.submit()">
                            <option value="">All Years</option>
                            @foreach($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="col-md-4">
                        <a href="{{ route('gallery.index') }}" class="btn btn-outline-secondary w-100">Clear Filters</a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Gallery Grid -->
        <div class="row g-3" id="gallery-grid">
            @forelse($galleryItems as $index => $item)
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="gallery-item-card" data-bs-toggle="modal" data-bs-target="#galleryModal" data-image="{{ $item->image_url }}" data-title="{{ $item->title ?? 'Gallery Image' }}" data-description="{{ $item->description ?? '' }}" data-year="{{ $item->year ?? '' }}" data-index="{{ $index }}">
                    <div class="gallery-item-wrapper">
                        <img src="{{ $item->image_url }}" 
                             alt="{{ $item->title ?? 'Gallery Image' }}" 
                             class="gallery-thumbnail"
                             loading="lazy">
                        <div class="gallery-overlay-content">
                            <div class="gallery-overlay-text">
                                @if($item->title)
                                <h5 class="text-white mb-2">{{ $item->title }}</h5>
                                @endif
                                @if($item->description)
                                <p class="text-white small mb-2">{{ Str::limit($item->description, 80) }}</p>
                                @endif
                                @if($item->year)
                                <span class="badge bg-secondary">{{ $item->year }}</span>
                                @endif
                            </div>
                            <div class="gallery-overlay-icon">
                                <i class="fas fa-search-plus fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info border-start border-4">
                    <i class="fas fa-info-circle me-2"></i>No gallery items available at the moment.
                </div>
            </div>
            @endforelse
        </div>
        
        @if($galleryItems->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                {{ $galleryItems->links() }}
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="galleryModalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 d-flex align-items-center justify-content-center position-relative">
                <button class="btn btn-link text-white position-absolute start-0 top-50 translate-middle-y ms-3 gallery-nav-btn" id="prevBtn" style="z-index: 10; font-size: 2rem;">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-link text-white position-absolute end-0 top-50 translate-middle-y me-3 gallery-nav-btn" id="nextBtn" style="z-index: 10; font-size: 2rem;">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="gallery-zoom-container" id="zoomContainer">
                    <img src="" alt="" id="modalImage" class="gallery-modal-image">
                </div>
            </div>
            <div class="modal-footer border-0 bg-dark text-white">
                <div class="w-100">
                    <p id="modalDescription" class="mb-2"></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span id="modalYear" class="badge bg-secondary me-2"></span>
                            <span id="imageCounter" class="text-muted"></span>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-outline-light me-2" id="zoomInBtn">
                                <i class="fas fa-search-plus"></i> Zoom In
                            </button>
                            <button class="btn btn-sm btn-outline-light me-2" id="zoomOutBtn">
                                <i class="fas fa-search-minus"></i> Zoom Out
                            </button>
                            <button class="btn btn-sm btn-outline-light" id="resetZoomBtn">
                                <i class="fas fa-expand"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.gallery-item-card {
    cursor: pointer;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: white;
}

.gallery-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.gallery-item-wrapper {
    position: relative;
    overflow: hidden;
    aspect-ratio: 4/3;
}

.gallery-thumbnail {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-item-card:hover .gallery-thumbnail {
    transform: scale(1.1);
}

.gallery-overlay-content {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, transparent 30%, transparent 70%, rgba(0,0,0,0.8) 100%);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 1rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item-card:hover .gallery-overlay-content {
    opacity: 1;
}

.gallery-overlay-text {
    margin-top: auto;
}

.gallery-overlay-icon {
    text-align: center;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 0.8; }
    50% { opacity: 1; }
}

.gallery-zoom-container {
    width: 100%;
    height: 100%;
    overflow: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: grab;
}

.gallery-zoom-container:active {
    cursor: grabbing;
}

.gallery-modal-image {
    max-width: 100%;
    max-height: 90vh;
    object-fit: contain;
    transition: transform 0.3s ease;
    user-select: none;
}

.gallery-nav-btn {
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.gallery-nav-btn:hover {
    opacity: 1;
}

#galleryModal .modal-body {
    min-height: 70vh;
}

@media (max-width: 768px) {
    .gallery-nav-btn {
        font-size: 1.5rem !important;
    }
    
    .gallery-overlay-content {
        padding: 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery-item-card');
    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('galleryModalLabel');
    const modalDescription = document.getElementById('modalDescription');
    const modalYear = document.getElementById('modalYear');
    const imageCounter = document.getElementById('imageCounter');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const zoomInBtn = document.getElementById('zoomInBtn');
    const zoomOutBtn = document.getElementById('zoomOutBtn');
    const resetZoomBtn = document.getElementById('resetZoomBtn');
    const zoomContainer = document.getElementById('zoomContainer');
    
    let currentIndex = 0;
    let currentZoom = 1;
    let isDragging = false;
    let startX, startY, scrollLeft, scrollTop;
    
    // Open modal with image
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', function() {
            currentIndex = index;
            loadImage(index);
            modal.show();
        });
    });
    
    function loadImage(index) {
        const item = galleryItems[index];
        const image = item.dataset.image;
        const title = item.dataset.title;
        const description = item.dataset.description;
        const year = item.dataset.year;
        
        modalImage.src = image;
        modalImage.alt = title;
        modalTitle.textContent = title;
        modalDescription.textContent = description || '';
        modalYear.textContent = year ? year : '';
        modalYear.style.display = year ? 'inline-block' : 'none';
        imageCounter.textContent = `${index + 1} / ${galleryItems.length}`;
        
        // Reset zoom
        currentZoom = 1;
        modalImage.style.transform = `scale(${currentZoom})`;
        zoomContainer.scrollLeft = zoomContainer.scrollWidth / 2 - zoomContainer.clientWidth / 2;
        zoomContainer.scrollTop = zoomContainer.scrollHeight / 2 - zoomContainer.clientHeight / 2;
    }
    
    // Navigation
    prevBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        if (currentIndex > 0) {
            currentIndex--;
            loadImage(currentIndex);
        }
    });
    
    nextBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        if (currentIndex < galleryItems.length - 1) {
            currentIndex++;
            loadImage(currentIndex);
        }
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!modal._isShown) return;
        
        if (e.key === 'ArrowLeft' && currentIndex > 0) {
            currentIndex--;
            loadImage(currentIndex);
        } else if (e.key === 'ArrowRight' && currentIndex < galleryItems.length - 1) {
            currentIndex++;
            loadImage(currentIndex);
        } else if (e.key === 'Escape') {
            modal.hide();
        }
    });
    
    // Zoom functionality
    zoomInBtn.addEventListener('click', function() {
        currentZoom = Math.min(currentZoom + 0.25, 3);
        modalImage.style.transform = `scale(${currentZoom})`;
    });
    
    zoomOutBtn.addEventListener('click', function() {
        currentZoom = Math.max(currentZoom - 0.25, 0.5);
        modalImage.style.transform = `scale(${currentZoom})`;
    });
    
    resetZoomBtn.addEventListener('click', function() {
        currentZoom = 1;
        modalImage.style.transform = `scale(${currentZoom})`;
        zoomContainer.scrollLeft = zoomContainer.scrollWidth / 2 - zoomContainer.clientWidth / 2;
        zoomContainer.scrollTop = zoomContainer.scrollHeight / 2 - zoomContainer.clientHeight / 2;
    });
    
    // Mouse wheel zoom
    zoomContainer.addEventListener('wheel', function(e) {
        e.preventDefault();
        const delta = e.deltaY > 0 ? -0.1 : 0.1;
        currentZoom = Math.max(0.5, Math.min(3, currentZoom + delta));
        modalImage.style.transform = `scale(${currentZoom})`;
    }, { passive: false });
    
    // Drag to pan when zoomed
    zoomContainer.addEventListener('mousedown', function(e) {
        if (currentZoom > 1) {
            isDragging = true;
            startX = e.pageX - zoomContainer.offsetLeft;
            startY = e.pageY - zoomContainer.offsetTop;
            scrollLeft = zoomContainer.scrollLeft;
            scrollTop = zoomContainer.scrollTop;
        }
    });
    
    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - zoomContainer.offsetLeft;
        const y = e.pageY - zoomContainer.offsetTop;
        const walkX = (x - startX) * 2;
        const walkY = (y - startY) * 2;
        zoomContainer.scrollLeft = scrollLeft - walkX;
        zoomContainer.scrollTop = scrollTop - walkY;
    });
    
    document.addEventListener('mouseup', function() {
        isDragging = false;
    });
    
    // Touch support for mobile
    let touchStartDistance = 0;
    let touchStartZoom = 1;
    
    zoomContainer.addEventListener('touchstart', function(e) {
        if (e.touches.length === 2) {
            const touch1 = e.touches[0];
            const touch2 = e.touches[1];
            touchStartDistance = Math.hypot(
                touch2.clientX - touch1.clientX,
                touch2.clientY - touch1.clientY
            );
            touchStartZoom = currentZoom;
        }
    });
    
    zoomContainer.addEventListener('touchmove', function(e) {
        if (e.touches.length === 2) {
            e.preventDefault();
            const touch1 = e.touches[0];
            const touch2 = e.touches[1];
            const touchDistance = Math.hypot(
                touch2.clientX - touch1.clientX,
                touch2.clientY - touch1.clientY
            );
            const scale = touchDistance / touchStartDistance;
            currentZoom = Math.max(0.5, Math.min(3, touchStartZoom * scale));
            modalImage.style.transform = `scale(${currentZoom})`;
        }
    });
});
</script>
@endpush
@endsection

