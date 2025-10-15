@extends('layouts.app')

@section('title', 'Shahriar\'s Portfolio')

@section('styles')
    <style>
        .preview-image {
            max-width: 100%;
            height: auto;
            margin-top: 15px;
            border-radius: 5px;
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="card shadow-sm mt-2 col-12 col-md-8 col-lg-6 mx-md-auto">
        <div class="card-header text-sm">
            <h5 class="mb-0">Upload Image For Main Page</h5>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="imageInput" class="form-label">Select Image</label>
                    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*" required>
                </div>
                <div class="mb-3">
                    
                </div>
                <button type="submit" class="btn btn-primary w-100">Upload Image</button>
            </form>

        </div>
    </div>
@endsection