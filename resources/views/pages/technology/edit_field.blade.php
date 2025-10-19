@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Technology Field</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('technology.updateField', $field->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $field->title }}" required>
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="{{ $field->subtitle }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $field->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Current Main Image</label><br>
            @if($field->image)
                <img src="{{ asset('storage/'.$field->image) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Current Frame Image</label><br>
            @if($field->frame_image)
                <img src="{{ asset('storage/'.$field->frame_image) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="frame_image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tools Title</label>
            <input type="text" name="tools_title" class="form-control" value="{{ $field->tools_title }}">
        </div>

        <div class="mb-3">
            <label>Tools Description</label>
            <textarea name="tools_description" class="form-control" rows="3">{{ $field->tools_description }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" {{ $field->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Update Field</button>
        <a href="{{ route('technology.index') }}" class="btn btn-secondary">Back</a>
    </form>

    <hr class="my-4">

    <h3>Skills</h3>
    <a href="{{ route('technology.createSkill', $field->id) }}" class="btn btn-primary mb-3">+ Add Skill</a>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Icon</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($field->skills as $key => $skill)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $skill->name }}</td>
                <td>
                    <img src="{{ asset('storage/'.$skill->icon) }}" width="50">
                </td>
                <td>{{ $skill->order_no }}</td>
                <td>
                    <form action="{{ route('technology.destroySkill', [$field->id,$skill->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete skill?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
