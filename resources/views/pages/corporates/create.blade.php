@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Add Corporate Step</h2>

    <form action="{{ route('corporates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Step Number</label>
            <input type="number" name="step_number" class="form-control" value="{{ old('step_number') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Company Name</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Position / Years</label>
            <input type="text" name="position_years" class="form-control" value="{{ old('position_years') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image_path" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="is_active" checked>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-primary">Add Step</button>
    </form>
</div>
@endsection
