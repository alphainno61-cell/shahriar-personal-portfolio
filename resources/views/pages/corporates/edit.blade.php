@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Edit Corporate Step</h2>

    <form action="{{ route('corporates.update', $corporate->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Step Number</label>
            <input type="number" name="step_number" class="form-control" value="{{ old('step_number', $corporate->step_number) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $corporate->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Company Name</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $corporate->company_name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Position / Years</label>
            <input type="text" name="position_years" class="form-control" value="{{ old('position_years', $corporate->position_years) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($corporate->image_path)
                <img src="{{ asset('storage/'.$corporate->image_path) }}" width="150" class="mb-2">
            @else
                <span class="text-muted">No Image</span>
            @endif
            <input type="file" name="image_path" class="form-control mt-2">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $corporate->description) }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="is_active" {{ $corporate->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Update Step</button>
    </form>
</div>
@endsection
