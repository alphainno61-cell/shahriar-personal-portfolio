@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Award Details</h2>

    <div class="card shadow-sm rounded-4 p-4">
        <div class="row">
            <div class="col-md-4 text-center">
                @if($award->image_path)
                    <img src="{{ asset('storage/'.$award->image_path) }}" alt="Award Image" class="img-fluid rounded shadow-sm">
                @else
                    <div class="text-muted fst-italic">No Image Available</div>
                @endif
            </div>

            <div class="col-md-8">
                <h4 class="fw-semibold">{{ $award->title }}</h4>
                <p class="text-primary mb-2">{{ $award->time_period }}</p>
                <p>{{ $award->description }}</p>
                <p>
                    Status:
                    @if($award->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </p>

                <div class="mt-4">
                    <a href="{{ route('awards.edit', $award->id) }}" class="btn btn-success">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="{{ route('awards.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
