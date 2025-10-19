@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit Banner</h2>

    <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ $banner->title }}" required>
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="{{ $banner->subtitle }}">
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            @if($banner->image_path)
                <img src="{{ asset('storage/'.$banner->image_path) }}" width="200" class="rounded mb-2">
            @else
                <p class="text-muted">No image uploaded</p>
            @endif
            <input type="file" name="image_path" class="form-control mt-2" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="#" alt="Preview" class="rounded mt-2" style="display:none; width:200px; height:auto;">
        </div>

        <div class="mb-3">
            <label>Video URL (YouTube embed link)</label>
            <input type="url" name="video_url" class="form-control" value="{{ $banner->video_url }}">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ $banner->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$banner->is_active ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Banner</button>
        <a href="{{ route('banners.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>

<script>
function previewImage(event) {
    const output = document.getElementById('preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.style.display = 'block';
}
</script>
@endsection
