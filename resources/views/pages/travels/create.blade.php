{{-- @extends('layouts.app')

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
</style>

<div class="pt-2">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Travel Country</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('travels.store') }}" method="POST" enctype="multipart/form-data" id="travelForm">
                    @csrf

                    <div class="form-group">
                        <label for="country_name" class="form-label">Country Name <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="country_name" 
                            id="country_name" 
                            class="form-control @error('country_name') is-invalid @enderror" 
                            value="{{ old('country_name') }}" 
                            required>
                        @error('country_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="country_flag_path" class="form-label">Country Flag</label>
                        <div class="image-upload-container" id="flagUploadContainer">
                            <p class="upload-text">Drag & drop country flag here or click to upload</p>
                            <input 
                                type="file" 
                                name="country_flag_path" 
                                id="country_flag_path" 
                                class="form-control @error('country_flag_path') is-invalid @enderror d-none" 
                                accept="image/*">
                            <img id="flagPreview" class="image-preview" src="#" alt="Flag Preview">
                            <div class="progress" id="flagUploadProgress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @error('country_flag_path')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="map_image_path" class="form-label">Map Image</label>
                        <div class="image-upload-container" id="mapUploadContainer">
                            <p class="upload-text">Drag & drop map image here or click to upload</p>
                            <input 
                                type="file" 
                                name="map_image_path" 
                                id="map_image_path" 
                                class="form-control @error('map_image_path') is-invalid @enderror d-none" 
                                accept="image/*">
                            <img id="mapPreview" class="image-preview" src="#" alt="Map Preview">
                            <div class="progress" id="mapUploadProgress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @error('map_image_path')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="order_no" class="form-label">Order No</label>
                        <input 
                            type="number" 
                            name="order_no" 
                            id="order_no" 
                            class="form-control @error('order_no') is-invalid @enderror" 
                            value="{{ old('order_no', 1) }}">
                        @error('order_no')
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
                        <button type="submit" class="btn btn-success">Save Country</button>
                        <a href="{{ route('travels.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Flag image upload handler
    const flagUploadContainer = document.getElementById('flagUploadContainer');
    const flagInput = document.getElementById('country_flag_path');
    const flagPreview = document.getElementById('flagPreview');
    const flagProgressBar = document.getElementById('flagUploadProgress').querySelector('.progress-bar');
    const flagUploadText = flagUploadContainer.querySelector('.upload-text');

    flagUploadContainer.addEventListener('click', () => {
        flagInput.click();
    });

    flagUploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        flagUploadContainer.classList.add('dragover');
    });

    flagUploadContainer.addEventListener('dragleave', () => {
        flagUploadContainer.classList.remove('dragover');
    });

    flagUploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        flagUploadContainer.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            flagInput.files = files;
            handleImage(files[0], flagPreview, flagProgressBar, flagUploadText);
        }
    });

    flagInput.addEventListener('change', () => {
        if (flagInput.files.length > 0) {
            handleImage(flagInput.files[0], flagPreview, flagProgressBar, flagUploadText);
        }
    });

    // Map image upload handler
    const mapUploadContainer = document.getElementById('mapUploadContainer');
    const mapInput = document.getElementById('map_image_path');
    const mapPreview = document.getElementById('mapPreview');
    const mapProgressBar = document.getElementById('mapUploadProgress').querySelector('.progress-bar');
    const mapUploadText = mapUploadContainer.querySelector('.upload-text');

    mapUploadContainer.addEventListener('click', () => {
        mapInput.click();
    });

    mapUploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        mapUploadContainer.classList.add('dragover');
    });

    mapUploadContainer.addEventListener('dragleave', () => {
        mapUploadContainer.classList.remove('dragover');
    });

    mapUploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        mapUploadContainer.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            mapInput.files = files;
            handleImage(files[0], mapPreview, mapProgressBar, mapUploadText);
        }
    });

    mapInput.addEventListener('change', () => {
        if (mapInput.files.length > 0) {
            handleImage(mapInput.files[0], mapPreview, mapProgressBar, mapUploadText);
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
@endsection --}}


@extends('layouts.app')

@section('title', 'Create Innovation')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">Add New Innovation</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('travels.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Title</label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter title" required>
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label fw-bold">Content</label>
                            <textarea name="content" id="content" class="form-control form-control-lg" rows="5" placeholder="Enter content" required></textarea>
                        </div>

                        <!-- Map Image -->
                        <div class="mb-4">
                            <label for="map_image" class="form-label fw-bold">Map Image</label>
                            <input type="file" name="map_image" id="map_image" class="form-control form-control-lg" accept="image/*" required>
                            <div class="mt-2">
                                <img id="map_preview" src="#" alt="Map Preview" class="img-fluid rounded shadow-sm" style="display: none; max-height: 200px;">
                            </div>
                        </div>

                        <!-- Countries -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Countries</label>
                            <div id="countries-wrapper">
                                <div class="row g-2 align-items-center country-item mb-2">
                                    <div class="col-md-5">
                                        <input type="text" name="countries[0][name]" class="form-control form-control-lg" placeholder="Country Name" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="file" name="countries[0][flag]" class="form-control form-control-lg country-flag" accept="image/*" required>
                                        <img class="img-fluid rounded mt-1 flag-preview" style="display: none; max-height: 60px;">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-danger remove-country w-100">&times;</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="add-country" class="btn btn-outline-primary btn-sm mt-2">Add Country</button>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('travels.index') }}" class="btn btn-secondary btn-lg">Back</a>
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
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
document.addEventListener('DOMContentLoaded', function() {
    let countryIndex = 1;

    // Add Country
    document.getElementById('add-country').addEventListener('click', function() {
        const wrapper = document.getElementById('countries-wrapper');
        const countryItem = document.createElement('div');
        countryItem.classList.add('row', 'g-2', 'align-items-center', 'country-item', 'mb-2');
        countryItem.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="countries[${countryIndex}][name]" class="form-control form-control-lg" placeholder="Country Name" required>
            </div>
            <div class="col-md-5">
                <input type="file" name="countries[${countryIndex}][flag]" class="form-control form-control-lg country-flag" accept="image/*" required>
                <img class="img-fluid rounded mt-1 flag-preview" style="display: none; max-height: 60px;">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-danger remove-country w-100">&times;</button>
            </div>
        `;
        wrapper.appendChild(countryItem);
        countryIndex++;
    });

    // Remove Country
    document.getElementById('countries-wrapper').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-country')) {
            e.target.closest('.country-item').remove();
        }
    });

    // Map Image Preview
    document.getElementById('map_image').addEventListener('change', function(e) {
        const preview = document.getElementById('map_preview');
        if (e.target.files && e.target.files[0]) {
            preview.src = URL.createObjectURL(e.target.files[0]);
            preview.style.display = 'block';
        }
    });

    // Country Flag Preview
    document.getElementById('countries-wrapper').addEventListener('change', function(e) {
        if (e.target.classList.contains('country-flag')) {
            const file = e.target.files[0];
            const img = e.target.closest('.col-md-5').querySelector('.flag-preview');
            if (file) {
                img.src = URL.createObjectURL(file);
                img.style.display = 'block';
            }
        }
    });
});
</script>
@endpush
