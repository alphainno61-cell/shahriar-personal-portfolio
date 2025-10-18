@extends('layouts.app')

@section('title', 'Add Publication Summary')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">
                        <i class="bi bi-journal-text me-2"></i>Add Publication Summary
                    </h4>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('publication-summery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Content -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                            <textarea name="content" rows="6" 
                                      class="form-control rounded-3 @error('content') is-invalid @enderror"
                                      placeholder="Write publication summary..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Upload Image</label>
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
                            <a href="{{ route('publication-summery.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                                <i class="bi bi-check2-circle me-2"></i>Save Summary
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
