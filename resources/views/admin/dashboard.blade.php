@extends('admin.layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        background-color: #f8f9fa;
    }
    .card-hover {
        transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
    }
    .card-hover:hover {
        background-color: #b6d7ff;
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
    }
    .spinner-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 320px;
    }
    .empty-state {
        text-align: center;
        color: #777;
        font-style: italic;
        padding: 2rem 0;
    }
</style>

<div class="container mt-5" style="max-width: 1140px;">
    <div class="row g-4">
        @php
        $cards = [
        ['emoji' => '👥', 'title' => 'Total Developers', 'count' => $totalDevelopers ?? 0],
        ['emoji' => '🏢', 'title' => 'Total Employers', 'count' => $totalEmployers ?? 0],
        ['emoji' => '📄', 'title' => 'Total Job Posts', 'count' => $totalJobs ?? 0],
        ['emoji' => '📝', 'title' => 'Pending Approvals', 'count' => $pendingCount ?? 0],
        ];
        @endphp

        @foreach ($cards as $card)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm card-hover" style="background-color: #d0e8ff; min-height: 120px;">
                <div class="card-body d-flex align-items-center gap-4">
                    <div class="fs-1">{{ $card['emoji'] }}</div>
                    <div>
                        <h6 class="card-title mb-1">{{ $card['title'] }}</h6>
                        <p class="fs-3 fw-bold mb-0">{{ $card['count'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container mt-5" style="max-width: 1140px;">
    <div class="row g-5">
        <div class="col-12 col-lg-6" style="height: 300px;">
            <div id="lineChartWrapper" class="h-100 d-flex flex-column">
                <div id="lineSpinner" class="spinner-container flex-grow-1">
                    <div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
                </div>
                <canvas id="lineChart" style="display:none; flex-grow:1;"></canvas>
                <div id="lineEmpty" class="empty-state" style="display:none;">
                    No job posts or pending approvals data available for the last 7 days.
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6" style="height: 300px;">
            <div id="barChartWrapper" class="h-100 d-flex flex-column">
                <div id="barSpinner" class="spinner-container flex-grow-1">
                    <div class="spinner-border text-warning" role="status"><span class="visually-hidden">Loading...</span></div>
                </div>
                <canvas id="barChart" style="display:none; flex-grow:1;"></canvas>
                <div id="barEmpty" class="empty-state" style="display:none;">
                    No employers or developers data available for the last 7 days.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    const labels = @json($labels ?? []);
    const jobData = @json($jobData ?? []);
    const pendingData = @json($pendingData ?? []);
    const employersData = @json($employersData ?? []);
    const developersData = @json($developersData ?? []);

    function isAllZero(arr) {
        return arr.every(val => val === 0);
    }
    
    const lineSpinner = document.getElementById('lineSpinner');
    const lineChartCanvas = document.getElementById('lineChart');
    const lineEmpty = document.getElementById('lineEmpty');

    if (isAllZero(jobData) && isAllZero(pendingData)) {
        lineSpinner.style.display = 'none';
        lineEmpty.style.display = 'block';
    } else {
        lineSpinner.style.display = 'none';
        lineChartCanvas.style.display = 'block';

        new Chart(lineChartCanvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Job Posts',
                        data: jobData,
                        backgroundColor: '#1E90FF',
                        borderColor: '#1E90FF',
                        borderWidth: 1,
                    },
                    {
                        label: 'Pending Approvals',
                        data: pendingData,
                        backgroundColor: '#FF4500',
                        borderColor: '#FF4500',
                        borderWidth: 1,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                legend: { position: 'top', labels: { font: { size: 14 } } }
                },
                scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } },
                x: { stacked: false }
                }
            }
        });
    }

    const barSpinner = document.getElementById('barSpinner');
    const barChartCanvas = document.getElementById('barChart');
    const barEmpty = document.getElementById('barEmpty');

    if (isAllZero(employersData) && isAllZero(developersData)) {
        barSpinner.style.display = 'none';
        barEmpty.style.display = 'block';
    } else {
        barSpinner.style.display = 'none';
        barChartCanvas.style.display = 'block';

        new Chart(barChartCanvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Employers',
                        data: employersData,
                        backgroundColor: '#7B68EE',
                        borderColor: '#7B68EE',
                        borderWidth: 1,
                    },
                    {
                        label: 'Developers',
                        data: developersData,
                        backgroundColor: '#3CB371',
                        borderColor: '#3CB371',
                        borderWidth: 1,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { font: { size: 14 } } }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } },
                    x: { stacked: false }
                }
            }
        });
    }  
    
</script>

@endsection
