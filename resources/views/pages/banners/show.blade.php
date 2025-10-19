@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('banners.index') }}" class="btn btn-primary">← Back</a>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">{{ $banner->title }}</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h5 class="text-muted">Subtitle:</h5>
                <p>{{ $banner->subtitle ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <h5 class="text-muted">Image:</h5>
                @if($banner->image_path)
                    <img src="{{ asset('storage/'.$banner->image_path) }}" alt="Banner Image" class="rounded w-100" style="max-height: 400px; object-fit: cover;">
                @else
                    <p class="text-muted">No image available</p>
                @endif
            </div>

            <div class="mb-3">
                <h5 class="text-muted">Video:</h5>
                @if($banner->video_url)
                    <div class="ratio ratio-16x9">
                        <iframe 
                            src="{{ $banner->video_url }}" 
                            title="Banner Video"
                            allowfullscreen
                            class="rounded">
                        </iframe>
                    </div>
                @else
                    <p class="text-muted">No video available</p>
                @endif
            </div>

            <div class="mb-3">
                <h5 class="text-muted">Status:</h5>
                @if($banner->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </div>

            <div class="mt-4">
                <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-success">Edit</a>
                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure you want to delete this banner?')" class="btn btn-danger">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
