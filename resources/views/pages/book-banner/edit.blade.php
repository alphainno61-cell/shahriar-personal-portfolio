@extends('layouts.app')

@section('title', 'Edit Book Banner')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i>Edit Book Banner
            </h5>
            <a href="{{ route('book-banners.index') }}" class="btn btn-light btn-sm rounded-pill ms-auto">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('book-banners.update', $bookBanner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Title -->
                    <div class="col-md-6">
                        <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title"
                               value="{{ old('title', $bookBanner->title) }}"
                               class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror"
                               placeholder="Enter book title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-semibold">Price</label>
                        <input type="text" name="price" id="price"
                               value="{{ old('price', $bookBanner->price) }}"
                               class="form-control form-control-lg rounded-3 @error('price') is-invalid @enderror"
                               placeholder="Enter book price">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="form-control form-control-lg rounded-3 @error('description') is-invalid @enderror"
                                  placeholder="Enter short description">{{ old('description', $bookBanner->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="col-12">
                        <label for="image" class="form-label fw-semibold">Banner Image</label>
                        <input type="file" name="image" id="image"
                               class="form-control form-control-lg rounded-3 @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Show Current Image -->
                        @if($bookBanner->hasMedia('banner_image'))
                            <div class="mt-3">
                                <p class="fw-semibold mb-2">Current Image:</p>
                                <img src="{{ $bookBanner->getFirstMediaUrl('banner_image') }}"
                                     alt="{{ $bookBanner->title }}"
                                     class="img-thumbnail rounded-3 shadow-sm"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-4">
                        <i class="bi bi-save me-2"></i>Update Banner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
