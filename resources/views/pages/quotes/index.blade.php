@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-black">All Quotes</h4>
        <a href="{{ route('quotes.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Add New
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Quote</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($quotes as $quote)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Str::limit($quote->quote_text, 100) }}</td>
                        <td>
                            <a href="{{ route('quotes.edit', $quote->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('quotes.destroy', $quote->id) }}" 
                                method="POST" 
                                class="d-inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this quote?');">
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
                        <td colspan="3" class="text-center text-muted fst-italic">No quotes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $quotes->links() }}
        </div>
    </div>

</div>
@endsection
