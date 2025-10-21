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

    <!-- Visitors Graph -->
    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="card p-4">
                <h4 class="mb-4">Visitors Overview</h4>
                <canvas id="visitorsChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('visitorsChart').getContext('2d');
    const visitorsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Visitors',
                data: [120, 190, 300, 500, 200, 300, 450, 600, 550, 700, 800, 900],
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderColor: '#007bff',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#007bff',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 2.5,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection