@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Donation Banners</h4>
        <a href="{{ route('donation-banners.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Banner
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-striped table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Section Title</th>
                            <th>Main Quote</th>
                            <th>Button Text</th>
                            <th>Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banners as $index => $banner)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($banner->image_path)
                                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner" class="rounded" width="70" height="50" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $banner->section_title ?? '—' }}</td>
                                <td>{{ Str::limit($banner->main_quote, 50) }}</td>
                                <td>{{ $banner->button_text ?? '—' }}</td>
                                <td>
                                    @if($banner->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- View Button -->
                                        <a href="{{ route('donation-banners.show', $banner->id) }}" class="btn btn-sm btn-info text-white" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('donation-banners.edit', $banner->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('donation-banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this banner?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No banners found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Optional Custom Styles -->
<style>
    .table img {
        border-radius: 5px;
    }

    .btn i {
        vertical-align: middle;
    }
</style>
@endsection
