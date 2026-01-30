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
                                            <h4 class="mb-0">Wallet</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="row p-2">
                                    <div class="col-md-12 my-1 d-flex align-items-center">
                                        <!-- Recharge Now Button -->
                                        <!-- Current Balance -->
                                        <div style="margin-left: 20px;">
                                            <i class="fas fa-wallet my-1"
                                                style="color:blue; border-radius: 50%; background-color: white; font-size: 20px;"></i>
                                            <span style="font-size: 15px;">
                                                <strong style="font-size: 12px;">Current Balance</strong>
                                                &nbsp;{{currency_symbol()}}&nbsp;{{$walletAmt}}
                                            </span>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="my-1">
                                            <button type="button" class="btn text-white"
                                                style="background-color:#00cc00; border-radius: 5%;" data-toggle="modal"
                                                data-target="#basicModal">
                                                Recharge Now
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-header-form">
                                <div class=" text-right " style="margin-right:2% ;">
                                    <a href="javascript:void()"
                                        onclick="window.location.href='{{route('user.add-balance')}}'"
                                        class="btn btn-outline-primary" type="reset"><i class="fa fa-refresh"
                                            aria-hidden="true"></i>&nbsp;Refresh &nbsp;</i></a>

                                    <a href="#" class="btn btn-outline-primary" onclick="myFunction()"><i
                                            class="fa fa-filter" aria-hidden="true"></i>&nbsp;Filter&nbsp;</i></a>

                                    <a href="javascript:void(0)"><button type="button" id="upload_report"
                                            name="upload_report" class="btn btn-outline-primary"><i
                                                class="fa fa-caret-square-o-up"
                                                aria-hidden="true"></i>&nbsp;Export&nbsp;</button></i></a>
                                </div>
                            </div>
                            <div class="col-md-12 my-2 " id="myDIV" style="display: none;">
                                <div class="card  ">
                                    <div class="card-header">
                                        <h4>Filter</h4>
                                        <div class="card-header-action">
                                        </div>
                                    </div>
                                    <div class="card-body" style="background-color: #bfbfbf;">
                                        <form class="order_filter" method="post" id="IdFilterData">
                                            {!! csrf_field() !!}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="color:#0d0d0d ;">Date Range</label>
                                                    <div class="list-inline text-center">
                                                        <div class="form-group ">
                                                            <select class="form-control " id="date_range" name="date_range">
                                                                <option value="">---Select Data Range---</option>
                                                                <option value="today">Today</option>
                                                                <option value="yesterday">Yesterday</option>
                                                                <option value="-7 days">Last seven days </option>
                                                                <option value="first day of">Current Month </option>
                                                                <option value="-1 months">Last Month </option>
                                                                <option value="All Time Order">All Time</option>
                                                                <option value="CustomDateRange">Custom Date Range</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- For Custom Date -->
                                                <div class="col-md-4 d-none" id="custom_date_from">
                                                    <label class="form-label" style="color:#0d0d0d;" for="from_date">From
                                                        Date</label>
                                                    <input type="date" class="form-control" id="from_date" name="from_date">
                                                </div>

                                                <div class="col-md-4 d-none" id="custom_date_to">
                                                    <label class="form-label" style="color:#0d0d0d;" for="to_date">To
                                                        Date</label>
                                                    <input type="date" class="form-control" id="to_date" name="to_date">
                                                </div>
                                                <!-- For Custom Date -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1 my-2">
                                                    <label class="form-label"></label>
                                                    <div class="form-group" style="margin-top:1% ;">
                                                        <button type="button" class="btn btn-primary" id="filterButton">
                                                            Apply....</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link class_check active" id="profile-tab3" data-toggle="tab"
                                            href="#profile3" role="tab" aria-controls="profile"
                                            aria-selected="false">Recharge History</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link class_check" id="contact-tab6" data-toggle="tab" href="#contact5"
                                            role="tab" aria-controls="contact5" aria-selected="false">Shipment
                                            Transaction</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link class_check" id="contact-tab7" data-toggle="tab" href="#contact6"
                                            role="tab" aria-controls="contact6" aria-selected="false"
                                            onclick="exporthide(false)">Credit
                                            Transaction</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link class_check" id="contact-tab8" data-toggle="tab" href="#contact7"
                                            role="tab" aria-controls="contact7" aria-selected="false"
                                            onclick="exporthide(false)">Debit
                                            Transaction</a>
                                    </li>

                                </ul>
                                <div class="tab-content excel" id="myTabContent2" style="text-align: center;">
                                    <div class="tab-pane fade show active my-2" id="profile3" role="tabpanel"
                                        aria-labelledby="profile-tab3">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="profile3-table">
                                                <thead>
                                                    <tr>
                                                        <th>Date/Time</th>
                                                        {{-- <th>AWB</th> --}}
                                                        <th>Transaction ID</th>
                                                        <th>Bank Transaction ID</th>
                                                        <th>Amount</th>
                                                        <th>Remark</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbodyfiltr_data"></tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- 2nd --}}
                                    <div class="tab-pane fade show my-2" id="contact5" role="tabpanel"
                                        aria-labelledby="contact-tab6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="failed_table">
                                                <thead>
                                                    <tr>
                                                        <th>Date/Time</th>
                                                        <th>Order ID <br> AWB</th>
                                                        <th>Courier Name </th>
                                                        <th>Weight</th>
                                                        <th>Service</th>
                                                        {{-- <th>Freight</th> --}}
                                                        <th>TXN ID </th>
                                                        <th>Amount</th>
                                                        <th>Remark</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbodyfiltr_data"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- 2nd --}}

                                    {{-- 3rd --}}
                                    <div class="tab-pane fade show my-2" id="contact6" role="tabpanel"
                                        aria-labelledby="contact-tab7">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="cr_table">
                                                <thead>
                                                    <tr>
                                                        <th>Credit Id</th>
                                                        {{-- <th>Client Name</th> --}}
                                                        <th>Issue Note</th>
                                                        <th>Remark </th>
                                                        <th>Amount</th>
                                                        <th>Purpose</th>
                                                        <th>Transaction Type</th>
                                                        <th class="date-field">Issue Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbodyfiltr_data"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- 3rd --}}

                                    {{-- 4th --}}
                                    <div class="tab-pane fade show my-2" id="contact7" role="tabpanel"
                                        aria-labelledby="contact-tab8">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="db_table">
                                                <thead>
                                                    <tr>
                                                        <th>Debit Id</th>
                                                        {{-- <th>Client Name</th> --}}
                                                        <th>Issue Note</th>
                                                        <th>Remark </th>
                                                        <th>Amount</th>
                                                        <th>Purpose</th>
                                                        <th>Transaction Type</th>
                                                        <th class="date-field">Issue Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbodyfiltr_data"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- 4th --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        .dataTables_filter input {
            width: 300px !important;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            /* box-shadow: none; */
            outline: none;
            box-shadow: none;
        }
    </style>

    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }


        $(document).ready(function () {
            var _ = $('body');
            var createRecord = 'Are you sure you want to save the record?';
            var updateRecord = 'Are you sure you want to modify this record?';
            var deleteRecord = 'Are you sure you want to delete this record?';

            var table1 = $('#profile3-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Transaction ID & Bank Transaction."
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{route('user.transaction-list')}}",
                    type: "GET",
                    datatype: "json",
                    data: function (d) {
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },
                columns: [
                    { data: 'txn_date_time', orderable: true },
                    // { data: 'awb_no', orderable: true },
                    { data: 'txnid', orderable: true },
                    { data: 'banktxnid', orderable: true },
                    { data: 'amount', orderable: true },
                    { data: 'type', orderable: true },
                    { data: 'status', orderable: true },
                ],
                "lengthMenu": [[50, 100, 200, 500, 5000], [50, 100, 200, 500, "All"]],
                order: [
                    [0, 'DESC']
                ]


            });
            $('#filterButton').click(function () {
                table1.ajax.reload();
                // failedlisttable.ajax.reload();
            });


            var table = $('#failed_table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By AWB No & Transaction ID ."
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{route('user.shipment-transaction-list')}}",
                    type: "GET",
                    datatype: "json",
                    data: function (d) {
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();

                    }
                },
                columns: [
                    { data: 'txn_date_time', orderable: true },
                    { data: 'awb_no', orderable: true },
                    { data: 'courier_name', orderable: true },
                    { data: 'weight', orderable: true },
                    { data: 'service_type', orderable: true },
                    // { data: 'friegth', orderable: true },
                    { data: 'txnid', orderable: true },
                    { data: 'amount', orderable: true },
                    { data: 'type', orderable: true },
                    { data: 'status', orderable: true },
                ],
                "lengthMenu": [[50, 100, 200, 500, 5000], [50, 100, 200, 500, "All"]],
                order: [
                    [0, 'DESC']
                ]
            });
            $('#filterButton').click(function () {
                table.ajax.reload();
                // failedlisttable.ajax.reload();
            });




            var table3 = $('#db_table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Issue Note & Debit Id"
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.db-transaction') }}",
                    type: "GET",
                    datatype: "json",
                    data: function (d) {
                        d.client = $('#client').val();
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();

                    }
                },
                columns: [{
                    data: 'debit_id',
                    orderable: false
                }, 
                // {
                //     data: 'client_name',
                //     orderable: false
                // },
                {
                    data: 'issued_note',
                    orderable: false
                },
                {
                    data: 'Remark',
                    orderable: false
                },
                {
                    data: 'amount',
                    orderable: false
                },
                {
                    data: 'purpose',
                    orderable: false
                },

                {
                    data: 'transaction_type',
                    orderable: false
                },
                {
                    data: 'issued_date',
                    orderable: false
                },
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],

            });

            var table2 = $('#cr_table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Issue Note & Credit Id"
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.cr-transaction') }}",
                    type: "GET",
                    datatype: "json",
                    data: function (d) {
                        d.client = $('#client').val();
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },
                columns: [{
                    data: 'credit_id',
                    orderable: false
                }, 
                // {
                //     data: 'client_name',
                //     orderable: false
                // },
                {
                    data: 'issued_note',
                    orderable: false
                },
                {
                    data: 'Remark',
                    orderable: false
                },
                {
                    data: 'amount',
                    orderable: false
                },
                {
                    data: 'purpose',
                    orderable: false
                },
                {
                    data: 'transaction_type',
                    orderable: false
                },
                {
                    data: 'issued_date',
                    orderable: false
                },
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],

            });




            $('.tab_change').click(function () {
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


            $("#upload_report").click(function () {
                var activeTabId = $('.nav-item .active').attr('id');
                var tableId = (activeTabId === 'contact-tab6') ? 'failed_table' : 'profile3-table';
                var date_range = $('#date_range').val() || "All Time Order";
                if (date_range) {
                    var exportUrl = `{{ route('user.export_wallet') }}?date_range=${date_range}&tableId=${tableId}`;
                    console.log("Redirecting to:", exportUrl);
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

            var today = new Date().toISOString().split('T')[0];
            $('#from_date').attr('max', today);
            $('#to_date').attr('max', today);

            $('#date_range').change(function () {
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
@endsection