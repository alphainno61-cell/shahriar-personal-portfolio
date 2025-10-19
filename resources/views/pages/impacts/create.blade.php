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
    .btn-secondary {
        background: linear-gradient(to right, #6b7280, #4b5563);
        border: none;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        color: #ffffff;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-secondary:hover {
        background: linear-gradient(to right, #4b5563, #374151);
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
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
</style>

<div class="pt-2">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Impact</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('impacts.store') }}" method="POST" enctype="multipart/form-data" id="impactForm">
                    @csrf

                    <div class="form-group">
                        <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                        <select 
                            name="type" 
                            id="type" 
                            class="form-control @error('type') is-invalid @enderror" 
                            required>
                            <option value="" {{ old('type') == '' ? 'selected' : '' }}>Select Type</option>
                            <option value="entrepreneur" {{ old('type') == 'entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                            <option value="technology" {{ old('type') == 'technology' ? 'selected' : '' }}>Technology</option>
                        </select>
                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

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
                            rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Images (up to 4)</label>
                        @for($i = 1; $i <= 4; $i++)
                            <div class="image-upload-container mb-3" id="imageUploadContainer{{ $i }}">
                                <p class="upload-text">Drag & drop image {{ $i }} here or click to upload</p>
                                <input 
                                    type="file" 
                                    name="image{{ $i }}" 
                                    id="image{{ $i }}" 
                                    class="form-control @error('image' . $i) is-invalid @enderror d-none" 
                                    accept="image/*">
                                <img id="preview{{ $i }}" class="image-preview" src="#" alt="Image {{ $i }} Preview">
                                <div class="progress" id="uploadProgress{{ $i }}">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                @error('image' . $i)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endfor
                    </div>

                    <div class="form-group">
                        <label class="form-label">Impact Points</label>
                        <div id="points-wrapper">
                            <input 
                                type="text" 
                                name="points[]" 
                                class="form-control mb-2 @error('points.*') is-invalid @enderror" 
                                placeholder="Enter impact point" 
                                value="{{ old('points.0') }}">
                            @error('points.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addPoint()">+ Add Point</button>
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
                        <button type="submit" class="btn btn-success">Save Impact</button>
                        <a href="{{ route('impacts.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Image upload handlers for multiple images
    @for($i = 1; $i <= 4; $i++)
        const imageUploadContainer{{ $i }} = document.getElementById('imageUploadContainer{{ $i }}');
        const imageInput{{ $i }} = document.getElementById('image{{ $i }}');
        const imagePreview{{ $i }} = document.getElementById('preview{{ $i }}');
        const progressBar{{ $i }} = document.getElementById('uploadProgress{{ $i }}').querySelector('.progress-bar');
        const uploadText{{ $i }} = imageUploadContainer{{ $i }}.querySelector('.upload-text');

        imageUploadContainer{{ $i }}.addEventListener('click', () => {
            imageInput{{ $i }}.click();
        });

        imageUploadContainer{{ $i }}.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUploadContainer{{ $i }}.classList.add('dragover');
        });

        imageUploadContainer{{ $i }}.addEventListener('dragleave', () => {
            imageUploadContainer{{ $i }}.classList.remove('dragover');
        });

        imageUploadContainer{{ $i }}.addEventListener('drop', (e) => {
            e.preventDefault();
            imageUploadContainer{{ $i }}.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                imageInput{{ $i }}.files = files;
                handleImage(files[0], imagePreview{{ $i }}, progressBar{{ $i }}, uploadText{{ $i }});
            }
        });

        imageInput{{ $i }}.addEventListener('change', () => {
            if (imageInput{{ $i }}.files.length > 0) {
                handleImage(imageInput{{ $i }}.files[0], imagePreview{{ $i }}, progressBar{{ $i }}, uploadText{{ $i }});
            }
        });
    @endfor

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

    function addPoint() {
        let wrapper = document.getElementById('points-wrapper');
        let input = document.createElement('input');
        input.type = 'text';
        input.name = 'points[]';
        input.className = 'form-control mb-2';
        input.placeholder = 'Enter impact point';
        wrapper.appendChild(input);
    }
});
</script>
@endsection