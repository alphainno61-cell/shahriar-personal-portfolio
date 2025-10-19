@extends('layouts.app')

@section('title', 'Add Recommended Books')

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
    .form-control, select.form-control {
        border-radius: 10px;
        border: 1px solid #d1d5db;
        padding: 0.5rem 0.75rem;
        font-size: 0.95rem;
        color: #374151;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        background: #fff;
    }
    .form-control:focus, select.form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }
    .form-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #000000; /* Black for labels */
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
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-success:hover {
        background: linear-gradient(to right, #065f46, #059669);
        transform: translateY(-2px);
    }
    .btn-danger {
        background: linear-gradient(to right, #dc2626, #b91c1c);
        border: none;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-danger:hover {
        background: linear-gradient(to right, #b91c1c, #991b1b);
        transform: translateY(-2px);
    }
    .image-upload-container {
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        background: #f9fafb;
        transition: border-color 0.3s ease, background 0.3s ease;
        position: relative;
    }
    .image-upload-container.dragover {
        border-color: #2563eb;
        background: #eff6ff;
    }
    .multi-image-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
    }
    .multi-image-preview img {
        max-width: 150px;
        max-height: 150px;
        object-fit: contain;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }
    .progress {
        height: 10px;
        margin-top: 1rem;
        border-radius: 5px;
        display: none;
    }
    .upload-text {
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .form-group {
        margin-bottom: 1.5rem;
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
    .text-muted {
        font-size: 0.8rem;
        color: #6b7280;
    }
</style>

<div class="pt-2">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="bi bi-book-half me-2"></i>Add Recommended Books</h3>
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

                <form action="{{ route('recommended-books.store') }}" method="POST" enctype="multipart/form-data" id="recommendedBooksForm">
                    @csrf

                    <div class="form-group">
                        <label for="images" class="form-label">Upload Book Images <span class="text-danger">*</span></label>
                        <div class="image-upload-container" id="imageUploadContainer">
                            <p class="upload-text">Drag & drop book images here or click to upload (multiple)</p>
                            <input 
                                type="file" 
                                name="images[]" 
                                id="images" 
                                class="form-control @error('images.*') is-invalid @enderror d-none" 
                                accept="image/png,image/jpeg,image/webp" 
                                multiple 
                                required>
                            <div id="imagePreview" class="multi-image-preview"></div>
                            <div class="progress" id="uploadProgress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted d-block mt-2">You can upload multiple images at once.</small>
                            @error('images.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('recommended-books.index') }}" class="btn btn-danger">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check2-circle me-2"></i>Save Books
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const imageUploadContainer = document.getElementById('imageUploadContainer');
    const imageInput = document.getElementById('images');
    const imagePreview = document.getElementById('imagePreview');
    const progressBar = document.getElementById('uploadProgress').querySelector('.progress-bar');
    const uploadText = imageUploadContainer.querySelector('.upload-text');

    // Trigger file input click when clicking the container
    imageUploadContainer.addEventListener('click', () => {
        imageInput.click();
    });

    // Handle drag and drop
    imageUploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageUploadContainer.classList.add('dragover');
    });

    imageUploadContainer.addEventListener('dragleave', () => {
        imageUploadContainer.classList.remove('dragover');
    });

    imageUploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        imageUploadContainer.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            handleImages(files);
        }
    });

    // Handle file input change
    imageInput.addEventListener('change', () => {
        if (imageInput.files.length > 0) {
            handleImages(imageInput.files);
        }
    });

    function handleImages(files) {
        if ([...files].some(file => !file.type.startsWith('image/'))) {
            uploadText.textContent = 'Please upload valid image files';
            uploadText.style.color = '#dc2626';
            return;
        }

        imagePreview.innerHTML = ''; // Clear previous previews
        let loadedImages = 0;
        const totalImages = files.length;

        progressBar.parentElement.style.display = 'block';
        uploadText.textContent = 'Uploading...';

        [...files].forEach(file => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                imagePreview.appendChild(img);
                loadedImages++;
                const percent = Math.round((loadedImages / totalImages) * 100);
                progressBar.style.width = `${percent}%`;
                progressBar.setAttribute('aria-valuenow', percent);
                if (loadedImages === totalImages) {
                    progressBar.parentElement.style.display = 'none';
                    uploadText.textContent = 'Images uploaded! Click or drag to replace';
                    uploadText.style.color = '#6b7280';
                }
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>
@endpush
@endsection