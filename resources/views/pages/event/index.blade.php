@extends('layouts.app')

@section('title', 'Show All Events')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary mb-0">
            <i class="bi bi-calendar-event-fill me-2"></i>All Events
        </h3>
        <a href="{{ route('events.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
            <i class="bi bi-plus-lg me-2"></i>Add New Event
        </a>
    </div>

    @if($events->count() > 0)
        <div class="table-responsive shadow-sm rounded-4">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" style="width: 60px;">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col" class="text-center" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $index => $event)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                @if($event->hasMedia('event_image'))
                                    <img src="{{ $event->getFirstMediaUrl('event_image') }}"
                                         alt="{{ $event->title }}"
                                         class="img-thumbnail shadow-sm"
                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                                @else
                                    <img src="https://via.placeholder.com/80x80?text=No+Image"
                                         class="img-thumbnail shadow-sm"
                                         alt="No Image">
                                @endif
                            </td>

                            <td class="fw-semibold text-dark">{{ $event->title }}</td>

                            <td class="text-muted text-truncate" style="max-width: 300px;">
                                {{ $event->content ?? '—' }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('events.show', $event->id) }}" 
                                   class="btn btn-sm btn-info text-white rounded-pill me-1" title="View">
                                    <i class="bi bi-eye-fill"></i>
                                </a>

                                <a href="{{ route('events.edit', $event->id) }}" 
                                   class="btn btn-sm btn-warning text-white rounded-pill me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('events.destroy', $event->id) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this event?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill" title="Delete">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076505.png" width="120" class="mb-3 opacity-75" alt="No Data">
            <h5 class="text-muted">No Events Found</h5>
        </div>
    @endif
</div>
@endsection

@push('scripts')
    @include('components.delete-confirmation')
@endpush
