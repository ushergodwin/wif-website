@extends('layouts.app')

@section('title', 'Materials — ' . $project->title)
@push('meta')
    <meta name="description" content="Download guides, documents, and resources for {{ $project->title }}.">
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
/* ── Mini hero ── */
.materials-hero {
    position: relative;
    min-height: 260px;
    display: flex;
    align-items: flex-end;
    overflow: hidden;
}
.materials-hero-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
}
.materials-hero-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(57,14,1,0.15) 0%, rgba(57,14,1,0.82) 100%);
}
.materials-hero-fallback {
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent-orange) 100%);
}
.materials-hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
    padding: 2rem 0;
}
.materials-hero-content h1 { color: white; font-size: 2rem; margin-bottom: 0.25rem; }
.materials-hero-content p  { color: rgba(255,255,255,0.8); margin: 0; }

/* ── Material card ── */
.material-card {
    background: white;
    border-radius: 14px;
    box-shadow: 0 3px 16px rgba(0,0,0,0.07);
    border: 1px solid rgba(0,0,0,0.05);
    padding: 1.5rem;
    display: flex;
    gap: 1.25rem;
    align-items: flex-start;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.material-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.12);
}
.material-icon-wrap {
    width: 56px;
    height: 56px;
    min-width: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.65rem;
}
.material-body { flex: 1; min-width: 0; }
.material-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.3rem;
    line-height: 1.35;
}
.material-desc {
    font-size: 0.875rem;
    color: #666;
    margin-bottom: 0.75rem;
    line-height: 1.5;
}
.material-badge {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    padding: 2px 8px;
    border-radius: 20px;
    text-transform: uppercase;
}
.material-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-top: 0.75rem;
}

/* ── PDF inline preview modal ── */
.pdf-frame { width: 100%; height: 80vh; border: none; border-radius: 4px; }

/* ── Empty state ── */
.empty-state {
    padding: 4rem 2rem;
    text-align: center;
    color: #888;
}
.empty-state i { font-size: 3.5rem; margin-bottom: 1rem; opacity: 0.35; }
</style>
@endpush

@section('content')

<!-- Mini Hero -->
<section class="materials-hero @if(!$project->featured_image) materials-hero-fallback @endif">
    @if($project->featured_image)
    <div class="materials-hero-bg" style="background-image: url('{{ $project->featured_image_url }}');"></div>
    @endif
    <div class="materials-hero-content">
        <div class="container">
            <p><i class="bi bi-folder2-open me-1"></i> Project Materials</p>
            <h1>{{ $project->title }}</h1>
        </div>
    </div>
</section>

<!-- Materials List -->
<section class="section-padding">
    <div class="container">

        <!-- Back link + count -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
            <a href="{{ route('projects.show', $project->slug) }}"
               class="d-inline-flex align-items-center gap-2 text-decoration-none fw-semibold"
               style="color: var(--primary);">
                <i class="bi bi-arrow-left"></i> Back to Project
            </a>
            @if($materials->count() > 0)
            <span class="text-muted small">{{ $materials->count() }} {{ Str::plural('material', $materials->count()) }}</span>
            @endif
        </div>

        @if($materials->count() > 0)
        <div class="row g-3">
            @foreach($materials as $material)
            <div class="col-12">
                <div class="material-card">
                    <!-- File type icon -->
                    <div class="material-icon-wrap" style="background: {{ $material->file_color }}18;">
                        <i class="bi {{ $material->file_icon }}" style="color: {{ $material->file_color }};"></i>
                    </div>

                    <div class="material-body">
                        <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                            <span class="material-title">{{ $material->title }}</span>
                            <span class="material-badge" style="background: {{ $material->file_color }}18; color: {{ $material->file_color }};">
                                {{ $material->file_label }}
                            </span>
                        </div>
                        @if($material->description)
                        <p class="material-desc mb-0">{{ $material->description }}</p>
                        @endif

                        <div class="material-actions">
                            @if($material->is_previewable)
                            {{-- PDFs/images: open in new tab (browser renders them inline) --}}
                            <a href="{{ $material->file_url }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>View Online
                            </a>
                            @endif
                            <a href="{{ $material->file_url }}"
                               download
                               class="btn btn-sm btn-primary">
                                <i class="bi bi-download me-1"></i>Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="empty-state">
            <i class="bi bi-folder2 d-block"></i>
            <h5 class="mb-1">No materials yet</h5>
            <p class="mb-0">Check back soon — guides and resources will appear here.</p>
        </div>
        @endif

    </div>
</section>

@endsection
