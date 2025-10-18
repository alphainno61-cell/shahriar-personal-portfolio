@extends('layouts.app')

@section('title', 'Book Banner Details')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                
                <!-- Banner Image -->
                @if($bookBanner->hasMedia('book_banner_image'))
                    <img src="{{ $bookBanner->getFirstMediaUrl('book_banner_image') }}"
                         alt="{{ $bookBanner->title }}"
                         class="img-fluid w-100"
                         style="height: 300px; object-fit: cover;">
                @else
                    <div class="bg-light text-center py-5 text-muted">
                        <i class="bi bi-image fs-1"></i>
                        <p class="mt-2 mb-0">No Image Uploaded</p>
                    </div>
                @endif

                <div class="card-body p-4">
                    <!-- Title -->
                    <h2 class="fw-bold mb-3 text-primary">{{ $bookBanner->title }}</h2>

                    <!-- Description -->
                    @if($bookBanner->description)
                        <p class="text-secondary mb-4">{{ $bookBanner->description }}</p>
                    @else
                        <p class="text-muted fst-italic">No description available.</p>
                    @endif

                    <!-- Price -->
                    @if($bookBanner->price)
                        <h5 class="text-success fw-semibold mb-4">
                            <i class="bi bi-cash-stack me-2"></i>Price: {{ $bookBanner->price }}
                        </h5>
                    @endif

                    <!-- Actions -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('book-banners.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                        <div>
                            <a href="{{ route('book-banners.edit', $bookBanner->id) }}" class="btn btn-primary rounded-pill px-4 me-2">
                                <i class="bi bi-pencil-square me-2"></i>Edit
                            </a>
                            <form action="{{ route('book-banners.destroy', $bookBanner->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-pill px-4"
                                        onclick="return confirm('Are you sure you want to delete this banner?');">
                                    <i class="bi bi-trash3 me-2"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light text-muted text-center py-3">
                    <small>Created at: {{ $bookBanner->created_at->format('M d, Y') }} |
                    Last updated: {{ $bookBanner->updated_at->format('M d, Y') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
