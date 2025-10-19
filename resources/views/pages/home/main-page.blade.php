@extends('layouts.app')

@section('title')
    Welcome Home
@endsection

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
        color: #000000; /* Updated to black */
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
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
</style>

<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Main Page Content</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('main.page.index') }}" enctype="multipart/form-data" id="mainForm">
                @csrf

                <div class="form-group">
                    <label for="banner_text" class="form-label">Banner Text <span class="text-danger">*</span></label>
                    <textarea 
                        class="form-control @error('banner_text') is-invalid @enderror" 
                        name="banner_text" 
                        id="banner_text" 
                        rows="4"
                        placeholder="Enter banner text" 
                        required>{{ old('banner_text') }}</textarea>
                    @error('banner_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="moto" class="form-label">Moto <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        name="moto" 
                        class="form-control @error('moto') is-invalid @enderror" 
                        id="moto" 
                        placeholder="Enter moto" 
                        value="{{ old('moto') }}" 
                        required>
                    @error('moto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="experience" class="form-label">Experience</label>
                            <input 
                                type="number" 
                                name="experience" 
                                class="form-control @error('experience') is-invalid @enderror" 
                                id="experience" 
                                placeholder="Enter years of experience"
                                value="{{ old('experience') }}">
                            @error('experience')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="projects" class="form-label">Projects</label>
                            <input 
                                type="number" 
                                name="projects" 
                                class="form-control @error('projects') is-invalid @enderror" 
                                id="projects" 
                                placeholder="Total projects"
                                value="{{ old('projects') }}">
                            @error('projects')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="certification" class="form-label">Certifications</label>
                            <input 
                                type="number" 
                                name="certification" 
                                class="form-control @error('certification') is-invalid @enderror" 
                                id="certification" 
                                placeholder="Total certifications"
                                value="{{ old('certification') }}">
                            @error('certification')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="books" class="form-label">Books</label>
                            <input 
                                type="number" 
                                name="books" 
                                class="form-control @error('books') is-invalid @enderror" 
                                id="books" 
                                placeholder="Books published"
                                value="{{ old('books') }}">
                            @error('books')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="mentoring" class="form-label">Mentoring</label>
                            <input 
                                type="number" 
                                name="mentoring" 
                                class="form-control @error('mentoring') is-invalid @enderror" 
                                id="mentoring" 
                                placeholder="Mentoring count"
                                value="{{ old('mentoring') }}">
                            @error('mentoring')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="article" class="form-label">Articles</label>
                            <input 
                                type="number" 
                                name="article" 
                                class="form-control @error('article') is-invalid @enderror" 
                                id="article" 
                                placeholder="Total articles"
                                value="{{ old('article') }}">
                            @error('article')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="banner_image" class="form-label">Banner Image</label>
                    <div class="image-upload-container" id="imageUploadContainer">
                        <p class="upload-text">Drag & drop your image here or click to upload</p>
                        <input 
                            type="file" 
                            name="banner_image" 
                            id="banner_image" 
                            class="form-control @error('banner_image') is-invalid @enderror d-none" 
                            accept="image/*">
                        <img id="imagePreview" class="image-preview" src="#" alt="Image Preview">
                        <div class="progress" id="uploadProgress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        @error('banner_image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('main.page.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const imageUploadContainer = document.getElementById('imageUploadContainer');
    const imageInput = document.getElementById('banner_image');
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
            handleImage(files[0]);
        }
    });

    // Handle file input change
    imageInput.addEventListener('change', () => {
        if (imageInput.files.length > 0) {
            handleImage(imageInput.files[0]);
        }
    });

    function handleImage(file) {
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
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            progressBar.parentElement.style.display = 'none';
            uploadText.textContent = 'Image uploaded! Click or drag to replace';
            uploadText.style.color = '#6b7280';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection