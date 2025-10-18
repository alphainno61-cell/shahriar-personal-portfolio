@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Impacts</h2>
        <a href="{{ route('impacts.create') }}" class="btn btn-primary">+ Add New Impact</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Title</th>
                <th>Images</th>
                <th>Status</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($impacts as $impact)
            <tr>
                <td>{{ $impact->id }}</td>
                <td>{{ ucfirst($impact->type) }}</td>
                <td>{{ $impact->title }}</td>
                <td>
                    @for($i=1; $i<=4; $i++)
                        @php $img = 'image'.$i.'_path'; @endphp
                        @if($impact->$img)
                            <img src="{{ asset('storage/'.$impact->$img) }}" width="70" class="rounded me-1 mb-1">
                        @endif
                    @endfor
                </td>
                <td>
                    @if($impact->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('impacts.show', $impact->id) }}" class="btn btn-sm btn-success text-white">
                            <i class="bi bi-eye"></i> View
                        </a>
                        <a href="{{ route('impacts.edit', $impact->id) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('impacts.destroy', $impact->id) }}" method="POST" onsubmit="return confirm('Delete this impact?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No impacts found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
