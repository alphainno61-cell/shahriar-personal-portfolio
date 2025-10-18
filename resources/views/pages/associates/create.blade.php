@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Add New Associate</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('associates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Background Image</label>
            <input type="file" name="background_image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Partner Images (multiple)</label>
            <input type="file" name="partner_images[]" class="form-control" multiple>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" checked>
            <label class="form-check-label">Active</label>
        </div>

        <div class="mb-3">
            <label class="form-label">Order</label>
            <input type="number" name="order_no" class="form-control" value="0">
        </div>

        <button type="submit" class="btn btn-primary">Add Associate</button>
    </form>
</div>
@endsection
