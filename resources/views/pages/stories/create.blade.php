@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Add New Story</h2>

    <div class="card shadow-sm rounded-4 p-4">
        <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Story Title" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" placeholder="Short subtitle (optional)">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Story description..."></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Story Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Order</label>
                <input type="number" name="order_no" class="form-control" value="1">
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                <label class="form-check-label">Active</label>
            </div>

            <button type="submit" class="btn btn-success px-4">Save Story</button>
            <a href="{{ route('stories.index') }}" class="btn btn-danger px-4">Cancel</a>
        </form>
    </div>
</div>
@endsection
