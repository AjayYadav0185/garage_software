@extends('user.dashboard.layout.master')
@section('user-contant')
    <style>
        .nav-pills .nav-item .nav-link:hover {
            background-color: #e2e60a;
            margin-left: 4px !important;
        }

        .theme-white .nav-pills .nav-link.active {
            color: #fff;
            background-color: #6777ef;
            margin-left: 4px !important;
        }

        .nav-pills .nav-item .nav-link {
            color: #6777ef;
            /* padding-left: 15px !important; */
            /* padding-right: 15px !important; */
            margin-left: 4px;
        }

        table.dataTable {
            width: 100% !important;
        }

        .aa {
            color: rgb(0, 32, 122);
        }

        .bb {
            color: rgb(0, 112, 192);
        }

        .cc {
            color: rgb(86, 131, 55);
        }

        .dd {
            color: rgb(255, 193, 3);
        }

        .ee {
            color: rgb(255, 0, 0);
        }

        .ff {
            color: rgb(64, 64, 64);
        }

        .gg {
            color: rgb(255, 0, 0);
        }

        .hh {
            color: rgb(255, 0, 0);
        }

        .ii {
            color: rgb(255, 220, 132);
        }

        .jj {
            color: rgb(84, 130, 53);
        }

        .kk {
            color: rgb(117, 62, 63);
        }

        .dhjvsdghv {
            min-width: 100px;
        }

        table thead tr th {
            min-width: 65px;
        }

        .Update_class {
            background-color: #93D9F1 !important;
            font-weight: 600;
        }


        .custom-file-input {

            opacity: 1 !important;
            border: 1px solid rgb(187 184 184);
            padding-top: 3px;
            padding-left: 4px;
        }

        .dataTables_length {
            margin-top: 15px !important;

        }

        th {
            text-align: center !important;
        }
    </style>

    <div class="main-content">
        <section class="section" style="margin-top:-34px;">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="display: block;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                                class="btn btn-primary go_forbtn"
                                                style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;"
                                                data-toggle="tooltip" data-placement="top" title="Go Back">
                                                <i class="fa-sharp fa fa-arrow-left"></i>
                                            </a>&nbsp;&nbsp;
                                            <h4 class="mb-0">NDR Management</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (get_role(Auth::user()->usertype) == 1)
                                <hr>
                                <div class="row p-3">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1" id="ndrCard" style="cursor: pointer;">
                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-left">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i>{{ $ndr ?? 0 }}
                                                        </h3>
                                                        <span class="text-muted">Total NDR</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1" id="delivered2Card" style="cursor: pointer;">
                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-left">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i>{{ $Reattempt ?? 0 }}
                                                        </h3>
                                                        <span class="text-muted">Reattempt Raised</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1" id="delivered3Card" style="cursor: pointer;">
                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-left">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i> {{ $ndr ?? 0 }}
                                                        </h3>
                                                        <span class="text-muted">NDR Instructions Pending</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1" id="delivered3PlusCard" style="cursor: pointer;">
                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-left">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i>
                                                            {{ $ndr_total_delivered }}
                                                        </h3>
                                                        <span class="text-muted">Total Delivered From NDR</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row px-3">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-left">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i>{{ $delivered_2nd }}
                                                        </h3>
                                                        <span class="text-muted">Delivered ( 2nd attempt )</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">

                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-left">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i> {{ $delivered_3rd }}
                                                        </h3>
                                                        <span class="text-muted">Delivered ( 3rd attempt )</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">

                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-left">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i> {{ $delivered_4plus }}
                                                        </h3>
                                                        <span class="text-muted">Delivered ( 3+ attempt )</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">

                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-left">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i>{{ $rto ?? 0 }}
                                                        </h3>
                                                        <span class="text-muted">RTO</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endif

                                <div class="card-header-form">
                                    <div class="text-right " style="margin-right:2% ;">

                                        @if (get_role(Auth::user()->usertype) == 1)
                                            <a href="#" class="btn btn-outline-primary" data-toggle="modal"
                                                data-target="#exampleModalCenter3001">
                                                <i class="fa fa-cloud-upload" aria-hidden="true"></i> Bulk Upload
                                            </a>
                                        @endif

                                        <a href="#" class="btn btn-outline-primary" onclick="myFunction()"><i
                                                class="fa fa-filter" aria-hidden="true"></i>&nbsp;Filter&nbsp;</i></a>
                                        <a href="javascript:void()"
                                            onclick="window.location.href='{{ route('user.ndr-management') }}'"
                                            class="btn btn-outline-primary" type="reset"><i class="fa fa-refresh"
                                                aria-hidden="true"></i>&nbsp;Refresh &nbsp;</i></a>
                                        <a href="javascript:void(0)"><button type="button" id="Export_report"
                                                name="Export_report" class="btn btn-outline-primary"><i
                                                    class="fa fa-caret-square-o-up"
                                                    aria-hidden="true"></i>&nbsp;Export&nbsp;</button></i></a>
                                    </div>
                                </div>



                                <div class="col-md-12 my-2 " id="myDIV" style="display: none;">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Filter</h4>
                                            <div class="card-header-action">
                                            </div>
                                        </div>
                                        <div class="card-body  " style="background-color: #bfbfbf;">
                                            <form class="order_filter" method="post" id="IdFilterData">
                                                {!! csrf_field() !!}
                                                <div class="row">
                                                    <div class="col-md-3  ">
                                                        <label class="form-label" style="color:#0d0d0d ;">Date
                                                            Range</label>
                                                        <div class="list-inline text-center">
                                                            <div class="form-group ">
                                                                <select class="form-control " id="date_range"
                                                                    name="date_range">
                                                                    <option value="">---Select Data Range---</option>
                                                                    <option value="today">Today</option>
                                                                    <option value="yesterday">Yesterday</option>
                                                                    <option value="-7 days">Last seven days </option>
                                                                    <option value="first day of">Current Month </option>
                                                                    <option value="-1 months">Last Month </option>
                                                                    <option value="All Time Order">All Time
                                                                    </option>
                                                                    <!-- <option value="CustomDateRange"data-toggle="modal" data-target="#myModal" >Custom Date Range</option> -->
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-3 ">
                                                    <label class="form-label" style="color:#0d0d0d ;">Customer Name</label>
                                                    <div class="input-group ">
                                                        <input type="text" id="customer_name" name="customer_name"
                                                            class="form-control " placeholder="Search by customer name"
                                                            name="Name">
                                                    </div>
                                                </div> --}}
                                                    {{-- <div class="col-md-3 ">
                                                    <label class="form-label" style="color:#0d0d0d ;">Order Id</label>

                                                    <div class="input-group ">
                                                        <input type="text" class="form-control "
                                                            placeholder="Search by Order Id" name="orderno" id="orderno">

                                                    </div>

                                                </div> --}}
                                                    {{-- <div class="col-md-3 ">
                                                    <label class="form-label" style="color:#0d0d0d ;">Mobile No</label>

                                                    <div class="input-group ">
                                                        <input type="text" class="form-control "
                                                            placeholder="Search by Mobile no" name="mobile" id="mobile">

                                                    </div>

                                                </div> --}}
                                                    {{-- <div class="col-md-3 ">
                                                    <label class="form-label" style="color:#0d0d0d ;">Product Name</label>
                                                    <div class="input-group ">
                                                        <input type="text" class="form-control "
                                                            placeholder="Search by Product name" name="item_name"
                                                            id="item_name">
                                                    </div>
                                                    <input type="hidden" name="tabtext34" id="tab_text" value="profile3">
                                                </div> --}}

                                                    <div class="col-md-2">
                                                        <label class="form-label" style="color:#0d0d0d;">Courier
                                                            Name</label>
                                                        <div class="form-group">
                                                            <select class="form-control" id="courier_id"
                                                                name="courier_id">
                                                                <option value="">Select Courier</option>
                                                                @foreach ($couriers as $courier)
                                                                    <option value="{{ $courier->id }}">
                                                                        {{ $courier->courier_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2" @if (get_role(Auth::user()->usertype) == 1) hidden @endif>
                                                        <label class="form-label" style="color:#0d0d0d;">Client
                                                            Wise</label>
                                                        <div class="list-inline text-center">
                                                            <div class="form-group">
                                                                <select class="form-control" id="client"
                                                                    name="client">
                                                                    <option value="">---Select Client Wise---
                                                                    </option>
                                                                    @foreach ($clientData as $dx)
                                                                        <option value="{{ $dx->User_Id }}">
                                                                            {{ mention_client_filter($dx) }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" style="color:#0d0d0d;">Payment
                                                            Mode</label>
                                                        <div class="form-group">
                                                            <select class="form-control" id="payment_mode"
                                                                name="payment_mode">
                                                                <option value="">Select</option>
                                                                <option value="Prepaid">Prepaid</option>
                                                                <option value="COD">COD</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label class="form-label" style="color:#0d0d0d;">Zone</label>
                                                        <div class="form-group">
                                                            <select class="form-control" id="zone" name="zone">
                                                                <option value="">Select</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-2">
                                                    <label class="form-label" style="color:#0d0d0d;">Mode</label>
                                                    <div class="form-group">
                                                        <select class="form-control" id="mode" name="mode">
                                                            <option value="">Select</option>
                                                            <option value="Surface">Surface</option>
                                                            <option value="Air">Air</option>
                                                        </select>
                                                    </div>
                                                </div> --}}

                                                    <div class="col-md-3 my-2">
                                                        <label class="form-label"></label>
                                                        <div class="form-group" style="margin-top:1% ;">
                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="filterButton"> Apply....</button>
                                                        </div>

                                                    </div>

                                                </div>
                                            </form>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#date_range').change(function() {
                                                        var opval = $(this).val();
                                                        if (opval == "CustomDateRange") {
                                                            $('#myModal').modal("show");
                                                        }
                                                    });
                                                });
                                            </script>
                                            <!-- modal open  costum rate range -->
                                            <div class="modal fade costum_modalcss" id="myModal" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"> </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="to_date">From Date<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control"
                                                                        id="from_date" name="from_date" required>
                                                                    <input type="text" id="custum_hid_id"
                                                                        value="profile3" name="tabtext34">

                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="to_date">To Date<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control"
                                                                        id="to_date" name="to_date" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="button" id=""
                                                                class="btn btn-primary shipment_custom">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- close modal -->
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link class_check active" id="all-tab" data-toggle="tab"
                                                href="#all" role="tab" aria-controls="all"
                                                aria-selected="true">All</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link class_check" id="action-required-tab" data-toggle="tab"
                                                href="#action-required" role="tab" aria-controls="action-required"
                                                aria-selected="false">Action Required</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link class_check" id="action-taken-tab" data-toggle="tab"
                                                href="#action-taken" role="tab" aria-controls="action-taken"
                                                aria-selected="false">Action Taken</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link class_check" id="rto-tab" data-toggle="tab"
                                                href="#rto" role="tab" aria-controls="rto"
                                                aria-selected="false">RTO</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link class_check" id="delivered-tab" data-toggle="tab"
                                                href="#delivered" role="tab" aria-controls="delivered"
                                                aria-selected="false">Delivered</a>
                                        </li>
                                    </ul>

                                    @php
                                        $tabs = [
                                            'all' => [
                                                'label' => 'All',
                                                'tableId' => 'profile3-table',
                                                'actionColumn' => 'Action Taken',
                                            ],
                                            'action-required' => [
                                                'label' => 'Action Required',
                                                'tableId' => 'action_required',
                                                'actionColumn' => 'Action Reattempt | RTO',
                                            ],
                                            'action-taken' => [
                                                'label' => 'Action Taken',
                                                'tableId' => 'action_taken',
                                                'actionColumn' => 'Action Taken',
                                            ],
                                            'rto' => [
                                                'label' => 'RTO',
                                                'tableId' => 'rto_list',
                                                'actionColumn' => 'Action Taken',
                                            ],
                                            'delivered' => [
                                                'label' => 'Delivered',
                                                'tableId' => 'ndr_delivered',
                                                'actionColumn' => 'Action Taken',
                                            ],
                                        ];

                                        $columns = [
                                            'AWB Number <br> Oredr ID',
                                            'First NDR Reason <br> NDR Date',
                                            'Last NDR Reason <br> NDR Date',
                                            'Pending Days',
                                            'Attempts',
                                            'Product Name',
                                            'Payment Type <br> Order Amount',
                                            'Customer Name',
                                            // Action column inserted dynamically
                                            'Status',
                                        ];
                                    @endphp

                                    <div class="tab-content excel" id="myTabContent2" style="text-align: center;">
                                        @foreach ($tabs as $id => $tab)
                                            <div class="tab-pane fade my-2 {{ $loop->first ? 'show active' : '' }}"
                                                id="{{ $id }}" role="tabpanel"
                                                aria-labelledby="{{ $id }}-tab">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered"
                                                        id="{{ $tab['tableId'] }}">
                                                        <thead>
                                                            <tr>
                                                                @foreach (array_slice($columns, 0, 8) as $col)
                                                                    <th>{!! $col !!}</th>
                                                                @endforeach

                                                                @if (get_role(Auth::user()->usertype) == 1)
                                                                    <th>{{ $tab['actionColumn'] }}</th>
                                                                @else
                                                                    <th>Client Name</th>
                                                                @endif
                                                                <th>{{ $columns[8] }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="tbodyfiltr_data"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- address --}}
        <div class="modal fade" id="rtoModal" tabindex="-1" role="dialog" aria-labelledby="rtoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="rtoForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rtoModalLabel">Reattempt Order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="orderno" id="modal_orderno">
                            {{-- <input type="hidden" name="status" id="modal_status" value="0"> --}}
                            <!-- Customer Name -->
                            <div class="form-group">
                                <label for="val-username">Name <span class="text-danger">*</span></label>
                                <input type="text" id="val-username" name="name" class="form-control"
                                    placeholder="Enter Customer name" required maxlength="30">
                            </div>

                            <!-- Mobile Number -->
                            <div class="form-group">
                                <label for="modal_mobile">Mobile <span class="text-danger">*</span></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">+91</div>
                                    </div>
                                    <input type="text" class="form-control" name="mobile" id="modal_mobile"
                                        maxlength="10" required>
                                </div>
                            </div>

                            <!-- Alternate Mobile -->
                            {{-- <div class="form-group">
                                <label for="password">Alternate Mobile</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">+91</div>
                                    </div>
                                    <input type="number" id="modal_mobile2" name="modal_mobile2"
                                        class="form-control contactvalid" placeholder="Enter Mobile" maxlength="10">
                                </div>
                            </div> --}}

                            <!-- Pincode -->
                            {{-- <div class="form-group">
                                <label for="destinationpincode">Pincode <span class="text-danger">*</span></label>
                                <input type="text" id="destinationpincode" name="pin" class="form-control"
                                    placeholder="Enter Customer Pincode" required maxlength="6"
                                    onblur="despindetails(this.value)">
                            </div> --}}

                            <!-- City -->
                            {{-- <div class="form-group">
                                <label for="customer-city">City <span class="text-danger">*</span></label>
                                <input type="text" id="destinationpin-city" name="city" class="form-control"
                                    placeholder="Enter Customer City" required readonly>
                            </div> --}}

                            <!-- State -->
                            {{-- <div class="form-group">
                                <label for="customer-state">State <span class="text-danger">*</span></label>
                                <input type="text" id="customer-state" name="state" class="form-control"
                                    placeholder="Enter Customer State" required readonly>
                            </div> --}}

                            <!-- Address -->
                            <div class="form-group">
                                <label for="email">Address1 <small class="text-danger">*(Max 60
                                        characters)</small></label>
                                <input type="text" id="Address" name="address" class="form-control" maxlength="60"
                                    placeholder="Enter Customer Address" required>
                            </div>

                            <!-- Address 2 -->
                            <div class="form-group">
                                <label for="address_sec">Address2</label>
                                <input type="text" id="Address2" name="Address2" class="form-control"
                                    maxlength="60" placeholder="Enter Customer Address">
                            </div>

                            <!-- Landmark -->
                            {{-- <div class="form-group">
                                <label for="landmarks">Landmark</label>
                                <input type="text" id="landmarks" name="landmarks" class="form-control"
                                    placeholder="Enter Customer Landmark" maxlength="60">
                            </div> --}}
                            <!-- Reattempt Remark (Will be used based on current attempt) -->
                            <div class="form-group">
                                <label for="ndr_remark">Reattempt Remark</label>
                                <textarea id="ndr_remark" name="ndr_remark" class="form-control" rows="2" maxlength="255"
                                    placeholder="Enter Remark for this Reattempt"></textarea>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update & Reattempt</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCenter3001" tabindex="-1" role="dialog"
            aria-labelledby="rtoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-toggle="modal"
                            data-target="#exampleModalCenter3001" style="position:absolute; top:15px; right:15px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user.bulkndrordersave') }}" enctype="multipart/form-data" method="POST">
                        {!! csrf_field() !!}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">UPLOAD BULK NDR AND RTO</h5>

                        </div>
                        <div class="modal-body">
                            {{-- <h6>Download Sample order file: <a href="{{ route('user.bulkUploadSampleNdr') }}">Download</a> --}}
                            </h6>
                            <hr>
                            <div class="form-group custom-file">
                                <input type="hidden" name="selectedweightidis" value="{{ Auth::user()->User_Id }}">
                                <input type="file" name="bulkorderfile" required=""
                                    onchange="inputfile500gm(this)" class="custom-file-input form-control-file"
                                    id="customFile">
                            </div>
                            <div class="form-group">
                                <label>1. Please fill all mandatory fields.<span class="text-danger">*</span></label>
                                {{-- <label>2. Please remove sample data before proceeding.<span
                                        class="text-danger">*</span></label> --}}
                                <label>2. Don't leave any blank row in between data.</label>
                                {{-- <label>4. Each address field needs 60 characters max for Amazon uploads.</label> --}}
                                {{-- <label>5. Upload file in CSV or Excel format.</label> --}}
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <input type="hidden" name="selectedweightidis" value="{{ Auth::user()->User_Id }}">
                            <input type="submit" class="btn btn-primary active" name="importSubmit5gm" value="Upload"
                                title="Please Select Upload File" id="inputsubmits500gm">
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulkorder popup Center -->
    {{-- <script>
        @if (session('scount') || session('count'))
            var msg = `Total records imported successfully: <span style='color:green;'><b>{{ session('scount') }}</b></span><br>
                                            Failed records: <span style='color:red;'><b>{{ session('count') }}</b></span>`;
            @if (session('count') > 0)
                msg += `<br><a href="{{ route('user.failed') }}" class="btn btn-danger mt-2">Download Failed Rows</a>`;
            @endif
            Swal.fire({
                icon: 'info',
                title: 'Upload Result',
                html: msg
            });
        @endif
    </script> --}}

    <script>
        @if (session('scount') || session('count'))
            let msg = `
        <b style="color:green;">✅ Successful: {{ session('scount') }}</b><br>
        <b style="color:red;">❌ Failed: {{ session('count') }}</b>`;

            @if (session('count') > 0)
                msg += `<br><a href="{{ route('user.failed') }}" class="btn btn-danger mt-3">Download Failed Rows</a>`;
            @endif

            Swal.fire({
                title: 'Upload Summary',
                icon: 'info',
                html: msg,
                confirmButtonText: 'OK'
            });
        @endif
    </script>


    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            var _ = $('body');
            var createRecord = 'Are you sure you want to save the record?';
            var updateRecord = 'Are you sure you want to modify this record?';
            var deleteRecord = 'Are you sure you want to delete this record?';

            $('#filterButton').click(function() {
                table1.ajax.reload();
                table2.ajax.reload();
                table3.ajax.reload();
                table4.ajax.reload();
                table5.ajax.reload();
            });

            var table1 = $('#profile3-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Transaction ID."
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.ndr-list-ajaxcall') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.courier_id = $('#courier_id').val();
                        d.client = $('#client').val();
                        d.payment_mode = $('#payment_mode').val();
                        d.zone = $('#zone').val();
                        d.mode = $('#mode').val();
                        d.date_range = $('#date_range').val();
                    }
                },
                columns: [{
                        data: 'orderno',
                        orderable: true
                    },
                    {
                        data: 'first_ndr_reason_date',
                        orderable: true
                    },
                    {
                        data: 'last_ndr_reason_date',
                        orderable: true
                    },
                    {
                        data: 'pending_days',
                        orderable: true
                    },
                    {
                        data: 'attempts',
                        orderable: true
                    },
                    {
                        data: 'product_name',
                        orderable: true
                    },
                    {
                        data: 'payment_and_amount',
                        orderable: true
                    },
                    {
                        data: 'customer_name',
                        orderable: true
                    },

                    @if (get_role(Auth::user()->usertype) == 1)
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        },
                    @else
                        {
                            data: 'client_name',
                            orderable: false
                        },
                    @endif {
                        data: 'status',
                        orderable: true
                    }
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
                order: [
                    [0, 'DESC']
                ]


            });



            var table2 = $('#action_required').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By AWB No."
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.action_required') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.courier_id = $('#courier_id').val();
                        d.client = $('#client').val();
                        d.payment_mode = $('#payment_mode').val();
                        d.zone = $('#zone').val();
                        d.mode = $('#mode').val();
                        d.date_range = $('#date_range').val();
                    }
                },
                columns: [{
                        data: 'orderno',
                        orderable: true
                    },
                    {
                        data: 'first_ndr_reason_date',
                        orderable: true
                    },
                    {
                        data: 'last_ndr_reason_date',
                        orderable: true
                    },
                    {
                        data: 'pending_days',
                        orderable: true
                    },
                    {
                        data: 'attempts',
                        orderable: true
                    },
                    {
                        data: 'product_name',
                        orderable: true
                    },
                    {
                        data: 'payment_and_amount',
                        orderable: true
                    },
                    {
                        data: 'customer_name',
                        orderable: true
                    },

                    @if (get_role(Auth::user()->usertype) == 1)
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        },
                    @else
                        {
                            data: 'client_name',
                            orderable: false
                        },
                    @endif {
                        data: 'status',
                        orderable: true
                    }
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
                order: [
                    [0, 'DESC']
                ]
            });



            var table3 = $('#action_taken').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By AWB No."
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.action_taken') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.courier_id = $('#courier_id').val();
                        d.client = $('#client').val();
                        d.payment_mode = $('#payment_mode').val();
                        d.zone = $('#zone').val();
                        d.mode = $('#mode').val();
                        d.date_range = $('#date_range').val();
                    }
                },
                columns: [{
                        data: 'orderno',
                        orderable: true
                    },
                    {
                        data: 'first_ndr_reason_date',
                        orderable: true
                    },
                    {
                        data: 'last_ndr_reason_date',
                        orderable: true
                    },
                    {
                        data: 'pending_days',
                        orderable: true
                    },
                    {
                        data: 'attempts',
                        orderable: true
                    },
                    {
                        data: 'product_name',
                        orderable: true
                    },
                    {
                        data: 'payment_and_amount',
                        orderable: true
                    },
                    {
                        data: 'customer_name',
                        orderable: true
                    },

                    @if (get_role(Auth::user()->usertype) == 1)
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        },
                    @else
                        {
                            data: 'client_name',
                            orderable: false
                        },
                    @endif {
                        data: 'status',
                        orderable: true
                    }
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
                order: [
                    [0, 'DESC']
                ]
            });



            var table4 = $('#rto_list').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By AWB No."
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.rto_list') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.courier_id = $('#courier_id').val();
                        d.client = $('#client').val();
                        d.payment_mode = $('#payment_mode').val();
                        d.zone = $('#zone').val();
                        d.mode = $('#mode').val();
                        d.date_range = $('#date_range').val();

                    }
                },
                columns: [{
                        data: 'orderno',
                        orderable: true
                    },
                    {
                        data: 'first_ndr_reason_date',
                        orderable: true
                    },
                    {
                        data: 'last_ndr_reason_date',
                        orderable: true
                    },
                    {
                        data: 'pending_days',
                        orderable: true
                    },
                    {
                        data: 'attempts',
                        orderable: true
                    },
                    {
                        data: 'product_name',
                        orderable: true
                    },
                    {
                        data: 'payment_and_amount',
                        orderable: true
                    },
                    {
                        data: 'customer_name',
                        orderable: true
                    },

                    @if (get_role(Auth::user()->usertype) == 1)
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        },
                    @else
                        {
                            data: 'client_name',
                            orderable: false
                        },
                    @endif {
                        data: 'status',
                        orderable: true
                    }
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
                order: [
                    [0, 'DESC']
                ]
            });


            var table5 = $('#ndr_delivered').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By AWB No."
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.ndr_delivered') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.courier_id = $('#courier_id').val();
                        d.client = $('#client').val();
                        d.payment_mode = $('#payment_mode').val();
                        d.zone = $('#zone').val();
                        d.mode = $('#mode').val();
                        d.date_range = $('#date_range').val();

                    }
                },
                columns: [{
                        data: 'orderno',
                        orderable: true
                    },
                    {
                        data: 'first_ndr_reason_date',
                        orderable: true
                    },
                    {
                        data: 'last_ndr_reason_date',
                        orderable: true
                    },
                    {
                        data: 'pending_days',
                        orderable: true
                    },
                    {
                        data: 'attempts',
                        orderable: true
                    },
                    {
                        data: 'product_name',
                        orderable: true
                    },
                    {
                        data: 'payment_and_amount',
                        orderable: true
                    },
                    {
                        data: 'customer_name',
                        orderable: true
                    },

                    @if (get_role(Auth::user()->usertype) == 1)
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        },
                    @else
                        {
                            data: 'client_name',
                            orderable: false
                        },
                    @endif {
                        data: 'status',
                        orderable: true
                    }
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
                order: [
                    [0, 'DESC']
                ]
            });


            $('.tab_change').click(function() {
                var tabname = $(this).attr('data-tab');
                var tabstatus = $(this).attr('data-status');
                $('#order_status1').val(tabname);
                $('#shipstatus').val(tabstatus);

                if (tabname == '') {
                    $('.custom-checkbox').hide();
                } else {
                    $('.custom-checkbox').show();
                }
                table.ajax.reload();
                $('.tab_change').removeClass('active');
                $(this).addClass('active');
            });


            // $("#Export_report").click(function () {
            //     alert("1");
            //     var activeTabId = $('.nav-item .active').attr('id');
            //     var tableId = (activeTabId === 'contact-tab6') ? 'failed_table' : 'profile3-table';
            //     var date_range = $('#date_range').val() || "All Time Order";
            //     if (date_range) {
            //         var exportUrl = `{{ route('user.export_wallet') }}?date_range=${date_range}&tableId=${tableId}`;
            //         console.log("Redirecting to:", exportUrl);
            //         window.location.href = exportUrl;
            //     } else {
            //         Swal.fire({
            //             icon: 'error',
            //             title: 'Error!',
            //             text: 'Please Select Date Range',
            //             width: '400px',
            //         });
            //     }
            // });

            var today = new Date().toISOString().split('T')[0];
            $('#from_date').attr('max', today);
            $('#to_date').attr('max', today);

            $('#date_range').change(function() {
                if ($(this).val() == 'CustomDateRange') {
                    $('#custom_date_from').removeClass('d-none');
                    $('#custom_date_to').removeClass('d-none');
                } else {
                    $('#custom_date_from').addClass('d-none');
                    $('#custom_date_to').addClass('d-none');
                }
            });
        });
    </script>


    <script>
        const cardToTableMap = {
            'ndrCard': 'table-ndr',
            'delivered2Card': 'table-delivered-2',
            'delivered3Card': 'table-delivered-3',
            'delivered3PlusCard': 'table-delivered-3plus'

        };

        Object.keys(cardToTableMap).forEach(cardId => {
            document.getElementById(cardId).addEventListener("click", function() {
                // Hide all tables
                Object.values(cardToTableMap).forEach(tableId => {
                    document.getElementById(tableId).style.display = "none";
                });

                // Show the clicked one
                const selectedTableId = cardToTableMap[cardId];
                document.getElementById(selectedTableId).style.display = "block";

                // Scroll into view (optional)
                document.getElementById(selectedTableId).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

    <script>
        $(document).on('click', '.rto', function() {
            var orderno = $(this).attr('data_att');
            $('#modal_orderno').val(orderno);
            $.ajax({
                url: "{{ route('user.getOrderDetails') }}",
                type: 'GET',
                data: {
                    orderno: orderno
                },
                success: function(response) {
                    console.log(response);
                    $('#modal_orderno').val(response.orderno);
                    $('#val-username').val(response.Name);
                    $('#modal_mobile').val(response.mobile);
                    $('#password').val(response.alt_mobile);
                    $('#destinationpincode').val(response.Pincode);
                    $('#customer-city').val(response.city);
                    $('#customer-state').val(response.state);
                    $('#Address').val(response.Address);
                    $('#Address2').val(response.Address2);
                    $('#landmarks').val(response.landmark);
                }
            });
        });

        // $('#rtoForm').on('submit', function (e) {
        //     e.preventDefault();
        //     let formData = $(this).serialize();
        //     $.ajax({
        //         url: "{{ route('user.updateReattempt') }}",
        //         type: 'POST',
        //         data: formData,
        //         success: function (response) {
        //             if (response.success) {
        //                 alert(response.msg);
        //                 $('#rtoModal').modal('hide');
        //                 location.reload(); 
        //             } else {
        //                 Swal.fire({
        //                         icon: 'error',
        //                         title: 'Error!',
        //                         text: response.msg,
        //                     });
        //                 alert('Failed to update order details.');
        //             }
        //         }
        //     });
        // });


        $('#rtoForm').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('user.updateReattempt') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        let updatedFields = response.updated_values;
                        let updatedMsg = '';

                        Object.keys(updatedFields).forEach(field => {
                            updatedMsg += `${field}: ${updatedFields[field]}\n`;
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: updatedMsg || 'No values were changed.',
                        });

                        $('#rtoModal').modal('hide');
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.msg,
                        });
                    }
                }
            });
        });

        function myFunction5(id) {
            var checkboxItem = '#' + id + ' th input[type="checkbox"]';
            if ($(checkboxItem).is(':checked')) {
                $("#" + id + " .abc").each(function() {
                    this.checked = true;
                });
            } else {
                $("#" + id + " .abc").each(function() {
                    this.checked = false;
                });
            }
        }
        $(document).on('click', '.abc', function() {
            var table_id = $(this).parents('table').attr('id');
            if ($("#" + table_id + " .abc:checked").length == $("#" + table_id + " .abc").length) {
                $('#' + table_id + ' th input[type="checkbox"]').prop('checked', true);
            } else {
                $('#' + table_id + ' th input[type="checkbox"]').prop('checked', false);
            }
        });

        function check_id() {
            dd = $('.nav-item .active').attr('id');
            var x = $('.abc').parents('table').attr('id');
            var y = $('.def').parents('table').attr('id');
            a = dd == 'contact-tab6' ? y : '';
            b = dd == 'profile-tab3' ? x : '';
            var url = "{{ route('user.place-order') }}";
            if (a == 'failed') {
                manageOrder(a, 'Please Select Order', url);
            }
            if (b == 'profile3-table') {
                manageOrder(b, 'Please Select Order', url);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            var _ = $('body');
            var createRecord = 'Are you sure you want to save the record?';
            var updateRecord = 'Are you sure you want to modify this record?';
            var deleteRecord = 'Are you sure you want to delete this record?';

            var tableNdr = $('#profile3-table111').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user.ndr-list-ajaxcall') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.status = $('#order_status1').val();
                        d.customer_name = $('#customer_name').val();
                        d.orderno = $('#orderno').val();
                        d.mobile = $('#mobile').val();
                        d.item_name = $('#item_name').val();
                        d.paymentmode = $('#paymentmode').val();
                        d.date_range = $('#date_range').val();
                    }
                },
                columns: [{
                        data: 'orderno',
                        orderable: true
                    },
                    {
                        data: 'order_status_show',
                        orderable: true
                    },
                    {
                        data: 'Rec_Time_Stamp',
                        orderable: true
                    },
                    {
                        data: 'Item_Name',
                        orderable: true
                    },
                    {
                        data: 'Name',
                        orderable: true
                    },
                    {
                        data: 'courier_name',
                        orderable: false
                    },
                    {
                        data: 'City',
                        orderable: true
                    },
                    {
                        data: 'Pincode',
                        orderable: true
                    },
                    {
                        data: 'Order_Type',
                        orderable: true
                    },
                    {
                        data: 'Invoice_Value',
                        orderable: true
                    },
                    {
                        data: 'Actual_Weight',
                        orderable: true
                    },
                    {
                        data: 'order_status1',
                        orderable: true
                    },
                    {
                        data: 'edit',
                        orderable: false
                    },
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
                order: [
                    [2, 'DESC']
                ]
            });
            $('#filterButton').click(function() {
                tableNdr.ajax.reload();
            });
            var tableReattempt = $('#ReattemptListAjaxCall').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user.reattempt-list-ajax') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.status = $('#order_status1').val();
                        d.customer_name = $('#customer_name').val();
                        d.orderno = $('#orderno').val();
                        d.mobile = $('#mobile').val();
                        d.item_name = $('#item_name').val();
                        d.paymentmode = $('#paymentmode').val();
                        d.date_range = $('#date_range').val();
                    }
                },
                columns: [{
                        data: 'orderno',
                        orderable: true
                    },
                    {
                        data: 'order_status_show',
                        orderable: true
                    },
                    {
                        data: 'Rec_Time_Stamp',
                        orderable: true
                    },
                    {
                        data: 'reattempt_date',
                        orderable: true
                    },
                    {
                        data: 'Item_Name',
                        orderable: true
                    },
                    {
                        data: 'Name',
                        orderable: true
                    },
                    {
                        data: 'courier_name',
                        orderable: false
                    },
                    {
                        data: 'City',
                        orderable: true
                    },
                    {
                        data: 'Pincode',
                        orderable: true
                    },
                    {
                        data: 'Order_Type',
                        orderable: true
                    },
                    {
                        data: 'Invoice_Value',
                        orderable: true
                    },
                    {
                        data: 'Actual_Weight',
                        orderable: true
                    },
                    {
                        data: 'order_status1',
                        orderable: true
                    },
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
                order: [
                    [2, 'DESC']
                ]
            });
            $('#filterButton').click(function() {
                tableReattempt.ajax.reload();
            });
            $('.tab_change').click(function() {
                var tabname = $(this).attr('data-tab');
                var tabstatus = $(this).attr('data-status');
                $('#order_status1').val(tabname);
                $('#shipstatus').val(tabstatus);
                table.ajax.reload();
                $('.tab_change').removeClass('active');
                $(this).addClass('active');
            });


            $('body').on('click', '.reattempt', function() {
                var order_idship = $(this).attr('data_att');
                var myCheckboxes = new Array();
                myCheckboxes.push(order_idship);
                alert(order_idship);
                Swal.fire({
                    title: "Please wait...",
                    html: "Order reattempt is in progress."
                })
                Swal.showLoading();
                $.ajax({
                    type: "POST",
                    url: "{{ route('user.oredr_rto') }}",
                    data: {
                        myCheckboxes: myCheckboxes,
                        status: 0
                    },
                    success: function(response) {

                        if (response.success == true) {
                            Swal.fire({
                                icon: 'success',
                                text: response.msg,
                            }).then(function() {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.msg,
                            });
                        }
                    }
                });
            });



            $("#Export_report").click(function() {
                var activeCardId = $('.tab-pane:visible').attr('id');
                let tableId = activeCardId;
                let courier_id = $('#courier_id').val();
                let client = $('#client').val();
                let payment_mode = $('#payment_mode').val();
                let zone = $('#zone').val();

                // alert(tableId);
                var date_range = $('#date_range').val() || "All Time Order";

                if (date_range) {
                    var exportUrl =
                        `{{ route('user.export_ndr') }}?date_range=${date_range}&courier_id=${courier_id}&client=${client}&payment_mode=${payment_mode}&zone=${zone}&tableId=${tableId}`;
                    window.location.href = exportUrl;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please Select Date Range',
                        width: '400px',
                    });
                }
            });

        });
    </script>
@endsection
