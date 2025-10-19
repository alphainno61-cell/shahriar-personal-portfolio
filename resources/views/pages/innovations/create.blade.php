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
        margin: 0.5rem;
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
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    #preview-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
</style>

<div class="pt-2">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Innovation</h3>
            </div>
            <div class="card-body">

                <form action="{{ route('innovations.store') }}" method="POST" enctype="multipart/form-data" id="innovationForm">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            class="form-control @error('title') is-invalid @enderror" 
                            placeholder="Enter title" 
                            value="{{ old('title') }}" required>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="form-label">Content<span class="text-danger">*</span></label>
                        <textarea 
                            name="content" 
                            id="content" 
                            class="form-control @error('content') is-invalid @enderror" 
                            rows="5" 
                            placeholder="Enter content" required>{{ old('content') }}</textarea>
                        @error('content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="images" class="form-label">Upload Images</label>
                        <div class="image-upload-container" id="imageUploadContainer">
                            <p class="upload-text">Drag & drop images here or click to upload (multiple allowed)</p>
                            <input 
                                type="file" 
                                name="images[]" 
                                id="images" 
                                class="form-control @error('images') is-invalid @enderror d-none" 
                                multiple 
                                accept="image/*">
                            <div id="preview-container" class="d-flex flex-wrap justify-content-center"></div>
                            <div class="progress" id="imageUploadProgress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @error('images')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <small class="text-muted mt-1 d-block">You can upload multiple images.</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('innovations.index') }}" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Innovation</button>
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
    const previewContainer = document.getElementById('preview-container');
    const progressBar = document.getElementById('imageUploadProgress').querySelector('.progress-bar');
    const uploadText = imageUploadContainer.querySelector('.upload-text');

    // Trigger file input click when clicking the container
    imageUploadContainer.addEventListener('click', (e) => {
        // Prevent triggering click on preview images
        if (!e.target.classList.contains('image-preview')) {
            imageInput.click();
        }
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
        const validImages = Array.from(files).filter(file => file.type.startsWith('image/'));
        if (validImages.length !== files.length) {
            uploadText.textContent = 'Please upload valid image files only';
            uploadText.style.color = '#dc2626';
            return;
        }

        previewContainer.innerHTML = ''; // Clear previous previews
        let loadedImages = 0;

        validImages.forEach((file, index) => {
            const reader = new FileReader();
            reader.onloadstart = () => {
                progressBar.parentElement.style.display = 'block';
                uploadText.textContent = 'Uploading images...';
            };
            reader.onprogress = (e) => {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100 / validImages.length);
                    progressBar.style.width = `${percent}%`;
                    progressBar.setAttribute('aria-valuenow', percent);
                }
            };
            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('image-preview');
                previewContainer.appendChild(img);
                loadedImages++;
                if (loadedImages === validImages.length) {
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