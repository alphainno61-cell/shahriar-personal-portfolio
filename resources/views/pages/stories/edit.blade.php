@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Edit Story</h2>

    <div class="card shadow-sm rounded-4 p-4">
        <form action="{{ route('stories.update', $story->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $story->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $story->subtitle) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $story->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Story Image</label><br>
                @if($story->image_path)
                    <img src="{{ asset('storage/'.$story->image_path) }}" width="120" class="rounded mb-2">
                @endif
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Order</label>
                <input type="number" name="order_no" class="form-control" value="{{ old('order_no', $story->order_no) }}">
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $story->is_active ? 'checked' : '' }}>
                <label class="form-check-label">Active</label>
            </div>

            <button type="submit" class="btn btn-primary px-4">Update Story</button>
            <a href="{{ route('stories.index') }}" class="btn btn-danger px-4">Cancel</a>
        </form>
    </div>
</div>
@endsection
