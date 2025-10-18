@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Entrepreneurship Banners</h4>
        <a href="{{ route('enterpreneurship-banners.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th width="5%">#</th>
                    <th width="25%">Title</th>
                    <th width="30%">Image</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $index => $banner)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $banner->title ?? '—' }}</td>
                        <td class="text-center">
                            @if($banner->getFirstMediaUrl('entrepreneurship_banner_image'))
                                <img src="{{ $banner->getFirstMediaUrl('entrepreneurship_banner_image') }}" 
                                     alt="Banner Image" 
                                     class="img-fluid rounded" 
                                     style="max-height: 100px;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('enterpreneurship-banners.edit', $banner->id) }}" 
                               class="btn btn-sm btn-warning me-2" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('enterpreneurship-banners.destroy', $banner->id) }}" 
                                  method="POST" 
                                  class="d-inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-image-alt fs-3 d-block mb-2"></i>
                            No banners found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
