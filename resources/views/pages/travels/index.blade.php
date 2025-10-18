@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Travel Countries</h2>
        <a href="{{ route('travels.create') }}" class="btn btn-primary">+ Add New Country</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Country Name</th>
                <th>Flag</th>
                <th>Map Image</th>
                <th>Status</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($travels as $travel)
            <tr>
                <td>{{ $travel->id }}</td>
                <td>{{ $travel->country_name }}</td>
                <td>
                    @if($travel->country_flag_path)
                        <img src="{{ asset('storage/'.$travel->country_flag_path) }}" width="50" class="rounded">
                    @else
                        <span class="text-muted">No Flag</span>
                    @endif
                </td>
                <td>
                    @if($travel->map_image_path)
                        <img src="{{ asset('storage/'.$travel->map_image_path) }}" width="70" class="rounded">
                    @else
                        <span class="text-muted">No Map</span>
                    @endif
                </td>
                <td>
                    @if($travel->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('travels.show', $travel->id) }}" class="btn btn-sm btn-success text-white">
                            <i class="bi bi-eye"></i> View
                        </a>
                        <a href="{{ route('travels.edit', $travel->id) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('travels.destroy', $travel->id) }}" method="POST" onsubmit="return confirm('Delete this country?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No countries found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
