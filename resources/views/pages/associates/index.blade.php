@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Associates</h2>
        <a href="{{ route('associates.create') }}" class="btn btn-primary">+ Add New Associate</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Background Image</th>
                <th>Status</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($associates as $associate)
            <tr>
                <td>{{ $associate->id }}</td>
                <td>{{ $associate->title }}</td>
                <td>{{ Str::limit($associate->description, 50) }}</td>
                <td>
                    @if($associate->background_image)
                    <img src="{{ asset('storage/'.$associate->background_image) }}" width="100" class="rounded">
                    @else
                    <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>
                    @if($associate->is_active)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Associate Actions">
                        <a href="{{ route('associates.show', $associate->id) }}" class="btn btn-sm btn-success text-white">
                            <i class="bi bi-eye"></i> View
                        </a>
                        <a href="{{ route('associates.edit', $associate->id) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('associates.destroy', $associate->id) }}" method="POST" onsubmit="return confirm('Delete this associate?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No associates found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
