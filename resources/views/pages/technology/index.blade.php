@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Technology Fields</h1>

    <a href="{{ route('technology.createField') }}" class="btn btn-primary mb-3">+ Add Field</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Tools Title</th>
                <th>Image</th>
                <th>Status</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fields as $key => $field)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $field->title }}</td>
                <td>{{ $field->tools_title }}</td>
                <td>
                    @if($field->image)
                        <img src="{{ asset('storage/'.$field->image) }}" width="80">
                    @endif
                </td>
                <td>
                    @if($field->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('technology.editField', $field->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('technology.destroyField', $field->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this field?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
