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

        tbody th,
        table.dataTable tbody td {
            padding: 0px 8px !important;
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

        .dataTables_length {
            margin-top: 15px !important;

        }

        th {
            text-align: center !important;
        }

        <style>.status-bar {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: -10px;
            /* space between counter and table */
            text-align: left;
            /* optional: show counter on right */
        }
    </style>


    </style>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="cancelPostOrder" method="POST">
                        @csrf
                        <input type="hidden" id="hiddenCancelid" name="ids[]">
                        <div class="form-group">
                            <label for="reason">Reason<span class="text-danger"> *</span></label>
                            <textarea name="reason" id="reason" class="form-control" minlength="1" maxlength="60" oninput="limitText(this)"
                                required></textarea>
                            <small id="charCount" class="text-muted">0 / 60</small>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                                            <h4 class="mb-0">Orders</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-header-form">
                                <div class=" text-right " style="margin-right:2% ;">
                                    @if (get_role(Auth::user()->usertype) == 1)
                                        <button type="button" name="submit" class="btn btn-outline-primary order_ship2"
                                            id=""><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                            Ship</button>
                                        {{-- onclick="check_id()" --}}
                                        <a href="{{ route('user.create-order-ship') }}" class="btn btn-outline-primary">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Create Order</a>



                                        <a href="#" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#exampleModalCenter200"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i> Bulk Upload</a>

                                        <a href="#" class="btn btn-outline-primary change_courier" data-toggle="modal"
                                            id="change_courier"><i class="fa fa-exchange" aria-hidden="true"></i> Change
                                            Courier
                                        </a>
                                    @endif
                                    <a href="javascript:void(0);" class="btn btn-outline-primary" id="cancelorderpop">
                                        <i class="fa fa-window-close-o" aria-hidden="true"></i> Cancel Order
                                    </a>

                                    <a href="javascript:void()"
                                        onclick="window.location.href='{{ route('user.upload-order') }}'"
                                        class="btn btn-outline-primary" type="reset"><i class="fa fa-refresh"
                                            aria-hidden="true"></i> Refresh &nbsp;</i></a>

                                    <a href="#" class="btn btn-outline-primary" onclick="myFunction()"><i
                                            class="fa fa-filter" aria-hidden="true"></i>&nbsp;Filter&nbsp;</i></a>

                                    <a href="javascript:void(0)"><button type="button" id="upload_report"
                                            name="upload_report" class="btn btn-outline-primary"><i
                                                class="fa fa-caret-square-o-up"
                                                aria-hidden="true"></i>&nbsp;Export&nbsp;</button></i></a>

                                    <a href="javascript:void(0)"
                                        onclick="window.location.href='{{ route('user.export-order') }}'"><button
                                            type="button" id="shipment_all_report" name="shipment_all_report"
                                            class="btn btn-outline-primary">&nbsp;Export All Status &nbsp;</button></i></a>

                                </div>

                            </div>
                            <div class="col-md-12 my-2 " id="myDIV" style="display: none;">
                                <div class="card  ">
                                    <div class="card-header">
                                        <h4>Filter</h4>
                                        <div class="card-header-action">
                                        </div>
                                    </div>
                                    <div class="card-body  " style="background-color: #bfbfbf;">
                                        <form class="order_filter" method="post" id="IdFilterData">
                                            {!! csrf_field() !!}
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label" style="color:#0d0d0d ;">Date Range</label>
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
                                                                <option value="CustomDateRange">Custom Date Range</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label" style="color:#0d0d0d ;">Source</label>
                                                    <div class="form-group">
                                                        <select class="form-control" id="source" name="source">
                                                            <option value="">Select</option>
                                                            <option value="2">Custom</option>
                                                            <option value="1">Channel</option>
                                                            <option value="0">Manual</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 my-2">
                                                    <label class="form-label"></label>
                                                    <div class="form-group" style="margin-top:1% ;">
                                                        <button type="button" class="btn btn-primary" id="filterButton">
                                                            Apply....</button>
                                                        {{-- <button type="button" class="btn btn-dark" id="Close">
                                                            Close....</button> --}}
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                      
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--- Change couirier parter-->
    <div class="modal fade" id="exampleModalCenter_Couriear" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="corier_form">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Change the Courier</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{--
                    <hr> --}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="courierSelect">Select Courier</label>
                            <select class="form-control select_corier" id="courierSelect" name="courier_id"></select>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->User_Id }}">
                        <input type="hidden" name="order_id" id="order_id">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <!-- <button type="button" class="btn btn-primary">Upload</button> -->
                        <input type="hidden" name="corier_id" id="corier_id">
                        {{-- <input type="hidden" name="order_id" id="order_id"> --}}
                        <input type="submit" class="btn btn-primary active" id="courier_update" name="courierUpdate"
                            value="Update">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bulkorder popup Center -->
   @endsection
