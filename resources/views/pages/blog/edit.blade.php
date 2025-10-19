@extends('layouts.app')

@section('title', 'Edit Blog')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #eef2f7, #ffffff);
        font-family: "Poppins", sans-serif;
    }

    .card-post-form {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        background: #fff;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card-post-form:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
    }

    .card-header-custom {
        background: linear-gradient(90deg, #007bff, #6610f2);
        color: #fff;
        padding: 1.5rem 2rem;
        border-bottom: none;
    }

    .card-header-custom h3 {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    .form-control-custom {
        border-radius: 0.5rem;
        padding: 0.8rem 1rem;
        border: 1px solid #ced4da;
        transition: all 0.2s ease;
    }

    .form-control-custom:focus {
        border-color: #6610f2;
        box-shadow: 0 0 0 0.2rem rgba(102, 16, 242, 0.2);
    }

    .file-input-wrapper {
        border: 1px dashed #6c757d;
        background-color: #fafbfc;
        padding: 1.2rem;
        border-radius: 0.75rem;
        transition: all 0.2s ease;
    }

    .file-input-wrapper:hover {
        background-color: #f1f3f5;
        border-color: #6610f2;
    }

    .btn-primary-custom {
        background: linear-gradient(90deg, #28a745, #20c997);
        border: none;
        padding: 0.8rem 2rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        color: #fff;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(90deg, #20c997, #28a745);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
    }

    .current-image-box {
        border: 1px solid #dee2e6;
        border-radius: 0.75rem;
        background-color: #f8f9fa;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .current-image-box img {
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .info-text {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="mt-4">
    <div class="row">
        <div class="col-lg-10 col-xl-8 mx-auto">
            <div class="card card-post-form">
                
                <div class="card-header card-header-custom d-flex align-items-center">
                    <i class="bi bi-pencil-square fs-4 me-2"></i>
                    <h3 class="mb-0">Edit Blog Post</h3>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="form-label">Post Title</label>
                            <input 
                                type="text" 
                                class="form-control form-control-lg form-control-custom @error('title') is-invalid @enderror" 
                                id="title" 
                                name="title" 
                                placeholder="Enter a descriptive title" 
                                value="{{ old('title', $blog->title) }}" 
                                required
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label">Content</label>
                            <textarea 
                                class="form-control form-control-custom @error('content') is-invalid @enderror" 
                                id="content" 
                                name="content" 
                                rows="10" 
                                placeholder="Write your full blog post here..." 
                                required
                            >{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($blog->getFirstMediaUrl('blog_cover_image'))
                            <div class="mb-4">
                                <label class="form-label">Current Featured Image</label>
                                <div class="current-image-box">
                                    <div>
                                        <span class="info-text d-block mb-2">Existing featured image:</span>
                                        <img 
                                            src="{{ $blog->getFirstMediaUrl('blog_cover_image', 'thumb') }}" 
                                            alt="Current Cover Image" 
                                            style="max-height: 100px; max-width: 150px; object-fit: cover;"
                                        >
                                    </div>
                                </div>
                                <p class="info-text mt-2">Upload a new file below to replace the current image.</p>
                            </div>
                        @endif

                        <div class="mb-5">
                            <label for="cover_image" class="form-label">Upload New Image</label>
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
                                <i class="bi bi-arrow-repeat me-2"></i> Update Post
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
