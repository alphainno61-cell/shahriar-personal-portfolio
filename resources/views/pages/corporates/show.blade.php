@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Corporate Step Details</h2>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">{{ $corporate->title }}</h4>
            <p><strong>Step Number:</strong> {{ $corporate->step_number }}</p>
            <p><strong>Company Name:</strong> {{ $corporate->company_name }}</p>
            <p><strong>Position / Years:</strong> {{ $corporate->position_years }}</p>
            <p><strong>Status:</strong> 
                @if($corporate->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </p>

            @if($corporate->image_path)
                <p><strong>Image:</strong><br>
                <img src="{{ asset('storage/'.$corporate->image_path) }}" width="300"></p>
            @endif

            <p><strong>Description:</strong> {{ $corporate->description }}</p>

            <a href="{{ route('corporates.index') }}" class="btn btn-primary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
