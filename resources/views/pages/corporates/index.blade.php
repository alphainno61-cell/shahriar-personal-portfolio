@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Corporate Journey</h2>
        <a href="{{ route('corporates.create') }}" class="btn btn-primary">+ Add Step</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Step Number</th>
                <th>Title</th>
                <th>Company</th>
                <th>Position</th>
                <th>Status</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($corporates as $corporate)
            <tr>
                <td>{{ $corporate->id }}</td>
                <td>{{ $corporate->step_number }}</td>
                <td>{{ $corporate->title }}</td>
                <td>{{ $corporate->company_name }}</td>
                <td>{{ $corporate->position_years }}</td>
                <td>
                    @if($corporate->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('corporates.show', $corporate->id) }}" class="btn btn-sm btn-success text-white"><i class="bi bi-eye"></i> View</a>
                        <a href="{{ route('corporates.edit', $corporate->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                        <form action="{{ route('corporates.destroy', $corporate->id) }}" method="POST" onsubmit="return confirm('Delete this step?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted">No steps found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
