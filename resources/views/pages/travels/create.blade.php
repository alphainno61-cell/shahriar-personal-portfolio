@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Add New Travel Country</h2>

    <form action="{{ route('travels.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Country Name</label>
            <input type="text" name="country_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Country Flag</label>
            <input type="file" name="country_flag_path" class="form-control">
        </div>

        <div class="mb-3">
            <label>Map Image</label>
            <input type="file" name="map_image_path" class="form-control">
        </div>

        <div class="mb-3">
            <label>Order No</label>
            <input type="number" name="order_no" class="form-control" value="1">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Save Country</button>
        <a href="{{ route('travels.index') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection
