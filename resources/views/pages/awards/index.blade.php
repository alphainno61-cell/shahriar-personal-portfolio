@extends('layouts.app')

@section('content')
<div class="pt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-header" style="font-size: 2rem; font-weight: 700; color: var(--primary-color); position: relative; padding-bottom: 0.5rem;">
            Awards
            <span class="title-underline"></span>
        </h2>
        <a href="{{ route('awards.create') }}" class="btn btn-primary add-btn rounded-pill px-4 py-2">
            <i class="bi bi-plus-circle me-1"></i> Add New Award
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-3" style="background: var(--card-background);">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: #ffffff; border: 2px solid var(--primary-color);">
                        <tr>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">ID</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Image</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Time Period</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Title</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Status</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600; width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($awards as $award)
                        <tr class="text-center" style="transition: background 0.2s ease;">
                            <td style="font-size: 0.875rem; color: var(--text-primary);">{{ $award->id }}</td>
                            <td>
                                @if($award->image_path)
                                    <img src="{{ asset('storage/'.$award->image_path) }}" 
                                         alt="Award Image" 
                                         width="80" 
                                         class="img-thumbnail rounded shadow-sm" 
                                         style="border: none; transition: transform 0.2s ease;">
                                @else
                                    <span class="text-muted fst-italic" style="font-size: 0.75rem;">No Image</span>
                                @endif
                            </td>
                            <td style="font-size: 0.875rem; color: var(--text-secondary);">{{ $award->time_period }}</td>
                            <td class="fw-semibold" style="font-size: 0.875rem; color: var(--text-primary);">{{ $award->title }}</td>
                            <td>
                                @if(isset($award->is_active) && $award->is_active == 1)
                                    <span class="badge px-3 py-2" style="background: var(--success-color); font-size: 0.75rem;">Active</span>
                                @else
                                    <span class="badge px-3 py-2" style="background: var(--danger-color); font-size: 0.75rem;">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('awards.show', $award->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background: var(--success-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('awards.edit', $award->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background: var(--primary-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('awards.destroy', $award->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Delete this award?')" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm action-btn" 
                                                style="background: var(--danger-color); color: #ffffff;" 
                                                data-bs-toggle="tooltip" 
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4" style="font-size: 0.875rem; color: var(--text-secondary);">No awards found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        :root {
            --primary-color: #2563eb; /* Vibrant blue for primary elements */
            --secondary-color: #7c3aed; /* Purple for accents */
            --success-color: #059669; /* Green for success states */
            --danger-color: #dc2626; /* Red for danger states */
            --card-background: #ffffff; /* White card background */
            --text-primary: #111827; /* Dark gray for primary text */
            --text-secondary: #6b7280; /* Muted gray for secondary text */
            --shadow-sm: 0 4px 8px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 8px 16px rgba(37, 99, 235, 0.15);
        }

        .title-header {
            position: relative;
        }

        .title-underline {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .title-header:hover .title-underline {
            width: 100px;
        }

        .add-btn {
            background: var(--primary-color);
            border: none;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
        }

        .add-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .add-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .add-btn:hover::before {
            left: 100%;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            border: none;
            box-shadow: var(--shadow-sm);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa !important;
        }

        .badge {
            font-size: 0.75rem;
            border-radius: 0.5rem;
            font-weight: 600;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th, .table td {
            border: none;
            padding: 1rem;
        }

        .table th {
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table-responsive {
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
        }

        @media (max-width: 767.98px) {
            .container {
                padding: 1rem;
            }

            .title-header {
                font-size: 1.5rem;
            }

            .add-btn {
                font-size: 0.75rem;
                padding: 0.5rem 1.5rem;
            }

            .table th, .table td {
                padding: 0.75rem;
                font-size: 0.75rem;
            }

            .action-btn {
                width: 32px;
                height: 32px;
            }

            .badge {
                font-size: 0.625rem;
                padding: 0.5rem 1rem;
            }

            .img-thumbnail {
                width: 60px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
    </script>
@endpush
@endsection