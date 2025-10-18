@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Story Details</h2>

    <div class="card shadow-sm rounded-4 p-4">
        <div class="row">
            <div class="col-md-4 text-center">
                @if($story->image_path)
                    <img src="{{ asset('storage/'.$story->image_path) }}" alt="Story Image" class="img-fluid rounded shadow-sm">
                @else
                    <div class="text-muted fst-italic">No Image Available</div>
                @endif
            </div>

            <div class="col-md-8">
                <h4 class="fw-semibold">{{ $story->title }}</h4>
                <p class="text-secondary mb-2">{{ $story->subtitle }}</p>
                <p>{{ $story->description }}</p>
                <p>
                    Status:
                    @if($story->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </p>
                <p>Order: {{ $story->order_no }}</p>

                <div class="mt-4">
                    <a href="{{ route('stories.edit', $story->id) }}" class="btn btn-success me-2">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="{{ route('stories.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
