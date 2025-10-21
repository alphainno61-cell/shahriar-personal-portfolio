@extends('layouts.app')

@push('styles')
<style>
    .upload-container {
        background: #f8f9fa;
        min-height: 100vh;
        padding: 60px 0;
    }

    .upload-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border: none;
    }

    .card-header-custom h2 {
        margin: 0;
        font-weight: 600;
        font-size: 28px;
    }

    .card-header-custom p {
        margin: 8px 0 0 0;
        opacity: 0.95;
        font-size: 15px;
    }

    .upload-area {
        border: 3px dashed #d1d5db;
        border-radius: 15px;
        padding: 60px 20px;
        text-align: center;
        background: #f9fafb;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .upload-area:hover {
        border-color: #667eea;
        background: #f3f4ff;
    }

    .upload-area.dragover {
        border-color: #667eea;
        background: #e8eaff;
        transform: scale(1.02);
    }

    .upload-icon {
        font-size: 64px;
        color: #667eea;
        margin-bottom: 20px;
    }

    .upload-area h4 {
        color: #1f2937;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .upload-area p {
        color: #6b7280;
        margin-bottom: 20px;
    }

    .btn-browse {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-browse:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .preview-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .preview-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .preview-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .preview-item img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .preview-item:hover .preview-overlay {
        opacity: 1;
    }

    .btn-remove {
        background: #ef4444;
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-remove:hover {
        background: #dc2626;
        transform: scale(1.1);
    }

    .file-name {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px;
        font-size: 12px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel {
        background: #e5e7eb;
        color: #374151;
        border: none;
        padding: 14px 40px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #d1d5db;
        color: #1f2937;
    }

    .image-count {
        display: inline-block;
        background: #10b981;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .upload-container {
            padding: 30px 0;
        }

        .card-header-custom {
            padding: 20px;
        }

        .card-header-custom h2 {
            font-size: 22px;
        }

        .upload-area {
            padding: 40px 15px;
        }

        .preview-container {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 15px;
        }

        .preview-item img {
            height: 140px;
        }
    }
</style>
@endpush

@section('content')
<div class="upload-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="upload-card">
                    <div class="card-header-custom">
                        <h2><i class="fas fa-images me-2"></i>Upload Image Gallery</h2>
                        <p>Select multiple images to create a beautiful gallery</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-exclamation-circle me-2"></i>Oops!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('image-galleries.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf

                            {{-- <div class="mb-4">
                                <label for="title" class="form-label fw-bold">
                                    <i class="fas fa-heading me-2"></i>Gallery Title (Optional)
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="title" 
                                       name="title" 
                                       placeholder="Enter a title for this gallery"
                                       value="{{ old('title') }}">
                            </div> --}}

                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-cloud-upload-alt me-2"></i>Upload Images
                                </label>
                                
                                <div class="upload-area" id="uploadArea">
                                    <div class="upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <h4>Drag & Drop Images Here</h4>
                                    <p class="text-muted">or</p>
                                    <button type="button" class="btn btn-browse" onclick="document.getElementById('fileInput').click()">
                                        <i class="fas fa-folder-open me-2"></i>Browse Files
                                    </button>
                                    <p class="text-muted mt-3 mb-0">
                                        <small>Supported formats: JPG, PNG, GIF, WebP (Max 5MB each)</small>
                                    </p>
                                </div>

                                <input type="file" 
                                       id="fileInput" 
                                       name="images[]" 
                                       multiple 
                                       accept="image/*" 
                                       style="display: none;">
                            </div>

                            <div id="previewSection" style="display: none;">
                                <div class="image-count">
                                    <i class="fas fa-image me-2"></i>
                                    <span id="imageCount">0</span> image(s) selected
                                </div>
                                <div class="preview-container" id="previewContainer"></div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                <a href="{{ route('image-galleries.index') }}" class="btn btn-cancel">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-submit" id="submitBtn" disabled>
                                    <i class="fas fa-check me-2"></i>Upload Gallery
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');
    const previewSection = document.getElementById('previewSection');
    const imageCount = document.getElementById('imageCount');
    const submitBtn = document.getElementById('submitBtn');
    let selectedFiles = [];

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop area when dragging over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.add('dragover');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.remove('dragover');
        }, false);
    });

    // Handle dropped files
    uploadArea.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    });

    // Handle selected files from input
    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        const newFiles = [...files].filter(file => file.type.startsWith('image/'));
        
        if (newFiles.length === 0) {
            alert('Please select valid image files!');
            return;
        }

        selectedFiles = [...selectedFiles, ...newFiles];
        updateFileInput();
        displayPreviews();
    }

    function updateFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => {
            dt.items.add(file);
        });
        fileInput.files = dt.files;
    }

    function displayPreviews() {
        previewContainer.innerHTML = '';
        
        if (selectedFiles.length === 0) {
            previewSection.style.display = 'none';
            submitBtn.disabled = true;
            return;
        }

        previewSection.style.display = 'block';
        submitBtn.disabled = false;
        imageCount.textContent = selectedFiles.length;

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            
            reader.onload = (e) => {
                const previewItem = document.createElement('div');
                previewItem.className = 'preview-item';
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}">
                    <div class="preview-overlay">
                        <button type="button" class="btn-remove" onclick="removeFile(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="file-name">${file.name}</div>
                `;
                previewContainer.appendChild(previewItem);
            };
            
            reader.readAsDataURL(file);
        });
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        updateFileInput();
        displayPreviews();
    }

    // Form validation
    document.getElementById('uploadForm').addEventListener('submit', (e) => {
        if (selectedFiles.length === 0) {
            e.preventDefault();
            alert('Please select at least one image!');
        }
    });
</script>
@endpush