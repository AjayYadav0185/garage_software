@extends('user.dashboard.layout.master')

@section('user-contant')

<div class="newpage"></div>

<div id="app" style="background-color: #adadad14;">
    <div class="main-wrapper main-wrapper-1 supreme-container">

        <div class="main-content">
            <section class="section">

                <div class="row px-3">
                    {{-- KPI CARDS (Matches existing dashboard look) --}}
                    <div class="col-12 d-flex" style="gap: 10px;">

                        <div class="card w-100 shadow" style="background-color:#EBF3FF;">
                            <a class="text-decoration-none text-black">
                                <div class="card-body d-flex flex-column">
                                    <img src="{{ asset('dash_icon/total_pending.png') }}" class="mb-2" style="width:30px;">
                                    <h5>{{ $totalpending }}</h5>
                                    <p class="font-weight-bold" style="color:#78ADF9;">{{ translate('Total Customers') }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="card w-100 shadow" style="background-color:#FCFBE0;">
                            <a class="text-decoration-none text-black">
                                <div class="card-body d-flex flex-column">
                                    <img src="{{ asset('dash_icon/average.png') }}" class="mb-2" style="width:30px;">
                                    <h5>{{ number_format($totalavgw, 2) }}</h5>
                                    <p class="font-weight-bold" style="color:#5E5E5D;">{{ translate('Average Revenue') }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="card w-100 shadow" style="background-color:#f7ebf4;">
                            <a class="text-decoration-none text-black">
                                <div class="card-body d-flex flex-column">
                                    <img src="{{ asset('dash_icon/average_daily.png') }}" class="mb-2" style="width:30px;">
                                    <h5>{{ $todaytotaloeder }}</h5>
                                    <p class="font-weight-bold" style="color:#6966F2;">{{ translate('Today Job Cards') }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="card w-100 shadow" style="background-color:#fcf5f5;">
                            <a class="text-decoration-none text-black">
                                <div class="card-body d-flex flex-column">
                                    <img src="{{ asset('dash_icon/rto.png') }}" class="mb-2" style="width:30px;">
                                    <h5>{{ $totalRTO }}</h5>
                                    <p class="font-weight-bold" style="color:#F96969;">{{ translate('Completed Jobs') }}</p>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

                <hr>

                <hr>

                {{-- FILTER FORM + PDF DOWNLOAD --}}
                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <form method="get" class="row align-items-end">

                            {{-- From Month --}}
                            <div class="col-auto">
                                <label class="fw-bold">{{ translate('From') }}</label>
                                <input type="month" name="rev_start" class="form-control" value="{{ $revStart }}">
                            </div>

                            {{-- To Month --}}
                            <div class="col-auto">
                                <label class="fw-bold">{{ translate('To') }}</label>
                                <input type="month" name="rev_end" class="form-control" value="{{ $revEnd }}">
                            </div>

                            {{-- Filter & Reset Buttons --}}
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-filter me-1">&nbsp</i>{{ translate('Filter') }}
                                </button>
                                <a href="{{ route('revenue.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-sync-alt me-1">&nbsp</i>{{ translate('Reset') }}
                                </a>
                            </div>

                            {{-- PDF Download Button --}}
                            <div class="col-auto ms-auto">
                                <a href="{{ route('revenue.download', ['rev_start' => request('rev_start'), 'rev_end' => request('rev_end')]) }}"
                                    class="btn btn-danger">
                                    <i class="fas fa-file-pdf me-1">&nbsp</i>{{ translate('Download PDF') }}
                                </a>
                            </div>

                        </form>
                    </div>
                </div>



                {{-- DATA + CHART --}}
                <div class="row mt-4">

                    {{-- Monthly Table --}}
                    <div class="col-lg-7 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="mb-0"><i class="fas fa-list-ul me-2">&nbsp</i>&nbsp {{ translate('Monthly Revenue') }}</h5>
                                <span class="grand-total-badge">{{ translate('Grand Total') }}: {{currency_symbol() .  number_format($revenueTotal,2) }}</span>
                            </div>

                            <div class="card-body p-0">
                                 <div class="table-responsive">

                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>{{ translate('Month') }}</th>
                                            <th class="text-end">{{ translate('Revenue') }} ({{currency_symbol()}})</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse(array_reverse($revMonths,true) as $month => $total)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($month.'-01')->format('F Y') }}</td>
                                            <td class="text-end fw-bold">{{ number_format($total, 2) }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="text-center py-4 text-muted">
                                               {{ translate(' No revenue found for selected range.') }}
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                            </div>
                        </div>
                    </div>

                    {{-- Chart --}}
                    <div class="col-lg-5 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-chart-line me-2">&nbsp</i>&nbsp {{ translate('Revenue Analytics') }}</h5>
                            </div>

                            <div class="card-body">
                                <canvas id="revenueChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

            </section>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = @json($revenueLabels);
    const data = @json($revenueData);

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue',
                data: data,
                borderColor: '#4A90E2',
                backgroundColor: 'rgba(74,144,226,0.2)',
                fill: true,
                tension: 0.4
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
</script>

@endsection
