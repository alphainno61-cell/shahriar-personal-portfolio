@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    .btn-gradient {
        background: linear-gradient(135deg, #007bff, #6610f2);
        color: #fff;
        border: none;
        transition: 0.3s ease;
    }
    .btn-gradient:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #0056b3, #520dc2);
    }

    .dashboard-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    /* Gradient Backgrounds for Cards */
    .bg-gradient-blog {
        background: linear-gradient(135deg, #007bff, #00b4d8);
    }
    .bg-gradient-event {
        background: linear-gradient(135deg, #198754, #82c91e);
    }
    .bg-gradient-book {
        background: linear-gradient(135deg, #fd7e14, #ffc107);
    }
    .bg-gradient-donation {
        background: linear-gradient(135deg, #dc3545, #f86d7d);
    }

    .icon-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@section('content')
<div class="pt-2">
    <!-- Analytics Cards -->
    <div class="row g-4">
        <!-- Total Blogs -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card dashboard-card border-0 shadow-sm rounded-4 h-100 bg-gradient-blog text-white">
                <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="icon-wrapper bg-white bg-opacity-25 rounded-circle p-3 mb-3">
                        <i class="bi bi-journal-text fs-2"></i>
                    </div>
                    <h6 class="fw-semibold text-uppercase mb-1 opacity-75">Total Blogs</h6>
                    <h2 class="fw-bold mb-0">{{ $totalBlogs ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Events -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card dashboard-card border-0 shadow-sm rounded-4 h-100 bg-gradient-event text-white">
                <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="icon-wrapper bg-white bg-opacity-25 rounded-circle p-3 mb-3">
                        <i class="bi bi-calendar-event fs-2"></i>
                    </div>
                    <h6 class="fw-semibold text-uppercase mb-1 opacity-75">Total Events</h6>
                    <h2 class="fw-bold mb-0">{{ $totalEvents ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Books -->
        {{-- <div class="col-12 col-sm-6 col-lg-3">
            <div class="card dashboard-card border-0 shadow-sm rounded-4 h-100 bg-gradient-book text-white">
                <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="icon-wrapper bg-white bg-opacity-25 rounded-circle p-3 mb-3">
                        <i class="bi bi-book fs-2"></i>
                    </div>
                    <h6 class="fw-semibold text-uppercase mb-1 opacity-75">Total Books</h6>
                    <h2 class="fw-bold mb-0">{{ $totalBooks ?? 0 }}</h2>
                </div>
            </div>
        </div> --}}

        <!-- Total Donations -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card dashboard-card border-0 shadow-sm rounded-4 h-100 bg-gradient-donation text-white">
                <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="icon-wrapper bg-white bg-opacity-25 rounded-circle p-3 mb-3">
                        <i class="bi bi-cash-stack fs-2"></i>
                    </div>
                    <h6 class="fw-semibold text-uppercase mb-1 opacity-75">Total Donations</h6>
                    <h2 class="fw-bold mb-0">{{ $totalDonations ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
