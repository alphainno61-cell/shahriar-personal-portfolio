@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Add New Banner</h2>

    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image_path" class="form-control" accept="image/*" onchange="previewImage(event)">
            <div class="mt-2">
                <img id="preview" src="#" alt="Preview" class="rounded" style="display:none; width:200px; height:auto;">
            </div>
        </div>

        <div class="mb-3">
            <label>Video URL (YouTube embed link)</label>
            <input type="url" name="video_url" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="is_active" class="form-control">
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Banner</button>
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
