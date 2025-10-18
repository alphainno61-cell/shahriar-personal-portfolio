@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-4 fw-bold">Edit Donation Banner</h4>

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
            <form action="{{ route('donation-banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Section Title</label>
                    <input type="text" name="section_title" class="form-control" value="{{ old('section_title', $banner->section_title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Main Quote <span class="text-danger">*</span></label>
                    <textarea name="main_quote" class="form-control" rows="3" required>{{ old('main_quote', $banner->main_quote) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    @if($banner->image_path)
                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner" class="rounded mb-2" width="120" height="80" style="object-fit: cover;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Change Image</label>
                    <input type="file" name="image_path" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $banner->button_text) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Button Link</label>
                    <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $banner->button_link) }}">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $banner->is_active ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update</button>
                <a href="{{ route('donation-banners.index') }}" class="btn btn-danger ms-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
