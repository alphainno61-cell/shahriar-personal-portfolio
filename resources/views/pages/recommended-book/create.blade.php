@extends('layouts.app')

@section('title', 'Add Recommended Books')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">
                        <i class="bi bi-book-half me-2"></i>Add Recommended Books
                    </h4>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('recommended-books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Multiple Image Upload -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Upload Book Images <span class="text-danger">*</span></label>
                            <input type="file" name="images[]" class="form-control rounded-3" multiple required
                                   accept="image/png,image/jpeg,image/webp">
                            <small class="text-muted d-block mt-2">You can upload multiple images at once.</small>

                            <!-- Preview Section -->
                            <div id="image-preview" class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('recommended-books.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-success rounded-pill px-4">
                                <i class="bi bi-check2-circle me-2"></i>Save Books
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
<!-- Image Preview Script -->
<script>
document.querySelector('input[name="images[]"]').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.createElement('img');
            img.src = event.target.result;
            img.classList.add('rounded-3', 'shadow-sm');
            img.style.width = '120px';
            img.style.height = '120px';
            img.style.objectFit = 'cover';
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    });
});
</script>
@endpush
