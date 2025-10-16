@extends('layouts.app')

@section('title')
    Create Blog
@endsection

@push('styles')
<style>
    /* Custom styles for a more professional, "admin-like" look */
    body {
        background-color: #f8f9fa; /* Light gray background */
    }
    .card-post-form {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 0.75rem; /* Slightly rounded corners */
        border: none;
    }
    .card-header-custom {
        background-color: #0d6efd; /* Primary blue header */
        color: white;
        border-radius: 0.75rem 0.75rem 0 0;
        padding: 1.5rem 1.5rem;
        font-weight: 600;
    }
    .form-control-custom {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
    }
    .btn-primary-custom {
        background-color: #198754; /* Success green button for "Publish" */
        border-color: #198754;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 0.5rem;
    }
    .btn-primary-custom:hover {
        background-color: #157347;
        border-color: #157347;
    }
    .file-input-wrapper {
        border: 1px solid #ced4da;
        border-radius: 0.5rem;
        padding: 1rem;
        background-color: #fff;
    }
</style>
@endpush

@section('content')
<div class="mt-2">
    <div class="row width-100">
        <div class="col-lg-10 col-xl-8 mx-auto">
            <div class="card card-post-form">
                
                <div class="card-header card-header-custom">
                    <h3 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i> Create New Blog Post
                    </h3>
                </div>

                <div class="card-body p-4 p-md-5">
                    
                    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf 

                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Post Title</label>
                            <input 
                                type="text" 
                                class="form-control form-control-lg form-control-custom @error('title') is-invalid @enderror" 
                                id="title" 
                                name="title" 
                                placeholder="Enter a descriptive and catchy title" 
                                value="{{ old('title') }}" 
                                required
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label fw-bold">Content</label>
                            <textarea 
                                class="form-control form-control-custom @error('content') is-invalid @enderror" 
                                id="content" 
                                name="content" 
                                rows="15" 
                                placeholder="Write your full blog post content here..." 
                                required
                            >{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="cover_image" class="form-label fw-bold">Featured Image</label>
                            <div class="file-input-wrapper">
                                <input 
                                    class="form-control @error('cover_image') is-invalid @enderror" 
                                    type="file" 
                                    id="cover_image" 
                                    name="cover_image" 
                                    accept="image/*" 
                                    
                                >
                                <small class="text-muted mt-2 d-block">Accepted formats: JPG, PNG. Max size: 2MB.</small>
                            </div>
                            @error('cover_image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary-custom btn-lg w-100 w-md-auto">
                                <i class="bi bi-cloud-upload me-2"></i> Publish Post
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
