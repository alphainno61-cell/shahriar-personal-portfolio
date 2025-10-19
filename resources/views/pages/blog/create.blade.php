@extends('layouts.app')

@section('title', 'Create Blog')

@push('styles')
<style>
    body {
        background: #f5f7fa;
        font-family: 'Poppins', sans-serif;
    }

    .card-post-form {
        background: #fff;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card-post-form:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
    }

    .card-header-custom {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        color: #fff;
        padding: 1.8rem 1.5rem;
        font-weight: 600;
        border-bottom: none;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    .card-header-custom h3 {
        font-size: 1.4rem;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }

    .form-control-custom {
        border-radius: 0.6rem;
        padding: 0.8rem 1rem;
        border: 1px solid #dee2e6;
        transition: all 0.25s ease;
        background-color: #fdfdfd;
    }

    .form-control-custom:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }

    textarea.form-control-custom {
        resize: vertical;
        min-height: 200px;
    }

    .file-input-wrapper {
        border: 2px dashed #cfd8dc;
        border-radius: 0.6rem;
        background: #fafafa;
        padding: 1.2rem;
        transition: all 0.25s ease;
    }

    .file-input-wrapper:hover {
        background: #f1f3f5;
        border-color: #0d6efd;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #198754, #20c997);
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 0.9rem 2rem;
        border-radius: 0.6rem;
        transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #157347, #0d6efd);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
    }

    .btn-primary-custom i {
        vertical-align: middle;
    }

    .helper-text {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-header-custom h3 {
            font-size: 1.2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card card-post-form">

                <div class="card-header card-header-custom">
                    <h3 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i> Create New Blog Post
                    </h3>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Blog Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label">Post Title</label>
                            <input 
                                type="text" 
                                id="title"
                                name="title"
                                class="form-control form-control-custom @error('title') is-invalid @enderror"
                                placeholder="Enter a descriptive and catchy title"
                                value="{{ old('title') }}"
                                required
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Blog Content -->
                        <div class="mb-4">
                            <label for="content" class="form-label">Content</label>
                            <textarea 
                                id="content" 
                                name="content" 
                                class="form-control form-control-custom @error('content') is-invalid @enderror"
                                placeholder="Write your full blog content here..."
                                rows="12"
                                required
                            >{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Blog Image -->
                        <div class="mb-5">
                            <label for="cover_image" class="form-label">Featured Image</label>
                            <div class="file-input-wrapper text-center">
                                <i class="bi bi-cloud-upload fs-3 text-primary mb-2 d-block"></i>
                                <input 
                                    type="file" 
                                    id="cover_image" 
                                    name="cover_image" 
                                    class="form-control @error('cover_image') is-invalid @enderror"
                                    accept="image/*"
                                >
                                <small class="helper-text d-block mt-2">
                                    Accepted formats: JPG, PNG | Max size: 5MB
                                </small>
                            </div>
                            @error('cover_image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-custom btn-lg">
                                <i class="bi bi-cloud-arrow-up me-2"></i> Publish Post
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
