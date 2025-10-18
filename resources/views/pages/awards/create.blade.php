@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Add New Award</h2>

    <div class="card shadow-sm rounded-4 p-4">
        <form action="{{ route('awards.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Time Period</label>
                <input type="text" name="time_period" class="form-control" placeholder="e.g. Jan, 2016 to Jan, 2021" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Award Title" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Award description..."></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Award Image</label>
                <input type="file" name="image_path" class="form-control">
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                <label class="form-check-label">Active</label>
            </div>

            <button type="submit" class="btn btn-success px-4">Save Award</button>
            <a href="{{ route('awards.index') }}" class="btn btn-danger px-4">Cancel</a>
        </form>
    </div>
</div>
@endsection
