@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-black">All Innovations</h4>
        <a href="{{ route('innovations.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Add New
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($innovations as $innovation)
                    <tr>
                        <td>{{ $innovation->id }}</td>
                        <td>{{ $innovation->title ?? 'N/A' }}</td>
                        <td>{{ Str::limit($innovation->content, 50) ?? 'N/A' }}</td>
                        <td>
                            @if($innovation->getMedia('innovation_images')->count() > 0)
                                @foreach($innovation->getMedia('innovation_images') as $image)
                                    <img src="{{ $image->getFullUrl() }}" 
                                         class="img-thumbnail me-1 mb-1" 
                                         style="height:50px; width:50px; object-fit:cover;">
                                @endforeach
                            @else
                                <span class="text-muted fst-italic">No Images</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('innovations.edit', $innovation->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('innovations.destroy', $innovation->id) }}" 
                                method="POST" 
                                class="d-inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this innovation?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                  <i class="bi bi-trash3"></i>
                              </button>
                          </form>                          
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted fst-italic">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $innovations->links() }}
        </div>
    </div>
</div>
@endsection
