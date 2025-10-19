@extends('layouts.app')

@section('content')
<div class="container pt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-header" style="font-size: 2rem; font-weight: 700; color: var(--primary-color); position: relative; padding-bottom: 0.5rem;">
            Donation Banners
            <span class="title-underline"></span>
        </h2>
        <a href="{{ route('donation-banners.create') }}" class="btn btn-primary add-btn rounded-pill px-4 py-2">
            <i class="bi bi-plus-circle me-1"></i> Add New Banner
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3" style="background: var(--success-color); color: #ffffff; border: none;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3" style="background: var(--card-background);">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: #ffffff; border: 2px solid var(--primary-color);">
                        <tr>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">#</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Image</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Section Title</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Main Quote</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Button Text</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Status</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600; width: 20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $index => $banner)
                        <tr class="text-center" style="transition: background 0.2s ease;">
                            <td style="font-size: 0.875rem; color: var(--text-primary);">{{ $index + 1 }}</td>
                            <td>
                                @if($banner->image_path)
                                    <img src="{{ asset('storage/' . $banner->image_path) }}" 
                                         alt="Banner Image" 
                                         class="img-thumbnail rounded shadow-sm" 
                                         style="width: 70px; height: 50px; border: none; transition: transform 0.2s ease; object-fit: cover;">
                                @else
                                    <span class="text-muted fst-italic" style="font-size: 0.75rem;">No Image</span>
                                @endif
                            </td>
                            <td class="fw-semibold" style="font-size: 0.875rem; color: var(--text-primary);">{{ $banner->section_title ?? '—' }}</td>
                            <td style="font-size: 0.875rem; color: var(--text-secondary);">{{ Str::limit($banner->main_quote, 50) }}</td>
                            <td style="font-size: 0.875rem; color: var(--text-secondary);">{{ $banner->button_text ?? '—' }}</td>
                            <td>
                                @if($banner->is_active)
                                    <span class="badge px-3 py-2" style="background: var(--success-color); font-size: 0.75rem;">Active</span>
                                @else
                                    <span class="badge px-3 py-2" style="background: var(--danger-color); font-size: 0.75rem;">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('donation-banners.show', $banner->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background: var(--success-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('donation-banners.edit', $banner->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background: var(--primary-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('donation-banners.destroy', $banner->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this banner?')" 
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
                            <td colspan="7" class="text-center text-muted py-4" style="font-size: 0.875rem; color: var(--text-secondary);">
                                <i class="bi bi-image-alt fs-3 d-block mb-2"></i>
                                No banners found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        body {
            font-family: 'Inter', 'Poppins', system-ui, -apple-system, sans-serif;
            font-weight: 400;
            line-height: 1.6;
        }

        .title-header {
            position: relative;
            font-weight: 700;
            letter-spacing: -0.02em;
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
            font-weight: 500;
            letter-spacing: 0.02em;
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
            font-size: 0.9rem;
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
            font-weight: 500;
            border-radius: 0.5rem;
            letter-spacing: 0.02em;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
            font-weight: 400;
        }

        .table th, .table td {
            border: none;
            padding: 1rem;
            line-height: 1.5;
        }

        .table th {
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .table-responsive {
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .img-thumbnail {
            border-radius: 5px;
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
                height: 45px;
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