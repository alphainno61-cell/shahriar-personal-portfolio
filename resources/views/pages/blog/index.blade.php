@extends('layouts.app')

@section('title', 'Show All Blogs')

@push('styles')
<style>
    body {
        background-color: #f5f7fa;
        font-family: "Poppins", sans-serif;
    }

    .table-container {
        background: linear-gradient(180deg, #ffffff 0%, #f9fafb 100%);
        border-radius: 18px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        padding: 25px;
        margin-top: 40px;
        transition: all 0.3s ease;
    }

    .table-container:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transform: translateY(-3px);
    }

    .table thead th {
        background-color: #0d6efd;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
        padding: 14px;
    }

    .table tbody td {
        vertical-align: middle;
        color: #333;
        font-size: 0.95rem;
        background-color: #fff;
        transition: all 0.2s ease;
    }

    .table tbody tr {
        border-bottom: 1px solid #eee;
    }

    .table-hover tbody tr:hover {
        background-color: #f0f7ff;
        transform: scale(1.01);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .blog-img {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid #e9ecef;
        transition: 0.3s ease;
    }

    .blog-img:hover {
        transform: scale(1.08);
        border-color: #0d6efd;
    }

    /* Action buttons */
    .action-btn {
        border: none;
        background: transparent;
        cursor: pointer;
        margin: 0 4px;
        transition: transform 0.2s ease;
    }

    .action-btn:hover {
        transform: scale(1.2);
    }

    .action-btn i {
        font-size: 1.1rem;
    }

    .action-btn.view i {
        color: #0d6efd;
    }

    .action-btn.edit i {
        color: #ffc107;
    }

    .action-btn.delete i {
        color: #dc3545;
    }

    /* Header and button styling */
    .header-title {
        font-weight: 700;
        color: #0d6efd;
    }

    .btn-add {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        border: none;
        color: #fff;
        border-radius: 30px;
        font-weight: 500;
        padding: 8px 18px;
        transition: 0.3s ease;
    }

    .btn-add:hover {
        background: linear-gradient(135deg, #0b5ed7, #520dc2);
        transform: scale(1.05);
    }

    /* Pagination Styling */
    .pagination {
        justify-content: center;
    }

    .pagination .page-link {
        color: #0d6efd;
        border-radius: 10px;
        margin: 0 3px;
    }

    .pagination .active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="table-container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="header-title mb-0">
                <i class="bi bi-journal-text me-2"></i>All Blogs
            </h4>
            <a href="{{ route('blogs.create') }}" class="btn btn-add shadow-sm">
                <i class="bi bi-plus-circle me-2"></i> Add New Blog
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th style="width: 140px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td class="text-truncate" style="max-width: 250px;">{{ Str::limit($blog->content, 20) }}</td>
                        <td>
                            <img src="{{ $blog->getFirstMediaUrl('blog_cover_image') }}" 
                                 alt="Blog Image" class="blog-img">
                        </td>
                        <td>
                            <a href="{{ route('blogs.show', $blog->id) }}" 
                               class="action-btn view" title="View">
                               <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('blogs.edit', $blog->id) }}" 
                               class="action-btn edit" title="Edit">
                               <i class="bi bi-pencil-square"></i>
                            </a>
                            <button class="action-btn delete-item-btn btn btn-sm" 
                                    type="submit" 
                                    data-delete-route="{{ route('blogs.destroy', $blog->id) }}" 
                                    title="Delete">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-muted py-4">No data found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('components.delete-confirmation')
@endpush
