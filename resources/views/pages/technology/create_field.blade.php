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
</style>

<div class="pt-2">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Technology Field</h3>
            </div>
            <div class="card-body">

                <form action="{{ route('technology.storeField') }}" method="POST" enctype="multipart/form-data" id="technologyFieldForm">
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
                        <label for="subtitle" class="form-label">Subtitle</label>
                        <input 
                            type="text" 
                            name="subtitle" 
                            id="subtitle" 
                            class="form-control @error('subtitle') is-invalid @enderror" 
                            value="{{ old('subtitle') }}">
                        @error('subtitle')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            class="form-control @error('description') is-invalid @enderror" 
                            rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Main Image</label>
                        <div class="image-upload-container" id="mainImageUploadContainer">
                            <p class="upload-text">Drag & drop main image here or click to upload</p>
                            <input 
                                type="file" 
                                name="image" 
                                id="image" 
                                class="form-control @error('image') is-invalid @enderror d-none" 
                                accept="image/*">
                            <img id="mainImagePreview" class="image-preview" src="#" alt="Main Image Preview">
                            <div class="progress" id="mainImageUploadProgress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="frame_image" class="form-label">Frame Image</label>
                        <div class="image-upload-container" id="frameImageUploadContainer">
                            <p class="upload-text">Drag & drop frame image here or click to upload</p>
                            <input 
                                type="file" 
                                name="frame_image" 
                                id="frame_image" 
                                class="form-control @error('frame_image') is-invalid @enderror d-none" 
                                accept="image/*">
                            <img id="frameImagePreview" class="image-preview" src="#" alt="Frame Image Preview">
                            <div class="progress" id="frameImageUploadProgress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @error('frame_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tools_title" class="form-label">Tools Title</label>
                        <input 
                            type="text" 
                            name="tools_title" 
                            id="tools_title" 
                            class="form-control @error('tools_title') is-invalid @enderror" 
                            value="{{ old('tools_title') }}">
                        @error('tools_title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tools_description" class="form-label">Tools Description</label>
                        <textarea 
                            name="tools_description" 
                            id="tools_description" 
                            class="form-control @error('tools_description') is-invalid @enderror" 
                            rows="3">{{ old('tools_description') }}</textarea>
                        @error('tools_description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('technology.index') }}" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Main Image Upload Handler
    const mainImageUploadContainer = document.getElementById('mainImageUploadContainer');
    const mainImageInput = document.getElementById('image');
    const mainImagePreview = document.getElementById('mainImagePreview');
    const mainImageProgressBar = document.getElementById('mainImageUploadProgress').querySelector('.progress-bar');
    const mainImageUploadText = mainImageUploadContainer.querySelector('.upload-text');

    mainImageUploadContainer.addEventListener('click', () => {
        mainImageInput.click();
    });

    mainImageUploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        mainImageUploadContainer.classList.add('dragover');
    });

    mainImageUploadContainer.addEventListener('dragleave', () => {
        mainImageUploadContainer.classList.remove('dragover');
    });

    mainImageUploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        mainImageUploadContainer.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            mainImageInput.files = files;
            handleImage(files[0], mainImagePreview, mainImageProgressBar, mainImageUploadText);
        }
    });

    mainImageInput.addEventListener('change', () => {
        if (mainImageInput.files.length > 0) {
            handleImage(mainImageInput.files[0], mainImagePreview, mainImageProgressBar, mainImageUploadText);
        }
    });

    // Frame Image Upload Handler
    const frameImageUploadContainer = document.getElementById('frameImageUploadContainer');
    const frameImageInput = document.getElementById('frame_image');
    const frameImagePreview = document.getElementById('frameImagePreview');
    const frameImageProgressBar = document.getElementById('frameImageUploadProgress').querySelector('.progress-bar');
    const frameImageUploadText = frameImageUploadContainer.querySelector('.upload-text');

    frameImageUploadContainer.addEventListener('click', () => {
        frameImageInput.click();
    });

    frameImageUploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        frameImageUploadContainer.classList.add('dragover');
    });

    frameImageUploadContainer.addEventListener('dragleave', () => {
        frameImageUploadContainer.classList.remove('dragover');
    });

    frameImageUploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        frameImageUploadContainer.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            frameImageInput.files = files;
            handleImage(files[0], frameImagePreview, frameImageProgressBar, frameImageUploadText);
        }
    });

    frameImageInput.addEventListener('change', () => {
        if (frameImageInput.files.length > 0) {
            handleImage(frameImageInput.files[0], frameImagePreview, frameImageProgressBar, frameImageUploadText);
        }
    });

    function handleImage(file, preview, progressBar, uploadText) {
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
});
</script>
@endpush
@endsection