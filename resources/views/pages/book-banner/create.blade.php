@extends('layouts.app')

@section('title', 'Add New Book Banner')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0"><i class="bi bi-bookmark-plus-fill me-2"></i>Add New Book Banner</h4>
                </div>
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('book-banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title"
                                   class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror"
                                   placeholder="Enter book title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description" rows="4"
                                      class="form-control rounded-3 @error('description') is-invalid @enderror"
                                      placeholder="Write a short description...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="form-label fw-semibold">Price</label>
                            <input type="text" name="price" id="price"
                                   class="form-control form-control-lg rounded-3 @error('price') is-invalid @enderror"
                                   placeholder="Enter price (optional)" value="{{ old('price') }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Banner Image</label>
                            <div class="text-center border border-2 border-dashed rounded-3 p-4 bg-light"
                                 style="cursor: pointer;" onclick="document.getElementById('image').click()">
                                <input type="file" name="image" id="image" accept="image/*"
                                       class="form-control d-none @error('image') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                <img id="preview" src="https://via.placeholder.com/250x150?text=Preview" alt="Preview"
                                     class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                                <p class="text-muted mt-2 mb-0">Click to upload image</p>
                            </div>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('book-banners.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                                <i class="bi bi-check2-circle me-2"></i>Save Book Banner
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const output = document.getElementById('preview');
        const file = event.target.files[0];
        if (file) {
            output.src = URL.createObjectURL(file);
        } else {
            output.src = "https://via.placeholder.com/250x150?text=Preview";
        }
    }
    </script>
@endpush
