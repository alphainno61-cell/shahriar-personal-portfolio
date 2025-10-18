@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Edit Award</h2>

    <div class="card shadow-sm rounded-4 p-4">
        <form action="{{ route('awards.update', $award->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Time Period</label>
                <input type="text" name="time_period" class="form-control" value="{{ old('time_period', $award->time_period) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $award->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $award->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Award Image</label><br>
                @if($award->image_path)
                    <img src="{{ asset('storage/'.$award->image_path) }}" width="120" class="rounded mb-2">
                @endif
                <input type="file" name="image_path" class="form-control">
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $award->is_active ? 'checked' : '' }}>
                <label class="form-check-label">Active</label>
            </div>

            <button type="submit" class="btn btn-success px-4">Update Award</button>
            <a href="{{ route('awards.index') }}" class="btn btn-danger px-4">Cancel</a>
        </form>
    </div>
</div>
@endsection
