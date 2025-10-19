@extends('layouts.app')

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
    .image-preview {
        max-width: 100%;
        max-height: 250px;
        object-fit: contain;
        margin-top: 1rem;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        display: none;
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
    .form-check-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #000000; /* Black for checkbox label */
    }
    .form-check-input {
        border-radius: 4px;
        border: 1px solid #d1d5db;
    }
    .form-check-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
</style>

<div class="pt-2">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Associate</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('associates.store') }}" method="POST" enctype="multipart/form-data" id="associateForm">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            class="form-control @error('title') is-invalid @enderror" 
                            value="{{ old('title') }}" 
                            required>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            class="form-control @error('description') is-invalid @enderror" 
                            rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="background_image" class="form-label">Background Image</label>
                        <div class="image-upload-container" id="backgroundUploadContainer">
                            <p class="upload-text">Drag & drop background image here or click to upload</p>
                            <input 
                                type="file" 
                                name="background_image" 
                                id="background_image" 
                                class="form-control @error('background_image') is-invalid @enderror d-none" 
                                accept="image/*">
                            <img id="backgroundPreview" class="image-preview" src="#" alt="Background Image Preview">
                            <div class="progress" id="backgroundUploadProgress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @error('background_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="partner_images" class="form-label">Partner Images (multiple)</label>
                        <div class="image-upload-container" id="partnerUploadContainer">
                            <p class="upload-text">Drag & drop partner images here or click to upload (multiple)</p>
                            <input 
                                type="file" 
                                name="partner_images[]" 
                                id="partner_images" 
                                class="form-control @error('partner_images.*') is-invalid @enderror d-none" 
                                accept="image/*" 
                                multiple>
                            <div id="partnerPreview" class="multi-image-preview"></div>
                            <div class="progress" id="partnerUploadProgress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @error('partner_images.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="is_active" 
                                id="is_active" 
                                value="1" 
                                {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="order_no" class="form-label">Order</label>
                        <input 
                            type="number" 
                            name="order_no" 
                            id="order_no" 
                            class="form-control @error('order_no') is-invalid @enderror" 
                            value="{{ old('order_no', 0) }}">
                        @error('order_no')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-success">Add Associate</button>
                        <a href="{{ route('associates.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Background image upload handler
    const backgroundUploadContainer = document.getElementById('backgroundUploadContainer');
    const backgroundInput = document.getElementById('background_image');
    const backgroundPreview = document.getElementById('backgroundPreview');
    const backgroundProgressBar = document.getElementById('backgroundUploadProgress').querySelector('.progress-bar');
    const backgroundUploadText = backgroundUploadContainer.querySelector('.upload-text');

    backgroundUploadContainer.addEventListener('click', () => {
        backgroundInput.click();
    });

    backgroundUploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        backgroundUploadContainer.classList.add('dragover');
    });

    backgroundUploadContainer.addEventListener('dragleave', () => {
        backgroundUploadContainer.classList.remove('dragover');
    });

    backgroundUploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        backgroundUploadContainer.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            backgroundInput.files = files;
            handleSingleImage(files[0], backgroundPreview, backgroundProgressBar, backgroundUploadText);
        }
    });

    backgroundInput.addEventListener('change', () => {
        if (backgroundInput.files.length > 0) {
            handleSingleImage(backgroundInput.files[0], backgroundPreview, backgroundProgressBar, backgroundUploadText);
        }
    });

    // Partner images upload handler
    const partnerUploadContainer = document.getElementById('partnerUploadContainer');
    const partnerInput = document.getElementById('partner_images');
    const partnerPreview = document.getElementById('partnerPreview');
    const partnerProgressBar = document.getElementById('partnerUploadProgress').querySelector('.progress-bar');
    const partnerUploadText = partnerUploadContainer.querySelector('.upload-text');

    partnerUploadContainer.addEventListener('click', () => {
        partnerInput.click();
    });

    partnerUploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        partnerUploadContainer.classList.add('dragover');
    });

    partnerUploadContainer.addEventListener('dragleave', () => {
        partnerUploadContainer.classList.remove('dragover');
    });

    partnerUploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        partnerUploadContainer.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            partnerInput.files = files;
            handleMultipleImages(files, partnerPreview, partnerProgressBar, partnerUploadText);
        }
    });

    partnerInput.addEventListener('change', () => {
        if (partnerInput.files.length > 0) {
            handleMultipleImages(partnerInput.files, partnerPreview, partnerProgressBar, partnerUploadText);
        }
    });

    function handleSingleImage(file, preview, progressBar, uploadText) {
        if (!file.type.startsWith('image/')) {
            uploadText.textContent = 'Please upload a valid image file';
            uploadText.style.color = '#dc2626';
            return;
        }

        const reader = new FileReader();
        reader.onloadstart = () => {
            progressBar.parentElement.style.display = 'block';
            uploadText.textContent = 'Uploading...';
        };
        reader.onprogress = (e) => {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = `${percent}%`;
                progressBar.setAttribute('aria-valuenow', percent);
            }
        };
        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            progressBar.parentElement.style.display = 'none';
            uploadText.textContent = 'Image uploaded! Click or drag to replace';
            uploadText.style.color = '#6b7280';
        };
        reader.readAsDataURL(file);
    }

    function handleMultipleImages(files, previewContainer, progressBar, uploadText) {
        if ([...files].some(file => !file.type.startsWith('image/'))) {
            uploadText.textContent = 'Please upload valid image files';
            uploadText.style.color = '#dc2626';
            return;
        }

        previewContainer.innerHTML = ''; // Clear previous previews
        let loadedImages = 0;
        const totalImages = files.length;

        progressBar.parentElement.style.display = 'block';
        uploadText.textContent = 'Uploading...';

        [...files].forEach(file => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                previewContainer.appendChild(img);
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
@endsection