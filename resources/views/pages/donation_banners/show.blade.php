@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Donation Banner Details</h4>
        <a href="{{ route('donation-banners.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left-circle me-1"></i> Back to List
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 text-center">
                    <label class="form-label fw-bold">Image</label><br>
                    @if($banner->image_path)
                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner" class="rounded" width="250" height="150" style="object-fit: cover;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="mb-2">
                        <span class="fw-bold">Section Title:</span>
                        <span>{{ $banner->section_title ?? '—' }}</span>
                    </div>

                    <div class="mb-2">
                        <span class="fw-bold">Main Quote:</span>
                        <p class="mb-0">{{ $banner->main_quote }}</p>
                    </div>

                    <div class="mb-2">
                        <span class="fw-bold">Button Text:</span>
                        <span>{{ $banner->button_text ?? '—' }}</span>
                    </div>

                    <div class="mb-2">
                        <span class="fw-bold">Button Link:</span>
                        <span>{{ $banner->button_link ?? '—' }}</span>
                    </div>

                    <div class="mb-2">
                        <span class="fw-bold">Status:</span>
                        @if($banner->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('donation-banners.edit', $banner->id) }}" class="btn btn-success">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                        <form action="{{ route('donation-banners.destroy', $banner->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this banner?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
