@extends('layouts.app')

@section('title', 'Philosophical Logics')

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        background: linear-gradient(90deg, #4f46e5, #6366f1);
        color: #fff;
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 1rem 1rem 0 0;
    }

    .badge-logic {
        background-color: #0d6efd;
        margin: 2px 2px 2px 0;
        font-size: 0.85rem;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary mb-0">
            <i class="bi bi-lightbulb-fill me-2"></i>Philosophical Logics
        </h3>
        <a href="{{ route('philosophies.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-1"></i> Add New
        </a>
    </div>

    <div class="row g-4">
        @forelse($philosophies as $philosophy)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        {{ $philosophy->logic_theory }}
                    </div>
                    <div class="card-body">
                        @if(!empty($philosophy->logics))
                            @foreach($philosophy->logics as $logic)
                                <span class="badge badge-logic">{{ $logic }}</span>
                            @endforeach
                        @else
                            <p class="text-muted">No logics added.</p>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('philosophies.edit', $philosophy->id) }}" class="btn btn-edit btn-sm"><i class="bi bi-pencil-square me-1"></i> Edit</a>

                        <!-- Delete Button -->
                        <button type="submit" data-delete-route="{{ route('philosophies.destroy', $philosophy->id) }}" class="delete-item-btn btn btn-sm btn-danger" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>No Philosophical Logics found. Add a new one.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
@include('components.delete-confirmation')
@endpush