@extends('layouts.app')

@section('content')
<div class="pt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8" style="max-width: 80%;">

            <div class="card shadow-lg border-0 rounded-4 mx-auto">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">Edit Innovation</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('innovations.update', $innovation->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Title</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="form-control @error('title') is-invalid @enderror" 
                                value="{{ old('title', $innovation->title) }}" 
                                placeholder="Enter title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">Content</label>
                            <textarea 
                                name="content" 
                                id="content" 
                                class="form-control @error('content') is-invalid @enderror" 
                                rows="5" 
                                placeholder="Enter content">{{ old('content', $innovation->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Images -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Current Images</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($innovation->getMedia('innovation_images') as $image)
                                    <div class="position-relative">
                                        <img src="{{ $image->getFullUrl() }}" 
                                             class="img-thumbnail rounded" 
                                             style="height:120px; object-fit:cover;">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-existing-image" data-id="{{ $image->id }}">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                @endforeach
                                @if($innovation->getMedia('innovation_images')->isEmpty())
                                    <p class="text-muted fst-italic">No images uploaded</p>
                                @endif
                            </div>
                        </div>

                        <!-- Upload New Images -->
                        <div class="mb-3">
                            <label for="images" class="form-label fw-semibold">Upload New Images</label>
                            <input 
                                type="file" 
                                name="images[]" 
                                id="images" 
                                class="form-control @error('images') is-invalid @enderror" 
                                multiple 
                                accept="image/*">
                            <small class="text-muted">You can upload multiple images. New images will replace old ones if you choose to remove them.</small>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preview -->
                        <div class="mb-3 d-flex flex-wrap" id="preview-container"></div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-3">
                                <i class="bi bi-save me-1"></i> Update Innovation
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Image Preview Script --}}
<script>
    const imagesInput = document.getElementById('images');
    const previewContainer = document.getElementById('preview-container');

    imagesInput.addEventListener('change', function() {
        previewContainer.innerHTML = ''; // Clear previous previews
        Array.from(this.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'me-2', 'mb-2');
                img.style.maxHeight = '150px';
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });

    // Optional: handle remove existing image button (AJAX delete)
    document.querySelectorAll('.remove-existing-image').forEach(button => {
        button.addEventListener('click', function() {
            const imageId = this.dataset.id;
            if(confirm('Are you sure you want to remove this image?')) {
                fetch(`/innovations/remove-image/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(res => res.json())
                  .then(data => {
                      if(data.success){
                          this.parentElement.remove();
                      } else {
                          alert('Failed to remove image.');
                      }
                  });
            }
        });
    });
</script>
@endpush
