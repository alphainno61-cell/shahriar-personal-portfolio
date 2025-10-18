@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">All Donations</h4>
        <a href="{{ route('donations.create') }}" class="btn btn-primary">Add New Donation</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Button Text</th>
                        <th>Order No</th>
                        <th>Active</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($donations as $key => $donation)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($donation->image)
                                    <img src="{{ asset('storage/' . $donation->image) }}" width="80" class="rounded">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $donation->title }}</td>
                            <td>{{ $donation->button_text ?? '—' }}</td>
                            <td>{{ $donation->order_no }}</td>
                            <td>
                                @if($donation->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('donations.show', $donation->id) }}" class="btn btn-sm btn-success text-white">View</a>
                                    <a href="{{ route('donations.edit', $donation->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Delete this donation?')" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No donations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
