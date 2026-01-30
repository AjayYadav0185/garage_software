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
                                            <h4 class="mb-0">Weight Mismatch & Reconcilation</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>




                            <div class="card-header-form">
                                <div class=" text-right " style="margin-right:2% ;">

                                    <a href="javascript:void()"
                                        onclick="window.location.href='{{ route('user.weight-reconciliation') }}'"
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
                                    <div class="card-body  " style="background-color: #bfbfbf;">
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
                                                                <option value="All Time Order">All Time
                                                                </option>
                                                                <option value="CustomDateRange">Custom Date Range</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- For Custom Date -->
                                                <div class="col-md-4 d-none" id="custom_date_from">
                                                    <label class="form-label" style="color:#0d0d0d;" for="from_date">From
                                                        Date</label>
                                                    <input type="date" class="form-control" id="from_date"
                                                        name="from_date">
                                                </div>

                                                <div class="col-md-4 d-none" id="custom_date_to">
                                                    <label class="form-label" style="color:#0d0d0d;" for="to_date">To
                                                        Date</label>
                                                    <input type="date" class="form-control" id="to_date"
                                                        name="to_date">
                                                </div>
                                                <!-- For Custom Date -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <label class="form-label" style="color:#0d0d0d ;">Search By AWB / Order
                                                        ID</label>

                                                    <div class="input-group ">
                                                        <input type="text" id="customer_name" name="customer_name"
                                                            class="form-control " placeholder="Search by customer name"
                                                            name="Name">

                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label" style="color:#0d0d0d ;">Status</label>
                                                    <div class="form-group">
                                                        <select class="form-control" id="paymentmode" name="paymentmode">
                                                            <option value="">Select</option>
                                                            <option value="open">Open</option>
                                                            <option value="closed">Closed</option>
                                                            <option value="pending">Pending</option>

                                                        </select>
                                                    </div>
                                                </div>




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

                                <div class="row my-3">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon l-bg-purple">
                                                <i class="fas fa-cart-plus"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-right">
                                                        <h3 class="font-light mb-0">
                                                            <i
                                                                class="ti-arrow-up text-success"></i>{{ $totalCourier ?? 0 }}
                                                        </h3>
                                                        <span class="text-muted">Total Weight Discrepencies</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon l-bg-green">
                                                <i class="fas fa-hiking"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-right">
                                                        <h3 class="font-light mb-0">
                                                            <i
                                                                class="ti-arrow-up text-success"></i>{{ $activatedCourier ?? 0 }}
                                                        </h3>
                                                        <span class="text-muted"> Weight Discrepencies Accepted </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon l-bg-cyan">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-right">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i> {{ $totalPin ?? 0 }}
                                                        </h3>
                                                        <span class="text-muted">Weight Discrepencies Rejected</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                {{-- <ul class="nav nav-pills" id="myTab3" role="tablist" >
                    
                    <li class="nav-item">
                        <a class="nav-link class_check active" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">Ready To Ship</a>
                    </li>
                </ul> --}}

                                <div class="tab-content excel" id="myTabContent2" style="text-align: center;">

                                    <div class="tab-pane fade show active my-2" id="profile3" role="tabpanel"
                                        aria-labelledby="profile-tab3">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="profile3-table">
                                                <thead>
                                                    <tr>
                                                        <th>AWB / Order Id</th>
                                                        <th>Manifest Date</th>
                                                        <th>Raised Date</th>
                                                        <th>Status</th>
                                                        <th>Manifested Weight</th>
                                                        <th>Charged Weight</th>
                                                        <th>Weight Difference</th>
                                                        <th>Cost Difference</th>
                                                        <th>Shipper Action (Accept / Reject)</th>
                                                        <th>Actioned By</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbodyfiltr_data">
                                                    <tr class="no-data">
                                                        <td colspan="10" class="text-center">No data found</td>
                                                    </tr>
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
        </section>
    </div>









    <script>
        function check_id() {
            var activeTabId = $('.nav-item .active').attr('id');
            var tableId;

            if (activeTabId === 'contact-tab6') {
                tableId = 'failed_table';
            } else if (activeTabId === 'profile-tab3') {
                tableId = 'profile3-table';
            } else if (activeTabId === 'home-tab3') {
                tableId = 'alltable';
            }

            var url = "{{ route('user.place-order') }}";
            if (tableId) {
                manageOrder(tableId, 'Please Select Order', url);
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

        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        $(document).ready(function() {
            var _ = $('body');
            var createRecord = 'Are you sure you want to save the record?';
            var updateRecord = 'Are you sure you want to modify this record?';
            var deleteRecord = 'Are you sure you want to delete this record?';



            var table = $('#profile3-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Order Id"
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.order-list-ajaxcall') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.status = $('#order_status1').val();
                        d.customer_name = $('#customer_name').val();

                        d.mobile = $('#mobile').val();
                        d.item_name = $('#item_name').val();
                        d.paymentmode = $('#paymentmode').val();
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },
                columns: [{
                        data: 'select',
                        orderable: false
                    },
                    {
                        data: 'orderno',
                        orderable: true
                    },
                    {
                        data: 'Rec_Time_Stamp',
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
                        data: 'Order_Type',
                        orderable: true
                    },
                    {
                        data: 'Invoice_Value',
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

            $("#upload_report").click(function() {
                var activeTabId = $('.nav-item .active').attr('id');
                var tableId = (activeTabId === 'contact-tab6') ? 'failed_table' : 'profile3-table';
                var checkboxes = '#' + tableId + ' tbody input[type="checkbox"]';
                var selected = [];

                $(checkboxes + ':checked').each(function() {
                    selected.push($(this).val());
                });

                if (selected.length > 0) {
                    var orderno = selected.join(",");

                    window.location.href = `{{ route('user.export_order') }}?awbno=${orderno}`;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please Select Order',
                        width: '400px',
                    });
                }
            });
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
@endsection
