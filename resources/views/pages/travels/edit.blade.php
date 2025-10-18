@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Edit Travel Country</h2>

    <form action="{{ route('travels.update', $travel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Country Name</label>
            <input type="text" name="country_name" class="form-control" value="{{ $travel->country_name }}" required>
        </div>

        <div class="mb-3">
            <label>Country Flag</label>
            @if($travel->country_flag_path)
                <img src="{{ asset('storage/'.$travel->country_flag_path) }}" width="50" class="rounded mb-2">
            @endif
            <input type="file" name="country_flag_path" class="form-control">
        </div>

        <div class="mb-3">
            <label>Map Image</label>
            @if($travel->map_image_path)
                <img src="{{ asset('storage/'.$travel->map_image_path) }}" width="70" class="rounded mb-2">
            @endif
            <input type="file" name="map_image_path" class="form-control">
        </div>

        <div class="mb-3">
            <label>Order No</label>
            <input type="number" name="order_no" class="form-control" value="{{ $travel->order_no }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" {{ $travel->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Update Country</button>
        <a href="{{ route('travels.index') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection
