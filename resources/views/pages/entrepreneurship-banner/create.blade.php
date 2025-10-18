@extends('layouts.app')

@section('content')
<div class="pt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 col-xl-8" style="max-width: 80%;"">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">Add New Entrepreneurship Banner</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('enterpreneurship-banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Title</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="form-control @error('title') is-invalid @enderror" 
                                placeholder="Enter banner title" 
                                value="{{ old('title') }}"
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Upload Banner Image <span class="text-danger">*</span></label>
                            <input 
                                type="file" 
                                name="image" 
                                id="image" 
                                class="form-control @error('image') is-invalid @enderror"
                                accept="image/*"
                                required
                            >
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preview -->
                        <div class="mb-3 text-center">
                            <img id="preview-image" src="#" alt="Preview" class="img-fluid rounded d-none" style="max-height: 200px;">
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-3">
                                <i class="bi bi-upload me-1"></i> Upload Banner
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
    document.getElementById('image').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('preview-image');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endpush
