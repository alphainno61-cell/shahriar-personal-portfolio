@extends('layouts.app')

@section('title', 'Edit Publication publicationSummery')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-journal-text me-2"></i>Edit Publication publicationSummery
                    </h4>
                    <a href="{{ route('publication-summery.index') }}" class="btn btn-light btn-sm rounded-pill">
                        <i class="bi bi-arrow-left me-1"></i>Back
                    </a>
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

                    <form action="{{ route('publication-summery.update', $publicationSummery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Content -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                            <textarea name="content" rows="6" 
                                      class="form-control rounded-3 @error('content') is-invalid @enderror"
                                      placeholder="Write publication publicationSummery..." required>{{ old('content', $publicationSummery->content) }}</textarea>
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

                                @if($publicationSummery->hasMedia('publication_images'))
                                    <img id="preview" src="{{ $publicationSummery->getFirstMediaUrl('publication_images') }}" 
                                         alt="Preview" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                                @else
                                    <img id="preview" src="https://via.placeholder.com/250x150?text=Preview" 
                                         alt="Preview" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                                @endif

                                <p class="text-muted mt-2 mb-0">Click to change image</p>
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
                            <button type="submit" class="btn btn-success rounded-pill px-4 py-2">
                                <i class="bi bi-save me-2"></i>Update publicationSummery
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
        }
    }
    </script>
@endpush
