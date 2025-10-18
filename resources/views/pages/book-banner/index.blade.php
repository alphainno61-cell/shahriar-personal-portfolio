@extends('layouts.app')

@section('title', 'Book Banners')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary mb-0">
            <i class="bi bi-bookmark-star-fill me-2"></i>Book Banners
        </h3>
        <a href="{{ route('book-banners.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
            <i class="bi bi-plus-lg me-2"></i>Add New
        </a>
    </div>

    @if($bookBanners->count() > 0)
        <div class="table-responsive shadow-sm rounded-4">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookBanners as $index => $banner)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                @if($banner->hasMedia('book_banner_image'))
                                    <img src="{{ $banner->getFirstMediaUrl('book_banner_image') }}"
                                         alt="{{ $banner->title }}"
                                         class="img-thumbnail shadow-sm"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/80x80?text=No+Image"
                                         class="img-thumbnail shadow-sm"
                                         alt="No Image">
                                @endif
                            </td>

                            <td class="fw-semibold">{{ $banner->title }}</td>

                            <td class="text-muted text-truncate" style="max-width: 250px;">
                                {{ $banner->description ?? '—' }}
                            </td>

                            <td>
                                @if($banner->price)
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <i class="bi bi-currency-dollar me-1"></i>{{ $banner->price }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('book-banners.show', $banner->id) }}" class="btn btn-sm btn-info text-white rounded-pill me-1">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('book-banners.edit', $banner->id) }}" class="btn btn-sm btn-warning text-white rounded-pill me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('book-banners.destroy', $banner->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $bookBanners->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076505.png" width="120" class="mb-3 opacity-75" alt="No Data">
            <h5 class="text-muted">No Book Banners Found</h5>
        </div>
    @endif
</div>
@endsection
