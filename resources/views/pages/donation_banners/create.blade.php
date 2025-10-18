@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-4 fw-bold">Add Donation Banner</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <form action="{{ route('donation-banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Section Title</label>
                    <input type="text" name="section_title" class="form-control" value="{{ old('section_title') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Main Quote <span class="text-danger">*</span></label>
                    <textarea name="main_quote" class="form-control" rows="3" required>{{ old('main_quote') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image_path" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="{{ old('button_text') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Button Link</label>
                    <input type="text" name="button_link" class="form-control" value="{{ old('button_link') }}">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
                    <label class="form-check-label">Active</label>
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Save</button>
                <a href="{{ route('donation-banners.index') }}" class="btn btn-danger ms-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
