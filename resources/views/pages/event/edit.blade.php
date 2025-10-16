@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-warning text-dark text-center py-3 rounded-top-4">
                    <h3 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Event</h3>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Event Title</label>
                            <input type="text" name="title" id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $event->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">Event Description</label>
                            <textarea name="content" id="content" rows="5"
                                      class="form-control @error('content') is-invalid @enderror"
                                      required>{{ old('content', $event->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Date -->
                        <div class="mb-3">
                            <label for="event_date" class="form-label fw-semibold">Event Date</label>
                            <input type="date" name="event_date" id="event_date"
                                   class="form-control @error('event_date') is-invalid @enderror"
                                   value="{{ old('event_date', $event->event_date) }}" required>
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Place -->
                        <div class="mb-3">
                            <label for="event_place" class="form-label fw-semibold">Event Place</label>
                            <input type="text" name="event_place" id="event_place"
                                   class="form-control @error('event_place') is-invalid @enderror"
                                   value="{{ old('event_place', $event->event_place) }}" required>
                            @error('event_place')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Image -->
                        <div class="mb-4 text-center">
                            <label class="form-label fw-semibold">Current Event Image</label>
                            <div class="mb-3">
                                @if ($event->hasMedia('event_image'))
                                    <img src="{{ $event->getFirstMediaUrl('event_image') }}"
                                         alt="Current Event Image"
                                         class="img-fluid rounded shadow-sm"
                                         style="max-height: 250px;">
                                @else
                                    <img src="https://via.placeholder.com/400x250?text=No+Image"
                                         class="img-fluid rounded shadow-sm"
                                         style="max-height: 250px;">
                                @endif
                            </div>
                        </div>

                        <!-- Upload New Image -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Replace Event Image</label>
                            <input type="file" name="image" id="image"
                                   class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="mt-3 text-center">
                                <img id="preview" src="#" alt="Preview"
                                     class="img-fluid rounded shadow-sm d-none" style="max-height: 250px;">
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning px-5 py-2 rounded-pill text-white">
                                <i class="bi bi-save2 me-2"></i>Update Event
                            </button>
                            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill ms-2">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Script -->

@endsection

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function (event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endpush
