@extends('layouts.app')

@push('styles')
    <style>
        .content-area {
            background-color: #f8f9fa;
            padding: 2rem;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-icon {
            font-size: 1.5rem; /* Reduced from 2.5rem */
            color: #ffffff;
            background-color: #007bff;
            padding: 10px; /* Adjusted padding to match smaller icon */
            border-radius: 8px;
        }
        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .stat-label {
            color: #6c757d;
            font-size: 0.875rem;
        }
        @media (max-width: 767px) {
            .content-area {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')
<div class="content-area mt-2">
    <h2 class="mb-4">Analytics Overview</h2>
    <div class="row g-4">
        <!-- Total Blogs -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $totalBlogs }}</div>
                        <div class="stat-label">Total Blogs</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Events -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #28a745;">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $totalEvents }}</div>
                        <div class="stat-label">Total Events</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Books -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #dc3545;">
                        <i class="bi bi-book"></i>
                    </div>
                    <div>
                        <div class="stat-number">6</div>
                        <div class="stat-label">Total Books</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Donations -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #ffc107;">
                        <i class="bi bi-cash"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $totalDonations }}</div>
                        <div class="stat-label">Total Donations</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection