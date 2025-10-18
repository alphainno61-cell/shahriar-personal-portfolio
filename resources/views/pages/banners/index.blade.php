@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Banners</h2>
        <a href="{{ route('banners.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
            <i class="bi bi-plus-circle me-1"></i> Add New Banner
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $banner)
                    <tr class="text-center">
                        <td>{{ $banner->id }}</td>
                        <td class="fw-semibold">{{ $banner->title }}</td>
                        <td>{{ $banner->subtitle }}</td>
                        <td>
                            @if($banner->image_path)
                                <img src="{{ asset('storage/'.$banner->image_path) }}" 
                                     alt="Banner Image" 
                                     width="100" 
                                     class="img-thumbnail rounded shadow-sm">
                            @else
                                <span class="text-muted fst-italic">No Image</span>
                            @endif
                        </td>
                        <td>
                            @if($banner->is_active)
                                <span class="badge bg-success px-3 py-2">Active</span>
                            @else
                                <span class="badge bg-danger px-3 py-2">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('banners.show', $banner->id) }}" 
                                   class="btn btn-sm btn-outline-success action-btn">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('banners.edit', $banner->id) }}" 
                                   class="btn btn-sm btn-outline-primary action-btn">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('banners.destroy', $banner->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Delete this banner?')"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger action-btn">
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

<style>
    /* ======= Custom Professional Styles ======= */
    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa !important;
    }

    .table-primary th {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white !important;
    }

    .badge {
        font-size: 0.85rem;
        border-radius: 10px;
    }
</style>
@endsection
