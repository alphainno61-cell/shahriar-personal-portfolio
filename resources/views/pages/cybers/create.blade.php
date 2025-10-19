@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Add Cyber Security Section</h1>

    <form action="{{ route('cybers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control">
        </div>

        <div class="mb-3">
            <label>Short Description</label>
            <textarea name="short_description" class="form-control" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label>Long Description</label>
            <textarea name="long_description" class="form-control" rows="5"></textarea>
        </div>

        <div class="mb-3">
            <label>Main Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Frame Image</label>
            <input type="file" name="frame_image" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('cybers.index') }}" class="btn btn-danger">Back</a>
    </form>
</div>
@endsection
