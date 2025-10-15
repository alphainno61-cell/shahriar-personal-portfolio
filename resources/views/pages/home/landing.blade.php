@extends('layouts.app')

<<<<<<< HEAD
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
=======
@section('styles')
<style>
    .image-input {
      margin-bottom: 10px;
    }
    .main-uploader {
      display: flex;
      flex-direction: column;
      justify-content: center;
      height: 100%;
    }
  </style>
@endsection

@section('content')
    <div class="mt-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Upload Images For Landing Page</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('home.landing') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <!-- Center Column (Main Image Uploader) -->
                        <div class="col-12 col-md-4 d-flex flex-column order-1 order-md-2">
                            <label class="form-label">Main Image<span class="text-danger">*</span></label>
                            <input type="file" name="main_image" class="form-control mb-2" accept="image/*" style="max-width: 300px;" required>
                            @error('main_image')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                
                        <!-- Left Column -->
                        <div class="col-12 col-md-4 order-2 order-md-1">
                            <div class="d-flex flex-column">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="image-input mb-3">
                                        <label class="form-label">Image {{ $i }}</label>
                                        <input type="file" name="image{{ $i }}" class="form-control" accept="image/*">
                                        @error('image' . $i)
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endfor
                            </div>
                        </div>
                
                        <!-- Right Column -->
                        <div class="col-12 col-md-4 order-3">
                            <div class="d-flex flex-column">
                                @for ($i = 6; $i <= 10; $i++)
                                    <div class="image-input mb-3">
                                        <label class="form-label">Image {{ $i }}</label>
                                        <input type="file" name="image{{ $i }}" class="form-control" accept="image/*">
                                        @error('image' . $i)
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                
                    <!-- Bottom Text Input -->
                    <div class="row mt-4">
                        <div class="col-12 col-md-6 w-100">
                            <div class="input-group">
                                <label class="input-group-text" for="textInput">Redirect URL</label>
                                <input type="text" class="form-control" id="textInput" name="url" placeholder="https://dummyweb.com" required>
                            </div>
                            @error('url')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                
                    <!-- Centered Upload Button -->
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary px-5 py-2">Upload</button>
                        </div>
                    </div>
                </form>                
            </div>
>>>>>>> master
        </div>
    </div>
@endsection