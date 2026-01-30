@extends('user.dashboard.layout.master')

@section('user-contant')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
    body {
        font-size: 13px;
        background: #f8f9fc;
        color: #222
    }

    .section {
        padding: 10px 0
    }

    .card-ui {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #eee;
        padding: 18px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, .06)
    }

    .kpi-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100%;
        color: #222;
        text-decoration: none
    }

    .kpi-title {
        font-size: 12px;
        text-transform: uppercase;
        color: #888
    }

    .kpi-value {
        font-size: 24px;
        font-weight: 700
    }

    .kpi-sub {
        font-size: 11px;
        color: #aaa
    }

    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px
    }

    .bg-blue {
        background: #4e73df
    }

    .bg-green {
        background: #1cc88a
    }

    .bg-red {
        background: #e74a3b
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        font-size: 13px
    }

    .text-success {
        color: #1cc88a
    }

    .text-danger {
        color: #e74a3b
    }

    h5 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 12px
    }

    .card-modern {
        background: #fff;
        border-radius: 10px;
        border: 1px solid #eee;
        padding: 16px
    }

    canvas {
        max-height: 260px
    }
</style>

<div class="main-content">
    <section class="section">
        <div class="container-fluid">

            <!-- ================= KPI ROW ================= -->
            <div class="row g-3 mb-3">

                <div class="col-md-6 col-lg-3">
                    <div class="card-ui kpi-card">
                        <div>
                            <div class="kpi-title">{{ translateConcat('Customers') }}</div>
                            <div class="kpi-value">{{ $totalCustomers }}</div>
                        </div>
                        <div class="icon-box bg-blue"><i class="fas fa-users"></i></div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card-ui kpi-card">
                        <div>
                            <div class="kpi-title">{{ translateConcat('Stock') }}</div>
                            <div class="kpi-value">{{ $totalStocks }}</div>
                        </div>
                        <div class="icon-box bg-green"><i class="fas fa-box"></i></div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card-ui kpi-card">
                        <div>
                            <div class="kpi-title">{{ translateConcat('Revenue') }}</div>
                            <div class="kpi-value">{{ number_format($totalRevenue,2) }}</div>
                            <div class="kpi-sub">{{ currency() }}</div>
                        </div>
                        <div class="icon-box bg-blue"><i class="fas fa-chart-line"></i></div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card-ui kpi-card">
                        <div>
                            <div class="kpi-title">{{ translateConcat('Expenses') }}</div>
                            <div class="kpi-value">{{ number_format($totalExpenses,2) }}</div>
                            <div class="kpi-sub">{{ currency() }}</div>
                        </div>
                        <div class="icon-box bg-red"><i class="fas fa-receipt"></i></div>
                    </div>
                </div>

            </div>

            <!-- ================= JOBS ================= -->
            <div class="row g-3 mb-3">

                <div class="col-lg-4">
                    <div class="card-ui">
                        <h5>{{ translateConcat('Jobs Today') }}</h5>
                        <div class="summary-row"><span>{{ translateConcat('Completed') }}</span><strong>{{ $jobsCompletedToday }}</strong></div>
                        <div class="summary-row"><span>{{ translateConcat('Running') }}</span><strong>{{ $jobsRunning }}</strong></div>
                        <div class="summary-row"><span>{{ translateConcat('Pending Payment') }}</span><strong>{{ $pendingPayments }} {{ currency() }}</strong></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-ui">
                        <h5>{{ translateConcat('Service Jobs') }}</h5>
                        <div class="summary-row"><span>{{ translateConcat('Total') }}</span><strong>{{ $totalServiceJobs }}</strong></div>
                        <div class="summary-row"><span>{{ translateConcat('Running') }}</span><strong>{{ $serviceRunning }}</strong></div>
                        <div class="summary-row"><span>{{ translateConcat('Completed') }}</span><strong>{{ $serviceCompleted }}</strong></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-ui">
                        <h5>{{ translateConcat('Insurance Jobs') }}</h5>
                        <div class="summary-row"><span>{{ translateConcat('Total') }}</span><strong>{{ $totalInsuranceJobs }}</strong></div>
                        <div class="summary-row"><span>{{ translateConcat('Running') }}</span><strong>{{ $insuranceRunning }}</strong></div>
                        <div class="summary-row"><span>{{ translateConcat('Completed') }}</span><strong>{{ $insuranceCompleted }}</strong></div>
                    </div>
                </div>

            </div>

            <!-- ================= SUMMARY ================= -->
            <div class="row g-3 mb-4">

                <div class="col-lg-4">
                    <div class="card-ui">
                        <h5>{{ translateConcat('Today Summary') }}</h5>
                        <div class="summary-row"><span>{{ translateConcat('Revenue') }}</span><span class="text-success">{{ $todayRevenue }} {{ currency() }}</span></div>
                        <div class="summary-row"><span>{{ translateConcat('Cash') }}</span><span>{{ $todayCash }} {{ currency() }}</span></div>
                        <div class="summary-row"><span>{{ translateConcat('Card') }}</span><span>{{ $todayCard }} {{ currency() }}</span></div>
                        <div class="summary-row"><span>{{ translateConcat('Bank') }}</span><span>{{ $todayBank }} {{ currency() }}</span></div>
                        <hr>
                        <div class="summary-row"><span>{{ translateConcat('Expenses') }}</span><span class="text-danger">{{ $todayExpenses }} {{ currency() }}</span></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-ui">
                        <h5>{{ translateConcat('Financial Overview') }}</h5>
                        <div class="summary-row"><span>{{ translateConcat('Revenue') }}</span><span class="text-success">{{ $totalRevenue }} {{ currency() }}</span></div>
                        <div class="summary-row"><span>{{ translateConcat('Cash') }}</span><span>{{ $cash }} {{ currency() }}</span></div>
                        <div class="summary-row"><span>{{ translateConcat('Card') }}</span><span>{{ $card }} {{ currency() }}</span></div>
                        <div class="summary-row"><span>{{ translateConcat('Bank') }}</span><span>{{ $bank }} {{ currency() }}</span></div>
                        <hr>
                        <div class="summary-row"><span>{{ translateConcat('Expenses') }}</span><span class="text-danger">{{ $totalExpenses }} {{ currency() }}</span></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-ui">
                        <h5>{{ translateConcat('Expenses Distribution') }}</h5>
                        <canvas id="expenseChart"></canvas>
                    </div>
                </div>

            </div>

            <!-- ================= BOTTOM ANALYTICS ================= -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card-modern">
                        <h5>{{ translateConcat('Revenue Analytics') }}</h5>
                        <canvas id="revenueChartBottom"></canvas>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card-modern">
                        <h5>{{ translateConcat('Expenses Analytics') }}</h5>
                        <canvas id="expenseChartBottom"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: @json($revenueMonths),
            datasets: [{
                data: @json($revenueData),
                backgroundColor: '#4e73df'
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    new Chart(document.getElementById('expenseChart'), {
        type: 'doughnut',
        data: {
            labels: @json($expenseLabels),
            datasets: [{
                data: @json($expenseData),
                backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#e74a3b']
            }]
        }
    });

    new Chart(document.getElementById('revenueChartBottom'), {
        type: 'line',
        data: {
            labels: @json($revenueMonths),
            datasets: [{
                data: @json($revenueData),
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78,115,223,.2)',
                fill: true,
                tension: .4
            }]
        }
    });

    new Chart(document.getElementById('expenseChartBottom'), {
        type: 'pie',
        data: {
            labels: @json($expenseLabels),
            datasets: [{
                data: @json($expenseData),
                backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#e74a3b']
            }]
        }
    });
</script>

@endsection