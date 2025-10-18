@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Certificates</h1>

    <a href="{{ route('certificates.create') }}" class="btn btn-primary mb-3">+ Add Certificate</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Image</th>
                <th>Status</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($certificates as $key => $certificate)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $certificate->title }}</td>
                    <td><img src="{{ asset('storage/' . $certificate->image) }}" width="80" height="60"></td>
                    <td>
                        @if($certificate->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('certificates.edit', $certificate->id) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ route('certificates.destroy', $certificate->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this certificate?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
