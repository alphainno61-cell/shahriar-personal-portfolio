
@extends('layouts.app')

@section('title', 'Shahriar\'s Portfolio')

@push('styles')
<style>
    :root {
        --bs-primary: #4f46e5; /* Custom primary color */
    }
    body {
        background-color: #f7f9fc;
    }
    /* Custom file input styling for drag-and-drop appearance */
    .file-input-container {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px dashed #d1d5db;
        border-radius: 0.5rem;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.2s ease-in-out;
    }
    .file-input-container:hover {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    .file-input-container input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }
    .image-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 5;
    }
    /* Specific dimensions for the main image slot */
    .main-image-slot {
        height: 500px; 
    }
    /* Reduced height for mobile/tablet (below 992px) */
    @media (max-width: 991.98px) {
        .main-image-slot {
            height: 300px;
        }
    }
    /* Specific dimensions for the small image slots */
    .side-image-slot {
        height: 120px;
    }
</style>
@endpush

@section('content')
    <div class="mt-2 mx-auto bg-white p-4 p-md-5 rounded-3 shadow-lg">
        <p class="h5 fw-bold text-dark text-center mb-4 border-bottom pb-2">Landing Page Image Upload</p>
        
        <form method="POST" enctype="multipart/form-data" action="{{ route('home.landing') }}">
            @csrf
            <!-- URL Input Box (Always Visible) -->
            <div class="mb-4">
                <label for="url_input" class="form-label text-muted">Redirect URL<span class="text-danger text-sm">*</span></label>
                <input type="text" id="url_input" name="url" placeholder="https://shahriar.com/home"
                       class="form-control" aria-describedby="urlHelp" required>
            </div>

            <!-- Main Responsive Grid Container -->
            <div class="row g-4">

                <!-- 2. Main Image: Center Column on Desktop, First block on Mobile -->
                <!-- Uses col-lg-6 for center column width and order-1 for mobile positioning -->
                <div id="main-image-group" class="col-12 col-lg-6 order-lg-2 order-1">
                    <p class="h5 fw-semibold text-secondary mb-3">Main Image</p>
                    <div class="file-input-container main-image-slot bg-light border-primary">
                        <img id="preview_main_image" class="image-preview d-none" src="" alt="Main Image Preview">
                        <div class="text-center text-muted p-3" id="label_main_image">
                            <!-- Icon from Bootstrap Icons or custom SVG -->
                            <svg class="mx-auto" style="height: 3rem; width: 3rem; color: var(--bs-primary);" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-1 small">Click or drag image here (Input: main_image)</p>
                        </div>
                        <input type="file" name="main_image" id="main_image" accept="image/*" onchange="previewImage(this, 'preview_main_image', 'label_main_image')">
                    </div>
                </div>

                <!-- 1. Side Images (1-5): Left Column on Desktop, Second block on Mobile -->
                <!-- Uses col-lg-3 for side column width and order-2 for mobile positioning -->
                <div id="side-images-left" class="col-12 col-lg-3 order-lg-1 order-2">
                    <h2 class="h6 fw-semibold text-secondary border-bottom pb-1 mb-3">Left Side Images</h2>
                    <!-- Side image slots will be generated here by JavaScript -->
                </div>

                <!-- 3. Side Images (6-10): Right Column on Desktop, Third block on Mobile -->
                <!-- Uses col-lg-3 for side column width and order-3 for mobile positioning -->
                <div id="side-images-right" class="col-12 col-lg-3 order-lg-3 order-3">
                    <h2 class="h6 fw-semibold text-secondary border-bottom pb-1 mb-3">Right Side Images</h2>
                    <!-- Side image slots will be generated here by JavaScript -->
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-top mt-4">
                <button type="submit" class="btn btn-primary w-100 w-lg-auto py-2 px-4 shadow-sm">
                    Upload & Save Images
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    const imageGroupLeft = document.getElementById('side-images-left');
    const imageGroupRight = document.getElementById('side-images-right');

    // Function to create an individual image uploader slot
    function createUploaderSlot(index) {
        const inputName = `image${index}`;
        const labelId = `label_${inputName}`;
        const previewId = `preview_${inputName}`;

        // We use mb-3 for margin-bottom on mobile to separate slots
        const html = `
            <div class="mb-3">
                <div class="file-input-container side-image-slot bg-light">
                    <img id="${previewId}" class="image-preview d-none" src="" alt="Image ${index} Preview">
                    <div class="text-center text-muted small p-2" id="${labelId}">
                        <svg class="mx-auto" style="height: 1.5rem; width: 1.5rem; color: #6c757d;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="mt-1">Slot ${index}</p>
                    </div>
                    <input type="file" name="${inputName}" id="${inputName}" accept="image/*" onchange="previewImage(this, '${previewId}', '${labelId}')">
                </div>
            </div>
        `;
        return html;
    }

    // Loop to generate 10 side image slots, split into two groups
    for (let i = 1; i <= 10; i++) {
        const slot = createUploaderSlot(i);
        if (i <= 5) {
            imageGroupLeft.insertAdjacentHTML('beforeend', slot);
        } else {
            imageGroupRight.insertAdjacentHTML('beforeend', slot);
        }
    }

    /**
     * Handles the live preview for image inputs.
     * @param {HTMLInputElement} input The file input element.
     * @param {string} previewId The ID of the <img> element for preview.
     * @param {string} labelId The ID of the text label/icon element to hide.
     */
    function previewImage(input, previewId, labelId) {
        const preview = document.getElementById(previewId);
        const label = document.getElementById(labelId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                // Use Bootstrap's d-block to show and d-none to hide
                preview.classList.remove('d-none');
                label.classList.add('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "";
            preview.classList.add('d-none');
            label.classList.remove('d-none');
        }
    }
</script>
@endpush