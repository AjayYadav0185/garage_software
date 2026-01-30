@extends('user.dashboard.layout.master')
@section('user-contant')

    <div class="loader"></div>
    {{-- {{ dd($data, $rem_data) }} --}}

    <div class="main-content supreme-container">
        <section class="section pt-3">
            <div class="section-body">
                {{-- <h4>Transaction Details</h4> --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                        class="btn btn-primary" style="border-radius: 5px; padding: 0.3rem 0.8rem;"
                                        data-toggle="tooltip" data-placement="top" title="Go Back">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                    <h4 class="mb-0 ms-2">Transaction Details</h4>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @php
                            $status = $rem_data->status;
                        @endphp
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header pb-1">
                                        <h5 class="mb-0">
                                            Remittance Details
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <h6 style="color: blue;">{{ $rem_data->uniqueidno }}</h6>
                                        <div class="card my-3">
                                            <div class="card-body">
                                                <h5>Remittance Summary @if ($status == '1')
                                                    <span class="badge bg-success" style="color: white;">Complete</span>
                                                @else
                                                        <span class="badge bg-danger" style="color: white;">Incomplete</span>
                                                    @endif
                                                </h5>
                                                <div class="row mt-3">
                                                    <div class="col-md-12 text-center">
                                                        <h6>Remittance Amount </h6>
                                                        <h4 class="text-success">{{currency_symbol() .  $rem_data->totalamount }}</h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <h6>Total Orders</h6>
                                                        <p>{{ $data->count() }}</p>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <h6>Remittance Date</h6>
                                                        <p>{{ date('d-m-Y', strtotime($rem_data->daytorelease)) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="mb-3">AWB Numbers</h5>
                                                <table class="table table-bordered">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>AWB Number</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data as $item)
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('user.status-tracking', ['awbno' => $item->orderno]) }}"
                                                                        style="text-decoration: none; color: blue;">
                                                                        {{ $item->orderno }}
                                                                    </a>
                                                                </td>

                                                                <td>{{currency_symbol() .  $item->Cod_Amount }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div> <!-- end card-body -->
                                </div>
                            </div>
                        </div> <!-- end row -->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end section-body -->
        </section>
    </div>


@endsection