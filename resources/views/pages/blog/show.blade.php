@extends('layouts.app')

@section('title')
    {{ $blog->title ?? 'Blog Post' }}
@endsection

@push('styles')
<style>
    .blog-content {
        font-size: 1.125rem;
        line-height: 1.8;
    }
    .blog-content p {
        margin-bottom: 1.5rem;
    }
    .blog-content h2, .blog-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #212529;
    }
    @media (max-width: 768px) {
        .display-5 {
            font-size: 2rem;
        }
        .card-body {
            padding: 1.5rem !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <!-- Blog Card -->
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <!-- Cover Image Section -->
                @if ($blog->getFirstMediaUrl('blog_cover_image'))
                    <div class="position-relative">
                        <img 
                            src="{{ $blog->getFirstMediaUrl('blog_cover_image') }}" 
                            alt="{{ $blog->title }} Cover Image" 
                            class="card-img-top img-fluid" 
                            style="height: 400px; object-fit: cover; border-bottom-left-radius: 0; border-bottom-right-radius: 0;"
                            loading="lazy"
                        >
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-clock me-1"></i> {{ $blog->reading_time }} min read
                            </span>
                        </div>
                    </div>
                @else
                    <div class="bg-light text-center py-5 border-bottom">
                        <i class="bi bi-image display-1 text-muted"></i>
                        <p class="text-muted mt-3">No cover image available</p>
                    </div>
                @endif

                <!-- Card Body -->
                <div class="card-body p-5 p-md-6">
                    <!-- Title -->
                    <h1 class="display-5 fw-bold text-dark mb-4 lh-base">
                        {{ $blog->title }}
                    </h1>

                    <!-- Meta Information -->
                    <div class="d-flex flex-wrap align-items-center text-muted mb-4 small">
                        <div class="me-4 mb-2">
                            <i class="bi bi-person-circle me-2"></i>
                            <span>By Admin</span>
                        </div>
                        <div class="me-4 mb-2">
                            <i class="bi bi-calendar-event me-2"></i>
                            <span>Published {{ $blog->published_at?->format('M d, Y') ?? $blog->created_at->format('M d, Y') }}</span>
                        </div>
                        
                    </div>

                    <!-- Content -->
                    <div class="blog-content lead text-dark lh-lg mb-5">
                        {!! nl2br(e($blog->content)) !!} {{-- Use {!! !!} for HTML content if rendered as markdown/HTML; otherwise e() for safety --}}
                    </div>

                    <!-- Tags or Categories (Optional Extension) -->
                    @if ($blog->tags ?? false) {{-- Assuming a tags relation or column --}}
                        <div class="mb-4">
                            <hr class="my-4">
                            <h5 class="fw-semibold text-muted mb-3">Tags</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($blog->tags as $tag)
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-flex flex-wrap gap-3 mt-5 border-top pt-4">
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-outline-primary btn-md rounded-pill px-4">
                            <i class="bi bi-pencil-square me-2"></i> Edit Post
                        </a>
                        <button 
                            class="btn btn-outline-danger btn-md rounded-pill px-4 delete-item-btn" 
                            data-delete-route="{{ route('blogs.destroy', $blog->id) }}"
                        >
                            <i class="bi bi-trash me-2"></i> Delete Post
                        </button>
                        <a href="{{ route('blogs.index') }}" class="btn btn-secondary btn-md rounded-pill px-4 ms-auto">
                            <i class="bi bi-arrow-left me-2"></i> Back to Blogs
                        </a>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('components.delete-confirmation')
@endpush