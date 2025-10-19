@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Stories</h2>
        <a href="{{ route('stories.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
            <i class="bi bi-plus-circle me-1"></i> Add New Story
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
                        <th>Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Status</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stories as $story)
                    <tr class="text-center">
                        <td>{{ $story->id }}</td>
                        <td>
                            @if($story->image_path)
                                <img src="{{ asset('storage/'.$story->image_path) }}" width="100" class="img-thumbnail rounded shadow-sm">
                            @else
                                <span class="text-muted fst-italic">No Image</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $story->title }}</td>
                        <td>{{ $story->subtitle }}</td>
                        <td>
                            @if($story->is_active)
                                <span class="badge bg-success px-3 py-2">Active</span>
                            @else
                                <span class="badge bg-secondary px-3 py-2">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('stories.show', $story->id) }}" class="btn btn-sm btn-outline-success action-btn" data-bs-toggle="tooltip" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('stories.edit', $story->id) }}" class="btn btn-sm btn-outline-primary action-btn" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('stories.destroy', $story->id) }}" method="POST" onsubmit="return confirm('Delete this story?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger action-btn" data-bs-toggle="tooltip" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No stories found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
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
</style>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
</script>
@endsection
