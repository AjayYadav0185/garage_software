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

        .badge.green {
            background-color: #ecfdf5;
            color: #059669;
        }

        .badge.red {
            background-color: #fef2f2;
            color: #dc2626
        }

        table.dataTable {
            width: 100% !important;
        }
    </style>

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
    </style>

    <div class="loader"></div>

    <div class="main-content supreme-container">

        <section class="section" style="margin-top:-34px;">

            <div class="section-body">
                {{-- <h4>COD Remittance</h4> --}}

                <div class="row card">

                    <div class="card-body">

                        <div class="card-header-form">

                            <div class="card-header supreme-container" style="display: block;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                                class="btn btn-primary go_forbtn"
                                                style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;"
                                                data-toggle="tooltip" data-placement="top" title="Go Back">
                                                <i class="fa-sharp fa fa-arrow-left"></i>
                                            </a>&nbsp;&nbsp;
                                            <h4 class="mb-0">COD Remittance Details</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center gap-2">


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-3 d-flex">
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon l-bg-purple">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="padding-20">
                                                <div class="text-right">
                                                    <h3 class="font-light mb-0">
                                                        <i class="ti-arrow-up text-success"></i>{{ $totalCod ?? '0' }}
                                                    </h3>
                                                    <span class="text-muted">Total COD</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon l-bg-green">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="padding-20">
                                                <div class="text-right">
                                                    <h3 class="font-light mb-0">
                                                        <i class="ti-arrow-up text-success"></i>{{ $paidCod ?? '0' }}
                                                    </h3>
                                                    <span class="text-muted">COD Remitted - Paid</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon l-bg-cyan">
                                            <i class="fas fa-sync-alt"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="padding-20">
                                                <div class="text-right">
                                                    <h3 class="font-light mb-0">
                                                        <i class="ti-arrow-up text-success"></i> {{ $Adjusted }}
                                                    </h3>
                                                    <span class="text-muted">COD Adjusted</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon l-bg-orange">
                                            <i class="fas fa-calculator text-primary"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="padding-20">
                                                <div class="text-right">
                                                    <h3 class="font-light mb-0">
                                                        <i class="ti-arrow-up text-success"></i>
                                                        {{ $totalCod - $paidCod }}
                                                    </h3>
                                                    <span class="text-muted">COD In Balance</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card-header-form supreme-container">

                                <div class="d-flex justify-content-end" style="margin-right: 0%;">
                                    <div class="text-right " style="margin-right:0%;">

                                        @if (get_role(Auth::user()->usertype) == 2)
                                            <a href="#" class="btn btn-outline-primary " data-toggle="modal"
                                                data-target="#exampleModalCenter2001"><i class="fa fa-cloud-upload"
                                                    aria-hidden="true"></i> Bulk Upload</a>
                                        @endif

                                        <a href="#" class="btn btn-outline-primary" onclick="myFunction()"><i
                                                class="fa fa-filter" aria-hidden="true"></i>
                                            &nbsp;Filter&nbsp;</i></a>

                                    </div>
                                </div>

                                <div class="col-md-12 my-2 " id="myDIV" style="display: none;">
                                    <div class="card">
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
                                                        <label class="form-label" style="color:#0d0d0d;">Date
                                                            Range</label>
                                                        <select class="form-control" id="date_range" name="date_range">
                                                            <option value="">---Select Data Range---</option>
                                                            <option value="today">Today</option>
                                                            <option value="yesterday">Yesterday</option>
                                                            <option value="-7 days">Last seven days</option>
                                                            <option value="first day of">Current Month</option>
                                                            <option value="-1 months">Last Month</option>
                                                            <option value="All Time Order">All Time</option>
                                                            <option value="CustomDateRange">Custom Date Range</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 d-none" id="custom_date_from">
                                                        <label class="form-label" for="from_date"
                                                            style="color:#0d0d0d;">From
                                                            Date</label>
                                                        <input type="date" class="form-control" id="from_date"
                                                            name="from_date">
                                                    </div>

                                                    <div class="col-md-4 d-none" id="custom_date_to">
                                                        <label class="form-label" for="to_date" style="color:#0d0d0d;">To
                                                            Date</label>
                                                        <input type="date" class="form-control" id="to_date" name="to_date">
                                                    </div>

                                                    <div class="col-md-3" @if (get_role(Auth::user()->usertype) == 1) hidden
                                                    @endif>
                                                        <label class="form-label" style="color:#0d0d0d;">Client
                                                            Wise</label>
                                                        <div class="list-inline text-center">
                                                            <div class="form-group">
                                                                <select class="form-control" id="client" name="client">
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

                                                    <div class="col-md-3">
                                                        <label class="form-label" style="color:#0d0d0d;">Status</label>
                                                        <select class="form-control" id="cur_status" name="cur_status">
                                                            <option value="">All</option>
                                                            <option value="completed">Completed</option>
                                                            <option value="in-completed">In-Completed</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-1 my-2">
                                                        <button type="button" class="btn btn-primary mt-4"
                                                            id="filterButton">Apply</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link class_check active" id="home-tab3" data-toggle="tab" href="#home3"
                                        role="tab" aria-controls="home" aria-selected="false">Statements History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link class_check" id="contact-tab6" data-toggle="tab" href="#profile3"
                                        role="tab" aria-controls="profile3" aria-selected="false">Shipment
                                        Transaction</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                
                                <div class="tab-pane fade show active my-2" id="home3" role="tabpanel"
                                    aria-labelledby="home-tab3">

                                    <table class="table table-striped table-hover" id="balance_table">
                                        <thead>
                                            <tr>
                                                @if (get_role(Auth::user()->usertype) == 2)
                                                    <th>Client Name</th>
                                                @endif
                                                <th>Remittance Number</th>
                                                <th class="date-field">Start Date</th>
                                                <th class="date-field">End Date</th>
                                                <th class="date-field">Payment Date</th>
                                                <th>Bank Transaction ID</th>
                                                <th>Convenience Fee</th>
                                                <th>Remittance Amount</th>
                                                <th>Adjusted</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}

                                            </tr>
                                        </thead>
                                        <tbody class="balance_table"></tbody>
                                    </table>

                                </div>

                                <div class="tab-pane fade  my-2" id="profile3" role="tabpanel"
                                    aria-labelledby="profile-tab3">
                                    <table class="table table-striped table-hover" id="balance_table2">
                                        <thead>
                                            <tr>
                                                @if (get_role(Auth::user()->usertype) == 2)
                                                    <th>Client Name</th>
                                                @endif
                                                <th>AWB</th>
                                                <th class="date-field">Delivered Date</th>
                                                <th>COD Amount</th>
                                                <th class="date-field">Remittance Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="balance_table2"></tbody>
                                    </table>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
        </section>
    </div>


    <div class="modal fade" id="exampleModalCenter2001" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('user.bulkRemittancesSave') }}" enctype="multipart/form-data" method="POST">
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">UPLOAD BULK REMITTANCE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Download Remittance: <a href="#" id="Export_report" name="Export_report">Download</a>
                        </h6>
                        <hr>
                        <div class="form-group custom-file">
                            <input type="hidden" name="selectedweightidis" value="{{ Auth::user()->User_Id }}">
                            <input type="file" name="bulkremittancefile" required="" onchange="inputfile500gm(this)"
                                class="custom-file-input form-control-file" id="customFile">
                        </div>

                        <div class="form-group">
                            <label>1. Please fill all mandatory fields.<span class="text-danger">*</span></label>
                            <br> <label>2. Please set satus 1 <span class="text-danger">*</span></label> <br>
                            <label>3. Please Transaction ID Add </label> <br>
                            {{-- <label>4. Each address field needs 60 characters max for Amazon uploads.</label> --}}
                            <label>4. Upload file in CSV or Excel format.</label>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <input type="hidden" name="selectedweightidis" value="{{ Auth::user()->User_Id }}">
                        <input type="submit" class="btn btn-primary active" name="importSubmit5gm" value="Upload"
                            title="Please Select Upload File" id="inputsubmits500gm">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Pay Now</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="payForm" method="POST" action="">
                        <input type="hidden" name="remmitid" id="remmitid">
                        <input type="hidden" name="cycleamount" id="cycleamount">
                        <input type="hidden" name="totalamount" id="totalamount">
                        <div class="form-group">
                            <label for="amount">COD Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="conveninceFee">Convenience Fee (%)</label>
                            <input type="text" class="form-control" name="conveninceFee" id="conveninceFee">
                        </div>

                        <div class="form-group">
                            <label for="Adjusted">Adjusted Amount</label>
                            <input type="text" class="form-control" name="Adjusted" id="Adjusted">
                        </div>

                        <div class="form-group">
                            <label for="totalAmount">Total Amount</label>
                            <input type="text" class="form-control" name="totalAmount" id="totalAmount" readonly>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id">Transaction Id</label>
                            <input type="text" class="form-control" name="transaction_id" id="transaction_id" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        $('#date_range').change(function () {
            if ($(this).val() == 'CustomDateRange') {
                $('#custom_date_from').removeClass('d-none');
                $('#custom_date_to').removeClass('d-none');
            } else {
                $('#custom_date_from').addClass('d-none');
                $('#custom_date_to').addClass('d-none');
            }
        });
        @if (session('success_count') || session('failed_count'))
            var msg =
                "Total no. of records imported successfully: <span style='color:green;'><b>{{ session('success_count') }}</b></span> <br>" +
                "No. of failed records: <span style='color:red;'><b>{{ session('failed_count') }}</b></span> <br>";

            @if (session('failed_count') > 0)
                msg += "<button class='btn btn-danger download_error_contacts ml-3'>Download Failed Report</button>";
            @endif

            Swal.fire({
                icon: 'info',
                title: 'Upload Result',
                html: msg
            });
        @endif
    </script>


    <script>
        // Calculate Total
        function calculateTotalAmount() {
            let cod = parseFloat(document.getElementById('amount').value) || 0;
            let feePercent = parseFloat(document.getElementById('conveninceFee').value) || 0;
            let adjusted = parseFloat(document.getElementById('Adjusted').value) || 0;

            let feeAmount = (cod * feePercent) / 100;
            let total = cod + feeAmount + adjusted; // ✅ fixed calculation

            document.getElementById('totalAmount').value = total.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('conveninceFee').addEventListener('input', calculateTotalAmount);
            document.getElementById('Adjusted').addEventListener('input', calculateTotalAmount);
        });
    </script>

    <script>
        $(document).ready(function () {

            // Modal show event
            $('#myModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var remmitid = button.data('id');
                var cycleamount = button.data('cycleamount');
                var totalamount = button.data('totalamount');

                var modal = $(this);
                modal.find('#remmitid').val(remmitid);
                modal.find('#cycleamount').val(cycleamount);
                modal.find('#totalamount').val(totalamount);

                modal.find('#amount').val(parseFloat(totalamount).toFixed(2));
                modal.find('#totalAmount').val(parseFloat(totalamount).toFixed(2));

                // Reset radios
                modal.find('input[name="payment_type"][value="full"]').prop('checked', true);
                modal.find('#amount').prop('disabled', true);
            });

            // Handle payment type
            $(document).on('change', 'input[name="payment_type"]', function () {
                if ($(this).val() === 'full') {
                    $('#amount').val($('#totalamount').val()).prop('disabled', true);
                } else {
                    $('#amount').val($('#cycleamount').val()).prop('disabled', true);
                }
            });

        });
    </script>

    <script>
        let isAdmin = {{ get_role(Auth::user()->usertype) == 2 ? 'true' : 'false' }};
        let table, table2;

        $(function () {
            // Date Range Picker
            $('#reportrangeshipment').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                    'All Time': [moment('2000-01-01'), moment()]
                },
                opens: 'left'
            }, function (start, end, label) {
                $('#date-range-display').html(start.format('YYYY-MM-DD') + ' - ' + end.format(
                    'YYYY-MM-DD'));

                let dateRangeValue = 'CustomDateRange';

                switch (label) {
                    case 'Today':
                        dateRangeValue = 'today';
                        break;
                    case 'Yesterday':
                        dateRangeValue = 'yesterday';
                        break;
                    case 'Last 7 Days':
                        dateRangeValue = '-7 days';
                        break;
                    case 'This Month':
                        dateRangeValue = 'first day of';
                        break;
                    case 'Last Month':
                        dateRangeValue = '-1 months';
                        break;
                    case 'All Time':
                        dateRangeValue = 'All Time Order';
                        break;
                    default:
                        $('#from_date').val(start.format('YYYY-MM-DD'));
                        $('#to_date').val(end.format('YYYY-MM-DD'));
                        break;
                }

                $('#date_range').val(dateRangeValue);

                // Reload tables
                if (table) table.ajax.reload();
                if (table2) table2.ajax.reload();
            });

            // Init DataTable 1
            table = $('#balance_table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Rem. No."
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.remittances-list') }}",
                    type: "GET",
                    data: function (d) {
                        d.client = $('#client').val();
                        d.cur_status = $('#cur_status').val();
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },
                columns: [
                    ...(isAdmin ? [{
                        data: 'user'
                    }] : []),
                    {
                        data: 'uniqueidno'
                    },
                    {
                        data: 'startdate'
                    },
                    {
                        data: 'enddate'
                    },
                    {
                        data: 'daytorelease'
                    },
                    {
                        data: 'transaction_id'
                    },
                    {
                        data: 'convenince_fee'
                    },
                    {
                        data: 'remmited_amount'
                    },
                    {
                        data: 'Adjusted'
                    },
                    {
                        data: 'status'
                    },
                    // ...(isAdmin ? [{ data: 'action' }] : [])
                ],
                lengthMenu: [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
            });

            // Init DataTable 2
            table2 = $('#balance_table2').DataTable({
                processing: true,
                serverSide: true,
                bFilter: false,
                dom: 'rtlip',
                ajax: {
                    url: "{{ route('user.shipment-list') }}",
                    type: "GET",
                    data: function (d) {
                        d.client = $('#client').val();
                        d.cur_status = $('#cur_status').val();
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },
                columns: [{
                    data: 'client_name'
                },
                {
                    data: 'awb'
                },
                {
                    data: 'delivered_date'
                },
                {
                    data: 'cod_amount'
                },
                {
                    data: 'remittance_date'
                },
                {
                    data: 'status'
                }
                ],
                lengthMenu: [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ]
            });


            // Filter button click reloads DataTable with new params
            $('#filterButton').on('click', function () {
                table.ajax.reload();
                table2.ajax.reload();
            });
        });
    </script>

    <script>
        // Export with filters
        $("#Export_report").click(function () {
            var client = $('#client').val() || '';
            var cur_status = $('#cur_status').val() || '';
            var date_range = $('#date_range').val() || 'today';
            var from_date = $('#from_date').val() || '';
            var to_date = $('#to_date').val() || '';

            var exportUrl = `{{ route('user.cod-remittance') }}?` +
                `client=${client}&` +
                `cur_status=${cur_status}&` +
                `date_range=${date_range}&` +
                `from_date=${from_date}&` +
                `to_date=${to_date}`;

            window.location.href = exportUrl;
        });



        $(document).on('click', '.download_error_contacts', function () {
            // Simple redirect to Laravel route
            window.location.href = "{{ route('user.downloadRemittancesTemp') }}";
        });
    </script>
@endsection