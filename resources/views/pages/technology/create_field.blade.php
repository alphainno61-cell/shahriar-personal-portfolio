@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Add Technology Field</h1>

    <form action="{{ route('technology.storeField') }}" method="POST" enctype="multipart/form-data">
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
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Main Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Frame Image</label>
            <input type="file" name="frame_image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tools Title</label>
            <input type="text" name="tools_title" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tools Description</label>
            <textarea name="tools_description" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('technology.index') }}" class="btn btn-danger">Back</a>
    </form>
</div>
@endsection
