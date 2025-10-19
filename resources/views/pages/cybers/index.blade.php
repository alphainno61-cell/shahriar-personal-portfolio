@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Cyber Security Sections</h1>

    <a href="{{ route('cybers.create') }}" class="btn btn-primary mb-3">+ Add New Section</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Image</th>
                <th>Frame</th>
                <th>Status</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cybers as $key => $cyber)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $cyber->title }}</td>
                    <td>{{ $cyber->subtitle }}</td>
                    <td>
                        @if($cyber->image)
                            <img src="{{ asset('storage/'.$cyber->image) }}" width="80">
                        @endif
                    </td>
                    <td>
                        @if($cyber->frame_image)
                            <img src="{{ asset('storage/'.$cyber->frame_image) }}" width="80">
                        @endif
                    </td>
                    <td>
                        @if($cyber->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('cybers.edit', $cyber->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('cybers.destroy', $cyber->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this section?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
