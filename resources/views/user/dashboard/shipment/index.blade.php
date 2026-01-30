@extends('user.dashboard.layout.master')
@section('user-contant')
    <style>
        .costum_modalcss {
            margin-top: 4rem;
        }

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

        .dataTables_filter input {
            width: 260px;
            /* Increase this value as needed */
        }

        tbody th,
        table.dataTable tbody td {
            padding: 0px 6px !important;
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
            color: rgb(119 114 114);
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

        table thead tr th {
            min-width: 75px;
        }

        .dataTables_length {
            margin-top: 15px !important;

        }

        .dataTables_filter {
            position: relative;
        }

        /* Style the search input */
        .dataTables_filter input {
            padding-left: 30px;
            /* Adjust this value for spacing */
        }

        /* Position the search icon */
        /* .dataTables_filter i {
                                                                                                                                                                position: absolute;
                                                                                                                                                                top: 44%;
                                                                                                                                                                right: 10px;
                                                                                                                                                                transform: translateY(-50%);
                                                                                                                                                                color: #191717;
                                                                                                                                                                Adjust the color as needed
                                                                                                                                                            } */

        th {
            text-align: center !important;
        }
    </style>
    <div class="main-content ">
        <section class="section" style="margin-top:-34px;">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header supreme-container" style="display: block;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                                class="btn btn-primary go_forbtn"
                                                style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;"
                                                data-toggle="tooltip" data-placement="top" title="Go Back">
                                                <i class="fa-sharp fa fa-arrow-left"></i>
                                            </a>&nbsp;&nbsp;
                                            <h4 class="mb-0">Shipments</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="card-header-form supreme-container">
                                <div class=" text-right " style="margin-right:2% ;">
                                    <!-- <a href="#" class="btn btn-outline-primary" id="manifest_print">&nbsp;Manifest&nbsp;</i></a> -->


                                    @if (get_role(Auth::user()->usertype) == 1)
                                        <a href="{{ route('user.manifest') }}" id="PickupManifest"
                                            class="btn btn-outline-primary">
                                            <i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Pickup &
                                            Manifest&nbsp;
                                        </a>
                                        <a href="{{ route('user.shipping-label') }}" id="PrintBulkLabel"
                                            class="btn btn-outline-primary">
                                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print Bulk Label&nbsp;
                                        </a>
                                        <a href="#" class="btn btn-outline-primary" id="order_print">
                                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print Label&nbsp;
                                        </a>
                                    @endif


                                    <a href="" class="btn btn-outline-primary" id="reload_id"> <i class="fa fa-refresh"
                                            aria-hidden="true"></i> &nbsp;Refresh&nbsp;</a>

                                    <a href="javascript:void(0)"><button type="button" id="shipment_report"
                                            name="shipment_report" class="btn btn-outline-primary"> <i
                                                class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                            &nbsp;Export&nbsp;</button></a>

                                    <a href="javascript:void(0)"><button type="button" id="shipment_all_report"
                                            name="shipment_all_report" class="btn btn-outline-primary">&nbsp;Export All
                                            Status &nbsp;</button></i></a>

                                    <a href="#" class="btn btn-outline-primary" onclick="myFunction()"><i
                                            class="fa fa-filter" aria-hidden="true"></i>&nbsp;Filter&nbsp;</a>

                                    <button type="button" name="submit" class="btn btn-outline-primary" id="cancel_order"
                                        onclick="check_id()"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
                                </div>
                            </div>
                            <div class="col-md-12 my-2 " id="myDIV" style="display: none;">
                                <div class="card  ">
                                    <div class="card-header">
                                        <h4>Filter</h4>
                                        <div class="card-header-action">
                                        </div>
                                    </div>
                                    <div class="card-body" style="background-color: #bfbfbf;color:#0d0d0d;">
                                        <form id="IdFilterData" class="sipment_filter" method="post">
                                            {!! csrf_field() !!}
                                            <div class="row supreme-container">

                                                <div class="col-md-3">
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
                                                                <option value="All Time Order">All Time
                                                                </option>
                                                                <option value="CustomDateRange">Custom Date Range</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- For Custom Date -->
                                                <div class="col-md-3 d-none" id="custom_date_from">
                                                    <label class="form-label" style="color:#0d0d0d;" for="from_date">From
                                                        Date</label>
                                                    <input type="date" class="form-control" id="from_date" name="from_date">
                                                </div>

                                                <div class="col-md-3 d-none" id="custom_date_to">
                                                    <label class="form-label" style="color:#0d0d0d;" for="to_date">To
                                                        Date</label>
                                                    <input type="date" class="form-control" id="to_date" name="to_date">
                                                </div>


                                                <div class="col-md-3" @if (get_role(Auth::user()->usertype) == 1) hidden
                                                @endif>
                                                    <label class="form-label">Client Wise</label>
                                                    <div class="list-inline text-center">
                                                        <div class="form-group">
                                                            <select class="form-control" id="client" name="client">
                                                                <option value="">---Select Client Wise---</option>
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
                                                    <label class="form-label">Courier Wise</label>
                                                    <div class="list-inline text-center">
                                                        <div class="form-group">
                                                            <select class="form-control" id="courier" name="courier">
                                                                <option value="">---Select Courier Wise---</option>
                                                                @foreach ($courierData as $courier)
                                                                    <option value="{{ $courier->id }}">
                                                                        {{ $courier->courier_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">
                                                                                                                                                                                                    <div class="col-md-3">
                                                                                                                                                                                                        <label class="form-label">Courier Wise</label>

                                                                                                                                                                                                                                                <div class="list-inline text-center">

                                                                                                                                                                                                            <div class="form-group">

                                                                                                                                                                                                                <select class="form-control" id="courier" name="courier">

                                                                                                                                                                                                                <option value="">---Select Courier Wise---</option>

                                                                                                                                                                                                                @foreach ($courierData as $courier)
                                                                                                    <option value="{{ $courier->id }}">{{ $courier->courier_name }}</option>
                                                                                                    @endforeach
                                                                                                                                                                                                                </select>
                                                                                                                                                                                                            </div>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                    </div> -->
                                                <div class="col-md-3">
                                                    <label class="form-label">Product Name</label>
                                                    <div class="input-group ">
                                                        <input type="text" id="product_name" name="product_name"
                                                            class="form-control " placeholder="Search by Product name">
                                                    </div>
                                                    <input type="hidden" name="tabtext34" id="tab_text" value="contact3">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Payment Mode</label>
                                                    <div class="form-group">
                                                        <select class="form-control" id="paymentmode" name="paymentmode">
                                                            <option value="">Select</option>
                                                            <option value="Prepaid">Prepaid</option>
                                                            <option value="COD">COD</option>
                                                            <option value="">Prepaid & COD</option>
                                                        </select>
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
                                                <div class="col-md-3">
                                                    <label class="form-label"></label>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary"
                                                            id="filterButton">Apply....</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="pdfprint_data">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="order_status1" value="Shipped">
                                <input type="hidden" id="shipstatus" value="1">
                                <ul class="nav nav-pills" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active tab_click class_check tab_change" id="contact-tab3"
                                            data-toggle="tab" href="#contact3" role="tab" aria-controls="contact"
                                            aria-selected="false" data-tab='Shipped' data-status='1'
                                            onclick="exporthide(true)">Pending Pickup</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab_click class_check tab_change" id="contact-tab4"
                                            data-toggle="tab" href="#contact4" role="tab" aria-controls="contact4"
                                            aria-selected="false" data-tab='In Transit' data-status='0'
                                            onclick="exporthide(false)">Intransit</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link tab_click class_check tab_change" id="contact-tab6"
                                            data-toggle="tab" href="#contact6" role="tab" aria-controls="contact6"
                                            aria-selected="false" data-tab='OFD' data-status='0'
                                            onclick="exporthide(false)">Out For Delivery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab_click class_check tab_change" id="contact-tab5"
                                            data-toggle="tab" href="#contact5" role="tab" aria-controls="contact"
                                            aria-selected="false" data-tab='Delivered' data-status='0'
                                            onclick="exporthide(false)">Delivered</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link tab_click class_check tab_change" id="contact-tab7"
                                            data-toggle="tab" href="#contact7" role="tab" aria-controls="contact7"
                                            aria-selected="false" data-tab='Undelivered' data-status='0'
                                            onclick="exporthide(false)">Undelivered</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab_click class_check tab_change" id="contact-tab8"
                                            data-toggle="tab" href="#contact8" role="tab" aria-controls="contact8"
                                            aria-selected="false" data-tab='RTO' data-status='0'
                                            onclick="exporthide(false)">RTO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab_click class_check tab_change" id="contact-tab9"
                                            data-toggle="tab" href="#contact9" role="tab" aria-controls="contact9"
                                            aria-selected="false" data-tab='Lost' data-status='0'
                                            onclick="exporthide(false)"> Lost</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab_click class_check tab_change" id="contact-tab44"
                                            data-toggle="tab" href="#contact44" role="tab" aria-controls="contact44"
                                            aria-selected="false" data-tab='Cancelled' data-status='0'
                                            onclick="exporthide(false)"> Cancelled</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab_click class_check tab_change" id="home-tab3"
                                            data-toggle="tab" href="#home3" role="tab" aria-controls="home"
                                            aria-selected="true" data-tab='' data-status='0' onclick="exporthide(false)">All
                                        </a>
                                    </li>
                                </ul>

                                <style>
                                    .status-bar {
                                        font-weight: bold;
                                        font-size: 16px;
                                        margin-bottom: -10px;
                                        /* space between counter and table */
                                        text-align: left;
                                        /* optional: show counter on right */
                                    }
                                </style>

                                <div class="tab-content excel" id="myTabContent2" style="text-align: center;">
                                    <div class="tab-pane fade show active my-2" id="contact3" role="tabpanel"
                                        aria-labelledby="contact-tab3">
                                        <div class="table-responsive">
                                            {{-- <div class="status-bar mb-2">
                                                Selected Orders: <span id="totalChecked">0</span>
                                            </div> --}}

                                            <div class="mt-2 status-bar text-white d-flex align-items-center justify-content-between px-4 py-2 rounded-3 shadow"
                                                style="background: linear-gradient(90deg, #a09f9f, #666666, #6d6d6d); background-size: 200% 200%; animation: gradientMove 4s ease infinite; max-width: 224px;  font-weight: 100;">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{asset('/new/Vector.png')}}" class="icon-size"
                                                        alt="Shipments" data-toggle="tooltip" data-placement="right"
                                                        title="Shipments">
                                                    <span class="mx-2 fw-semibold">Selected Orders <span
                                                            id="totalChecked">0</span></span>
                                                </div>
                                            </div>

                                            <style>
                                                @keyframes gradientMove {
                                                    0% {
                                                        background-position: 0% 50%;
                                                    }

                                                    50% {
                                                        background-position: 100% 50%;
                                                    }

                                                    100% {
                                                        background-position: 0% 50%;
                                                    }
                                                }

                                                .icon-size {
                                                    width: 24px;
                                                    height: 24px;
                                                }
                                            </style>


                                            <table class="table table-striped xys" id="pending_pickup_tab">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            <div class="custom-checkbox custom-checkbox-table custom-control"
                                                                id="select_all_container" style="padding-left:50px">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    data-checkbox-role="dad" id="select_all"
                                                                    class="custom-control-input">
                                                                <label for="select_all"
                                                                    onclick="checkbox('select_all','checkbox')"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </th>

                                                        @if (get_role(Auth::user()->usertype) == 2)
                                                            <th>Client Name</th>
                                                        @endif
                                                        <th>Order Id & </br> AWB</th>
                                                        <th class="date-field">Date</th>
                                                        <th>Customer </th>
                                                        <th>Courier</th>
                                                        <th>MOP</th>
                                                        <th>COD Amount</th>
                                                        <th>Product</th>
                                                        <th>Weight</th>
                                                        <th class="date-field">Latest Update</th>
                                                        <th>Source</th>
                                                        <th>Status</th>
                                                        <th>Remark</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="printableArea2"></div>
        </section>
    </div>


    <style>
        /* .dataTables_wrapper .dataTables_filter {

                                                                                                                                                                            display: flex !important;
                                                                                                                                                                         text-align: end !important;

                                                                                                                                                                            justify-content: flex-end !important;
                                                                                                                                                                            align-items: center !important;
                                                                                                                                                                        } */
    </style>
    <script>
        $(document).ready(function () {

            $('#shipment_all_report').hide();

            var pendpickuptable;
            var selectedRows = [];

            function initializeTable() {
                pendpickuptable = $('#pending_pickup_tab').DataTable({
                    processing: true,
                    serverSide: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search By Name/Order Id/AWB Phone"
                    },

                    ajax: {
                        url: "{{ route('user.pendpickup-shipment-ajaxcall') }}",
                        type: "GET",
                        datatype: "json",
                        data: function (d) {
                            // Collect all filter values
                            d.status = $('#order_status1').val();
                            d.selectboxstatus = $('#shipstatus').val();
                            d.awb_number = $('#awb_number').val();
                            d.orderno = $('#orderno').val();
                            d.courier = $('#courier').val();
                            d.client = $('#client').val();
                            d.product_name = $('#product_name').val();
                            d.paymentmode = $('#paymentmode').val();
                            d.date_range = $('#date_range').val();
                            d.from_date = $('#from_date').val();
                            d.to_date = $('#to_date').val();
                            d.source = $('#source').val();
                        }
                    },
                    dom: 'ftlip',
                    columns: [{
                        data: 'select',
                        orderable: false,
                        visible: true
                    },
                        @if (get_role(Auth::user()->usertype) == 2)
                                                                                                                                                                                                                                                                                                                            {
                                data: 'client_name',
                                orderable: false
                            },
                        @endif{
                        data: 'Awb_Number',
                        orderable: false
                    }, {
                        data: 'Rec_Time_Date',
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
                        data: 'Order_Type',
                        orderable: true
                    },
                    {
                        data: 'Cod_Amount',
                        orderable: true
                    },
                    {
                        data: 'Item_Name',
                        orderable: true
                    },
                    {
                        data: 'Actual_Weight',
                        orderable: true
                    },
                    {
                        data: 'Last_Time_Stamp',
                        orderable: true
                    },
                    {
                        data: 'source',
                        orderable: true
                    },

                    {
                        data: 'order_status1',
                        orderable: true
                    },
                    {
                        data: 'order_status_show',
                        orderable: true
                    }
                    ],
                    "lengthMenu": [
                        [50, 100, 200, 500, -1],
                        [50, 100, 200, 500, "All"]
                    ],
                    order: [
                        [3, 'DESC']
                    ],
                    // $('#example').DataTable({
                    //     "lengthMenu": [
                    //         [50, 100, 200, 500, -1],
                    //         [50, 100, 200, 500, "All"]
                    //     ],
                    //     "order": [
                    //         [3, 'DESC']
                    //     ],
                    //     "dom": '<"bottom"l>rtip' 
                    // });

                    rowCallback: function (row, data) {

                        var checkbox = $(row).find('input[type="checkbox"]');
                        var rowIndex = selectedRows.indexOf(data.Awb_Number);
                        checkbox.prop('checked', rowIndex > -1);
                    },
                    drawCallback: function () {
                        updateSelectAllCheckbox();
                    }
                });
            }

            function updateSelectAllCheckbox() {
                var allChecked = $('#pending_pickup_tab tbody input[type="checkbox"]').length === $(
                    '#pending_pickup_tab tbody input[type="checkbox"]:checked').length;
                $('#select_all').prop('checked', allChecked);
            }

            initializeTable();

            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');

            if (tab != null) {
                // alert('11111');
                const tab1 = urlParams.get('tab1');

                $('.nav-link').removeClass('active');
                $('#' + tab1).addClass('active');

                $('#order_status1').val(tab);
                $('#shipstatus').val($('#' + tab1).data('status'));

                // alert(tab);
                if (tab === 'pending_pickup') {
                    // alert('Calling')
                    pendpickuptable.column(0).visible(true);
                } else {
                    pendpickuptable.column(0).visible(false);
                }

                pendpickuptable.ajax.reload();
            }

            $('.nav-link.tab_click').on('click', function () {

                $('.nav-link').removeClass('active');

                $(this).addClass('active');

                var selectedTab = $(this).data('tab');

                // alert(selectedTab);

                if (selectedTab === 'Shipped') {
                    pendpickuptable.column(0).visible(true);
                } else {
                    pendpickuptable.column(0).visible(false);
                }

                $('#order_status1').val(selectedTab);
                $('#shipstatus').val($(this).data('status'));

                pendpickuptable.ajax.reload();
            });


            // Handle "select all" checkbox
            $('#select_all').on('click', function () {
                var isChecked = $(this).is(':checked');
                $('#pending_pickup_tab tbody input[type="checkbox"]').prop('checked', isChecked).each(
                    function () {
                        var awbNumber = $(this).val();
                        if (isChecked && !selectedRows.includes(awbNumber)) {
                            selectedRows.push(awbNumber);
                        } else if (!isChecked) {
                            selectedRows = selectedRows.filter(function (value) {
                                return value !== awbNumber;
                            });
                        }
                    });
            });

            $('#pending_pickup_tab tbody').on('click', 'input[type="checkbox"]', function () {
                var awbNumber = $(this).val();
                if ($(this).is(':checked')) {
                    if (!selectedRows.includes(awbNumber)) {
                        selectedRows.push(awbNumber);
                    }
                } else {
                    selectedRows = selectedRows.filter(function (value) {
                        return value !== awbNumber;
                    });
                }
                updateSelectAllCheckbox();
            });

            $('#filterButton').on('click', function () {
                pendpickuptable.ajax.reload();
            });

            // Initial table setup
            // updateTable();
        });

        $(document).ready(function () {
            var _ = $('body');
            var createRecord = 'Are you sure you want to save the record?';
            var updateRecord = 'Are you sure you want to modify this record?';
            var deleteRecord = 'Are you sure you want to delete this record?';

            var pendpickuptable = $('#pending_pickup_tab1').DataTable({

                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Order Id"
                },

                ajax: {
                    url: "{{ route('user.pendpickup-shipment-ajaxcall') }}",
                    type: "GET",
                    datatype: "json",
                    data: function (d) {
                        d.status = $('#order_status1').val();
                        d.selectboxstatus = $('#shipstatus').val();
                        d.source = $('#source').val();
                        d.awb_number = $('#awb_number').val();
                        d.date_range = $('#date_range').val();
                        d.orderno = $('#orderno').val();
                        d.courier = $('#courier').val();
                        d.product_name = $('#product_name').val();
                        d.paymentmode = $('#paymentmode').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();

                    }
                },
                columns: [{
                    data: 'select',
                    orderable: false
                },
                {
                    data: 'Awb_Number',
                    orderable: false
                },
                {
                    data: 'Rec_Time_Date',
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
                    data: 'Order_Type',
                    orderable: true
                },

                {
                    data: 'Cod_Amount',
                    orderable: true
                },
                {
                    data: 'Item_Name',
                    orderable: true
                },
                {
                    data: 'Actual_Weight',
                    orderable: true
                },
                {
                    data: 'source',
                    orderable: true
                },
                {
                    data: 'Rec_Time_Stamp',
                    orderable: true
                },

                {
                    data: 'order_status1',
                    orderable: true
                },
                {
                    data: 'order_status_show',
                    orderable: true
                },

                ],
                "lengthMenu": [
                    [50, 100, 200, 500, -1],
                    [50, 100, 200, 500, "All"]
                ],
                order: [
                    [3, 'DESC']
                ]
            });

            // $('.dataTables_filter label').prepend('<i class="fa fa-search"></i>');

            $('#filterButton').click(function () {
                pendpickuptable.ajax.reload();
            });

            $('.tab_change').click(function () {

                var tabname = $(this).attr('data-tab');

                var tabstatus = $(this).attr('data-status');
                $('#order_status1').val(tabname);
                $('#shipstatus').val(tabstatus);

                pendpickuptable.ajax.reload();

                if (tabname == 'Shipped') {
                    // alert('hfdhjfg')
                    $('#shipment_all_report').hide();
                    $('.custom-checkbox').show();
                } else {
                    // alert('hfdhjfg');
                    // alert(tabname);

                    if (tabname == '' || tabname == null) {
                        // alert('if');
                        $('#shipment_all_report').show();
                        $('.custom-checkbox').hide();
                    } else {
                        // alert('else');
                        $('#shipment_all_report').hide();
                        $('.custom-checkbox').hide();
                    }

                    $('.custom-checkbox').hide();
                }

                $('.tab_change').removeClass('active');

                $(this).addClass('active');

            });

        });
    </script>



    <script
        src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Simultaneous-Downloads-With-One-Click-multiDownload/jquery.multiDownload.js">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.2/xlsx.full.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#reload_id").click(function () {
                location.reload(true);
            });

            $(document).on('click', '#shipment_report', function () {
                var myCheckboxes = [];
                $(".xys").find('input[type=checkbox]:checked').each(function () {
                    // alert('Calling');
                    var id = $(this).val();
                    if (id !== 'on') {
                        myCheckboxes.push(id);
                    }
                });

                if (myCheckboxes.length >= 1) {
                    var awbno = myCheckboxes.join(',');
                    window.location.href = `{{ route('user.export') }}?awbno=${awbno}`;
                } else {

                    // Tab click hone par

                    var activeTab = $(this).data('tab'); // data-tab value le lo
                    var activeTabId = $('.nav-item .active').attr('data-tab');
                    alert('Active Tab: ' + activeTabId);

                    window.location.href = `{{ route('user.exportall') }}?activeTabId=${activeTabId}`;
                    // var awbno = myCheckboxes.join(',');
                    // window.location.href = `{{ route('user.exportall') }}`;

                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Error!',
                    //     text: 'Please Select Order First',
                    //     // width: '400px',
                    //     customClass: {
                    //         popup: 'small-swal-popup',
                    //         htmlContainer: 'custom-text-error-color',
                    //         title: 'custom-title-error-color'
                    //     }
                    // });

                }
            });

        });
    </script>

    <script>
        $(document).ready(function () {

            $('#shipment_all_report').on('click', function (e) {

                // alert('Calling');

                e.preventDefault();

                window.location.href = `{{ route('user.exportall') }}`;

            });

        });
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
        $(document).on('click', '.tab_click', function () {

            var tab = $(this).attr('href');
            var filid = tab.substring(1, tab.length);
            $('#tab_text').val(filid);
            $('#custum_hid_id').val(filid);

        });
    </script>

    <script>
        $(document).on('click', '.abc', function () {

            var table_id = $(this).parents('table').attr('id');
            if ($("#" + table_id + " .abc:checked").length == $("#" + table_id + " .abc")
                .length) {
                $('#' + table_id + ' th input[type="checkbox"]').prop('checked', true);
            } else {
                $('#' + table_id + ' th input[type="checkbox"]').prop('checked', false);
            }
        });

        $(function () {
            $(document).on('click', '#order_print', function () {
                var myCheckboxes = [];
                $(".xys").find('input[type=checkbox]:checked').each(function () {
                    var id = $(this).val();
                    if (id !== 'on') {
                        myCheckboxes.push(id);
                    }
                });

                if (myCheckboxes.length >= 1) {
                    var awbno = myCheckboxes.join(',');
                    window.location.href = `{{ route('user.getlabel') }}?awbno=${awbno}`;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please Select Order First',
                        // width: '400px',
                        customClass: {
                            popup: 'small-swal-popup',
                            htmlContainer: 'custom-text-error-color',
                            title: 'custom-title-error-color'
                        }
                    });
                }
            });
        });

        $(function () {
            $(document).on('click', '#orderBulk_print', function () {
                var myCheckboxes = [];
                $(".xys").find('input[type=checkbox]:checked').each(function () {
                    var id = $(this).val();
                    if (id !== 'on') {
                        myCheckboxes.push(id);
                    }
                });

                if (myCheckboxes.length >= 1) {
                    var awbno = myCheckboxes.join(',');
                    window.location.href = `{{ route('user.getBulkLabel') }}?awbno=${awbno}`;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please Select Order First',
                        // width: '400px',
                        customClass: {
                            popup: 'small-swal-popup',
                            htmlContainer: 'custom-text-error-color',
                            title: 'custom-title-error-color'
                        }
                    });
                }
            });
        });

        $(function () {

            $(document).on('click', '#manifest_print', function () {
                var myCheckboxes = [];
                $(".xys").find('input[type=checkbox]:checked').each(function () {
                    var id = $(this).val();
                    if (id !== 'on') {
                        myCheckboxes.push(id);
                    }
                });

                if (myCheckboxes.length >= 1) {
                    var awbno = myCheckboxes.join(',');
                    window.location.href = `{{ route('user.getmanifestprint') }}?awbno=${awbno}`;
                } else {

                    toastr.error('Please Select Order First');
                }
            });
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

        function check_id() {
            // alert('22222222');
            var activeTabId = $('.nav-item .active').attr('id');
            var tableId;

            switch (activeTabId) {
                case 'contact-tab3':
                    tableId = 'pending_pickup_tab';
                    $('#shipment_all_report').hide();
                    break;
                case 'contact-tab4':
                    tableId = 'intransit_table';
                    $('#shipment_all_report').hide();
                    break;
                case 'contact-tab5':
                    tableId = 'delivered_table';
                    $('#shipment_all_report').hide();
                    break;
                case 'contact-tab6':
                    tableId = 'out_for_delivery_table';
                    $('#shipment_all_report').hide();
                    break;
                case 'contact-tab7':
                    tableId = 'undelivered_table';
                    $('#shipment_all_report').hide();
                    break;
                case 'contact-tab8':
                    tableId = 'rto_table';
                    $('#shipment_all_report').hide();
                    break;
                case 'contact-tab9':
                    tableId = 'lost_table';
                    $('#shipment_all_report').hide();
                    break;
                case 'contact-tab44':
                    tableId = 'cancelled_table';
                    $('#shipment_all_report').hide();
                    break;
                case 'home-tab3':
                    tableId = 'all_table';
                    $('#shipment_all_report').hide();
                    break;
                default:
                    tableId = null;
                    break;
            }

            var url = "{{ route('user.cancel-order') }}";
            if (tableId) {
                manageOrder(tableId, 'Please Select Order', url);
            }
        }

        function exporthide(val) {
            if (val) {

                $('#shipment_report').show();
                $('#PickupManifest').show();
                $('#order_print').show();
                $('#PrintBulkLabel').show();
                $('#cancel_order').show();
            } else {
                $('#shipment_report').show();
                $('#PickupManifest').hide();
                $('#order_print').hide();
                $('#PrintBulkLabel').hide();
                $('#cancel_order').hide();
            }
        }
    </script>

    <script>
        /*
          Works with:
           - master id: 'select_all'
           - child class: 'checkbox' (as in your $select)
           - supports inline onclick: singleCheckbox(...) and checkbox(...)
           - supports dynamically added checkboxes (delegated 'change' handler)
           - if counter element missing, it creates one right after #select_all_container
        */

        (function () {
            // safe ids/classes (change if you named differently)
            const MASTER_ID = 'select_all';
            const CHILD_CLASS = 'checkbox';
            const COUNTER_ID = 'totalChecked';

            // create counter element if not present
            function ensureCounterExists() {
                let cnt = document.getElementById(COUNTER_ID);
                if (!cnt) {
                    const container = document.getElementById('select_all_container');
                    const p = document.createElement('p');
                    p.style.marginTop = '10px';
                    p.innerHTML = 'Total Checked: <span id="' + COUNTER_ID + '">0</span>';
                    if (container && container.parentNode) {
                        container.parentNode.insertBefore(p, container.nextSibling);
                    } else {
                        document.body.appendChild(p);
                    }
                    cnt = document.getElementById(COUNTER_ID);
                }
                return cnt;
            }

            // update count and master checkbox state
            function updateCountAndMaster(childClass = CHILD_CLASS, masterId = MASTER_ID) {
                const all = document.querySelectorAll('.' + childClass + ':not([disabled])');
                const checked = document.querySelectorAll('.' + childClass + ':checked:not([disabled])');
                const countElem = ensureCounterExists();
                if (countElem) countElem.textContent = checked.length;

                const master = document.getElementById(masterId);
                if (!master) return;

                if (all.length === 0) {
                    master.checked = false;
                    master.indeterminate = false;
                } else if (checked.length === all.length) {
                    master.checked = true;
                    master.indeterminate = false;
                } else if (checked.length === 0) {
                    master.checked = false;
                    master.indeterminate = false;
                } else {
                    master.checked = false;
                    master.indeterminate = true;
                }
            }

            // Called by your inline label onclick -> checkbox('select_all','checkbox')
            window.checkbox = function (masterId, childClass) {
                // label click will toggle the native checkbox already; wait a tick to let it update
                setTimeout(function () {
                    updateCountAndMaster(childClass || CHILD_CLASS, masterId || MASTER_ID);
                }, 0);
            };

            // Called by your inline row checkbox onclick -> singleCheckbox('select_all','checkbox')
            window.singleCheckbox = function (masterId, childClass) {
                // wait a tick so the checkbox state is applied, then update
                setTimeout(function () {
                    updateCountAndMaster(childClass || CHILD_CLASS, masterId || MASTER_ID);
                }, 0);
            };

            // Also attach robust event listeners (no need to rely only on inline)
            document.addEventListener('DOMContentLoaded', function () {
                const master = document.getElementById(MASTER_ID);

                if (master) {
                    master.addEventListener('change', function () {
                        // toggle all row checkboxes
                        const all = document.querySelectorAll('.' + CHILD_CLASS + ':not([disabled])');
                        all.forEach(cb => cb.checked = master.checked);
                        updateCountAndMaster();
                    });
                }

                // Delegated listener: catches changes on dynamically added checkboxes too
                document.addEventListener('change', function (e) {
                    if (e.target && e.target.matches('.' + CHILD_CLASS)) {
                        updateCountAndMaster();
                    }
                });

                // initial sync (in case some are pre-checked by server)
                updateCountAndMaster();
            });
        })();
    </script>


@endsection