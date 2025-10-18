@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Add Skill for: {{ $field->title }}</h1>

    <form action="{{ route('technology.storeSkill', $field->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Skill Name</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Icon</label>
            <input type="file" name="icon" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Order</label>
            <input type="number" name="order_no" class="form-control" value="0">
        </div>

        <button type="submit" class="btn btn-success">Add Skill</button>
        <a href="{{ route('technology.editField', $field->id) }}" class="btn btn-danger">Back</a>
    </form>
</div>
@endsection
