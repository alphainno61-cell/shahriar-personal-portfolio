@extends('layouts.app')

@section('content')
<div class="pt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8" style="max-width: 80%;">

            <div class="card shadow-lg border-0 rounded-4 mx-auto">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">Add New Innovation</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('innovations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Title</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="form-control @error('title') is-invalid @enderror" 
                                value="{{ old('title') }}" 
                                placeholder="Enter title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">Content</label>
                            <textarea 
                                name="content" 
                                id="content" 
                                class="form-control @error('content') is-invalid @enderror" 
                                rows="5" 
                                placeholder="Enter content">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Multiple Images -->
                        <div class="mb-3">
                            <label for="images" class="form-label fw-semibold">Upload Images</label>
                            <input 
                                type="file" 
                                name="images[]" 
                                id="images" 
                                class="form-control @error('images') is-invalid @enderror" 
                                multiple 
                                accept="image/*">
                            <small class="text-muted">You can upload multiple images.</small>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preview -->
                        <div class="mb-3 d-flex flex-wrap" id="preview-container"></div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-3">
                                <i class="bi bi-plus-circle me-1"></i> Add Innovation
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
    const imagesInput = document.getElementById('images');
    const previewContainer = document.getElementById('preview-container');

    imagesInput.addEventListener('change', function() {
        previewContainer.innerHTML = '';
        Array.from(this.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'me-2', 'mb-2');
                img.style.maxHeight = '150px';
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush
