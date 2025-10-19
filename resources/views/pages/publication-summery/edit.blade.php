@extends('layouts.app')

@section('title', 'Edit Publication Summary')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e6e9f0 0%, #eef1f5 100%);
        font-family: 'Inter', sans-serif;
    }
    .container {
        max-width: 700px;
    }
    .card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .card-header {
        background: linear-gradient(to right, #6b7280, #4b5563);
        color: #ffffff;
        border-radius: 15px 15px 0 0;
        padding: 0;
        margin: 0;
        width: 100%;
        text-align: center;
    }
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
        padding: 1.5rem;
        text-align: center;
        width: 100%;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #d1d5db;
        padding: 0.5rem 0.75rem;
        font-size: 0.95rem;
        color: #374151;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        background: #fff;
    }
    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }
    .form-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #000000;
        margin-bottom: 0.5rem;
    }
    .text-danger {
        font-size: 0.8rem;
        font-weight: 500;
    }
    .btn-success {
        background: linear-gradient(to right, #047857, #10b981);
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
        font-weight: 500;
        text-transform: uppercase;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-success:hover {
        background: linear-gradient(to right, #065f46, #059669);
        transform: translateY(-2px);
    }
    .btn-danger, .btn-outline-secondary {
        background: linear-gradient(to right, #dc2626, #b91c1c);
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
        font-weight: 500;
        text-transform: uppercase;
        transition: background 0.3s ease, transform 0.2s ease;
        color: #fff !important;
    }
    .btn-danger:hover, .btn-outline-secondary:hover {
        background: linear-gradient(to right, #b91c1c, #991b1b);
        transform: translateY(-2px);
    }
    .card-body {
        padding: 2rem;
    }
    .alert-danger {
        background: linear-gradient(to right, #dc2626, #b91c1c);
        color: #ffffff;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    .alert-danger ul {
        margin: 0;
        padding-left: 1.5rem;
    }
    .alert-danger li {
        font-size: 0.85rem;
    }
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    .image-upload-container {
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        background: #f9fafb;
        transition: border-color 0.3s ease, background 0.3s ease;
        cursor: pointer;
    }
    .image-upload-container:hover {
        border-color: #2563eb;
        background: #eff6ff;
    }
    .image-upload-container img {
        max-width: 100%;
        max-height: 250px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        margin-bottom: 0.5rem;
    }
</style>

<div class="pt-2">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Publication Summary</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
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
                    <div class="form-group">
                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea 
                            name="content" 
                            id="content" 
                            class="form-control @error('content') is-invalid @enderror" 
                            rows="6" 
                            placeholder="Write publication summary...">{{ old('content', $publicationSummery->content) }}</textarea>
                        @error('content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="image" class="form-label">Upload Image</label>
                        <div class="image-upload-container" onclick="document.getElementById('image').click()">
                            <input 
                                type="file" 
                                name="image" 
                                id="image" 
                                accept="image/*"
                                class="form-control d-none @error('image') is-invalid @enderror"
                                onchange="previewImage(event)">
                            
                            @if($publicationSummery->hasMedia('publication_images'))
                                <img id="preview" src="{{ $publicationSummery->getFirstMediaUrl('publication_images') }}" alt="Preview">
                            @else
                                <img id="preview" src="https://via.placeholder.com/250x150?text=Preview" alt="Preview">
                            @endif
                            <p class="text-muted mt-2 mb-0">Click to change image</p>
                        </div>
                        @error('image')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('publication-summery.index') }}" class="btn btn-danger">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i> Update Summary
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
@endsection
