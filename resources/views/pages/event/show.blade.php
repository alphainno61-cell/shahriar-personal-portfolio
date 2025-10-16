@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <!-- Event Image -->
                @if ($event->hasMedia('event_image'))
                    <img src="{{ $event->getFirstMediaUrl('event_image') }}" 
                         alt="{{ $event->title }}" 
                         class="img-fluid w-100" 
                         style="max-height: 400px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/800x400?text=No+Event+Image" 
                         class="img-fluid w-100" 
                         style="max-height: 400px; object-fit: cover;">
                @endif

                <div class="card-body p-4">
                    <!-- Title -->
                    <h2 class="card-title mb-3 text-primary fw-bold">
                        <i class="bi bi-calendar-event me-2"></i>{{ $event->title }}
                    </h2>

                    <!-- Event Details -->
                    <div class="mb-3 text-muted">
                        <p class="mb-1">
                            <i class="bi bi-geo-alt-fill me-2 text-danger"></i>
                            <strong>Place:</strong> {{ $event->event_place }}
                        </p>
                        <p class="mb-1">
                            <i class="bi bi-clock-fill me-2 text-success"></i>
                            <strong>Date:</strong> 
                            {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}
                        </p>
                        <p class="mb-0">
                            <i class="bi bi-calendar-check-fill me-2 text-info"></i>
                            <strong>Created:</strong> {{ $event->created_at->format('M d, Y') }}
                        </p>
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <h5 class="fw-semibold mb-2 text-secondary">Event Details</h5>
                        <p class="text-dark" style="line-height: 1.8;">
                            {!! nl2br(e($event->content)) !!}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('events.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>

                        <div>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning rounded-pill px-4 py-2 text-white">
                                <i class="bi bi-pencil-square me-2"></i>Edit
                            </a>

                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-pill px-4 py-2">
                                    <i class="bi bi-trash3-fill me-2"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
