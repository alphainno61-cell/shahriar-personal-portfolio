@extends('layouts.app')

@section('title')
    Show All Blogs
@endsection

@push('styles')
<style>
    body {
      background-color: #f9fafb;
      font-family: "Poppins", sans-serif;
    }

    .table-container {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
      padding: 20px;
      margin-top: 40px;
    }

    table th {
      background-color: #f1f3f4;
      color: #333;
      font-weight: 600;
    }

    table td {
      vertical-align: middle;
    }

    .table-hover tbody tr:hover {
      background-color: #f8f9fa;
      transform: scale(1.01);
      transition: all 0.2s ease-in-out;
    }

    .blog-img {
      width: 60px;
      height: 60px;
      border-radius: 8px;
      object-fit: cover;
    }

    .action-btn {
      border: none;
      background: transparent;
      cursor: pointer;
      margin: 0 4px;
      transition: transform 0.2s;
    }

    .action-btn:hover {
      transform: scale(1.2);
    }

    .action-btn i {
      font-size: 1.1rem;
    }

    .action-btn.view i { color: #0d6efd; }
    .action-btn.edit i { color: #ffc107; }
    .action-btn.delete i { color: #dc3545; }

  </style>
@endpush

@section('content')
<div class="">
    <div class="table-container mt-2">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">All Blogs</h4>
        <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm">
          <i class="bi bi-plus-lg me-2"></i> Add New Blog
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead>
            <tr>
              <th>Title</th>
              <th>Content</th>
              <th>Image</th>
              <th class="text-center" style="width: 140px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->content }}</td>
                <td><img src="{{ $blog->getFirstMediaUrl('blog_cover_image') }}" alt="Blog Image" class="blog-img"></td>
                <td class="text-center">
                  <a href="{{ route('blogs.show', $blog->id) }}" class="action-btn view" title="View"><i class="bi bi-eye"></i></a>
                  <a href="{{ route('blogs.edit', $blog->id)}}" class="action-btn edit" title="Edit"><i class="bi bi-pencil-square"></i></a>
                  <button class="action-btn delete-item-btn btn btn-sm" type="submit" data-delete-route="{{ route('blogs.destroy', $blog->id) }}" title="Delete"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            @empty
                <tr rowspan="4">No data found</tr>
            @endforelse
            
          </tbody>
        </table>
        <div>
            {{ $blogs->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
@include('components.delete-confirmation')
@endpush