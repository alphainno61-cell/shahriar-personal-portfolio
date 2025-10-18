@extends('layouts.app')

@section('title', 'Publication Summaries')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">
            <i class="bi bi-journal-text me-2"></i>Publication Summaries
        </h2>
        <a href="{{ route('publication-summery.create') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-lg me-2"></i>Add New
        </a>
    </div>

    @if($publicationSummaries->isEmpty())
        <div class="text-center text-muted py-5">
            <i class="bi bi-journal-bookmark fs-1"></i>
            <p class="mt-3 mb-0">No publication summaries found.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($publicationSummaries as $summary)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm rounded-4 h-100 overflow-hidden">
                        
                        <!-- Image -->
                        @if($summary->hasMedia('publication_images'))
                            <img src="{{ $summary->getFirstMediaUrl('publication_images') }}" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover;" 
                                 alt="Publication Image">
                        @else
                            <div class="bg-light text-center py-5 text-muted">
                                <i class="bi bi-image fs-1"></i>
                                <p class="mt-2 mb-0">No Image</p>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <p class="card-text text-muted flex-grow-1">{{ $summary->content }}</p>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('publication-summery.edit', $summary->id) }}" 
                                   class="btn btn-warning btn-sm rounded-pill px-3">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </a>

                                <form action="{{ route('publication-summery.destroy', $summary->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3"
                                            onclick="return confirm('Are you sure you want to delete this summary?');">
                                        <i class="bi bi-trash3 me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-footer bg-light text-muted text-center py-2">
                            <small>Created at: {{ $summary->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
