<style type="text/css">
    .table.table-bordered td,
    .table.table-bordered th {
        text-align: center;
        vertical-align: middle;
        border-color: #f6f6f6;
    }

    .table.table-md th,
    .table.table-md td {
        padding: 5px;
    }

    .card-body strong {
    display: inline-block;
    width: 150px; /* adjust as needed */
}

</style>

{{-- {{ dd( $zone) }} --}}
@php
    $pickup = $picnodeData->firstWhere('pincode', $oripin);
    $delivery = $picnodeData->firstWhere('pincode', $destinpincode);
@endphp

<div class="card">
    <div class="card-body">
        <div class="row justify-content-center mx-2">
            <!-- Pickup Info -->
            <div class="col-md-4">
                <div class="mb-2">
                    <strong style="color: blue;">Pickup Pincode :</strong>
                    <span class="ms-2">{{ $delivery->pincode ?? 'N/A' }}</span>
                </div>
                <div class="mb-2">
                    <strong style="color: blue;">Pickup City :</strong>
                    <span class="ms-2">{{ $pickup->hubcity ?? 'N/A' }}</span>
                </div>
                <div class="mb-2">
                    <strong style="color: blue;">Pickup State :</strong>
                    <span class="ms-2">{{ $pickup->hubstate ?? 'N/A' }}</span>
                </div>
                <div class="mb-2">
                    <strong style="color: blue;">Region :</strong>
                    <span class="ms-2">{{ $pickup->hubzonename ?? 'N/A' }}</span>
                </div>
            </div>

            <!-- Gap between columns -->
            <div class="col-md-1"></div>

            <!-- Delivery Info -->
            <div class="col-md-4">
                <div class="mb-2">
                    <strong style="color: blue;">Delivery Pincode :</strong>
                    <span class="ms-2">{{ $delivery->pincode ?? 'N/A' }}</span>
                </div>
                <div class="mb-2">
                    <strong style="color: blue;">Delivery City :</strong>
                    <span class="ms-2">{{ $delivery->hubcity ?? 'N/A' }}</span>
                </div>
                <div class="mb-2">
                    <strong style="color: blue;">Delivery State :</strong>
                    <span class="ms-2">{{ $delivery->hubstate ?? 'N/A' }}</span>
                </div>
                <div class="mb-2">
                    <strong style="color: blue;">Zone :</strong>
                    <span class="ms-2">{{ $zone ?? 'N/A' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th></th>
                    <th>Courier</th>
                    <th>Mode</th>
                    <th>COD</th>
                    <th>Prepaid</th>
                    <th>Reverse</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{ dd($courierpermissions ) }} --}}
                @foreach ($courierpermissions as $courier)

                    <tr>
                        <td>
                            <img alt="courier_logo" height="45px" width="45px"
                                src="{{ asset('user/assets/img/courier_logo/' . $courier->courier_logo) }}">
                        </td>
                        <td>{{ $courier->courier_name }}</td>
                        <td>
                            @if ($courier->mode == 'Surface')
                                Surface
                                <img alt="Surface" height="10px" src="{{ asset('assets/images/icon/truck-solid.svg') }}">
                            @else
                                Air
                                <i class="fa fa-plane"></i>
                            @endif
                        </td>
                        <td>
                            @if ($courier->cod == 'Y')
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td>
                            @if ($courier->prepaid == 'Y')
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td>
                            @if ($courier->hasreversepickupservice == 'Y')

                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>