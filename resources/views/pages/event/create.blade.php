@extends('layouts.app')

@section('title', 'Create New Event')

@section('content')
<div class="pt-2">
    <div class="d-flex justify-content-center">
        <div class="card shadow-lg border-0 rounded-4" style="width: 80%;">
            
            <!-- Header -->
            <div class="card-header text-white rounded-top-4 d-flex justify-content-between align-items-center"
                 style="background: linear-gradient(90deg, #6366f1, #8b5cf6);">
                <h4 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Create New Event</h4>
                <a href="{{ route('events.index') }}" class="btn btn-light btn-sm rounded-pill ms-auto">
                    <i class="bi bi-arrow-left me-1"></i>Back
                </a>
            </div>

            <!-- Body -->
            <div class="card-body p-4">

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Event Title -->
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">Event Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title"
                               class="form-control rounded-3 @error('title') is-invalid @enderror"
                               placeholder="Enter event title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Event Description -->
                    <div class="mb-4">
                        <label for="content" class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" rows="5"
                                  class="form-control rounded-3 @error('content') is-invalid @enderror"
                                  placeholder="Write event details here..." required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Event Date -->
                    <div class="mb-4">
                        <label for="event_date" class="form-label fw-semibold">Event Date <span class="text-danger">*</span></label>
                        <input type="date" name="event_date" id="event_date"
                               class="form-control rounded-3 @error('event_date') is-invalid @enderror"
                               value="{{ old('event_date') }}" required>
                        @error('event_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Event Place -->
                    <div class="mb-4">
                        <label for="event_place" class="form-label fw-semibold">Event Place <span class="text-danger">*</span></label>
                        <input type="text" name="event_place" id="event_place"
                               class="form-control rounded-3 @error('event_place') is-invalid @enderror"
                               placeholder="Enter event location" value="{{ old('event_place') }}" required>
                        @error('event_place')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Upload Event Image</label>
                        <div id="drop-area" class="text-center border border-2 border-dashed rounded-3 p-4 bg-light"
                             style="cursor: pointer;" onclick="document.getElementById('image').click()">
                            <input type="file" name="image" id="image" accept="image/*"
                                   class="form-control d-none @error('image') is-invalid @enderror"
                                   onchange="previewImage(event)">
                            <img id="preview" src="https://via.placeholder.com/400x250?text=Event+Preview"
                                 alt="Preview" class="img-fluid rounded-3 shadow-sm" style="max-height: 220px;">
                            <p class="text-muted mt-2 mb-0">Click or drag to upload an image</p>
                        </div>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('events.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                        <button type="submit" class="btn btn-success rounded-pill px-4 py-2">
                            <i class="bi bi-save me-2"></i>Create Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image preview
    function previewImage(event) {
        const output = document.getElementById('preview');
        const file = event.target.files[0];
        if (file) {
            output.src = URL.createObjectURL(file);
        }
    }

    // Drag & drop highlight
    const dropArea = document.getElementById('drop-area');
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('border-primary');
    });
    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('border-primary');
    });
    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('border-primary');
        document.getElementById('image').files = e.dataTransfer.files;
        previewImage({ target: document.getElementById('image') });
    });
</script>
@endpush
