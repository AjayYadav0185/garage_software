@extends('user.dashboard.layout.master')
@section('user-contant')
    <style>
        .dhjvsdghv {
            min-width: 100px !important;
        }

        .small-font-title {
            font-size: 20px !important;
            /* or whatever size you prefer */
        }


        @media only screen and (max-width:988px) and (min-width:290px) {
            #captain {
                margin-top: 8%;
                width: 100%;
            }
        }
    </style>
    <div class="main-content supreme-container">
        <section class="section" style="margin-top:-34px;">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
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
                                            <h4 class="mb-0">Warehouse List</h4>
                                        </div>
                                    </div>
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
                                                    <input type="date" class="form-control" id="from_date"
                                                        name="from_date">
                                                </div>

                                                <div class="col-md-3 d-none" id="custom_date_to">
                                                    <label class="form-label" style="color:#0d0d0d;" for="to_date">To
                                                        Date</label>
                                                    <input type="date" class="form-control" id="to_date"
                                                        name="to_date">
                                                </div>

                                                <div class="col-md-3" @if (get_role(Auth::user()->usertype) == 1) hidden @endif>
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

                                            </div>

                                            <div class="row">
                                                <div class=" col-md-3">
                                                    <label class="form-label"></label>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary"
                                                            id="filterButton">Apply....</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right" style="margin-right:3% ;margin-top:2%">

                                @if (get_role(Auth::user()->usertype) == 1)
                                    <a href="{{ route('user.add_warehouse') }}" class="btn btn-primary">
                                        <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Warehouse
                                    </a>
                                @else
                                    <a href="#" class="btn btn-outline-primary" onclick="myFunction()"><i
                                            class="fa fa-filter" aria-hidden="true"></i>&nbsp;Filter&nbsp;</a>

                                    <a href="javascript:void(0)"><button type="button" id="upload_report"
                                            name="upload_report" class="btn btn-outline-primary"><i
                                                class="fa fa-caret-square-o-up"
                                                aria-hidden="true"></i>&nbsp;Export&nbsp;</button></i></a>
                                @endif



                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="warehouse_tbl">
                                        <thead>
                                            <tr>
                                                @if (get_role(Auth::user()->usertype) == 1)
                                                    <th>Set default</th>
                                                @endif
                                                <th style="width:10px;">Warehouse ID</th>
                                                @if (get_role(Auth::user()->usertype) == 2)
                                                    <th>Client Name </th>
                                                @endif
                                                <th style="width:20px;">Warehouse Name </th>
                                                <th>Contact Person</th>
                                                <th>Contact Number </th>
                                                <th class="date-field">Address</th>
                                                <th>Pincode</th>
                                                <th>Status</th>
                                                <th class="date-field">Date</th>

                                                @if (get_role(Auth::user()->usertype) == 1)
                                                    <th>Action</th>
                                                    <th>Edit</th>
                                                @endif

                                            </tr>
                                        </thead>


                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- ===  Modal start ===  -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Your Warehouse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="Contact person">Contact Person:<small class="text-danger">*</small></label>
                            <input type="text" class="form-control update_wareinput" name="contact_person"
                                id="update_conperson" required onKeyPress="if(this.value.length==30) return false;">
                            <span id="spanerror1" class="text-danger" value=""></span>

                        </div>
                        <div class="form-group">
                            <label for="Contact Number">Contact Number:<small class="text-danger">*</small></label>
                            <input type="text" class="form-control contactvalid update_wareinput" name="phone"
                                id="Update_contactnum" required onKeyPress="if(this.value.length==10) return false;">
                            <input type="hidden" name="" class="update_wareinput" id="hiddenup_id">
                            <input type="hidden" name="" class="update_wareinput" id="pin_number">
                            <input type="hidden" name="" class="update_wareinput" id="wherehouse_name">
                            <span id="spanerror2" class="text-danger" value=""></span>
                        </div>

                        <div class="form-group">
                            <label for="Contact Number">Address:<small class="text-danger">*</small></label>
                            <input type="text" class="form-control update_wareinput" name="address"
                                id="Update_address" required onKeyPress="if(this.value.length==60) return false;">
                            <span id="spanerror3" class="text-danger" value=""></span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="submit" name="" class="btn btn-primary btn-block"
                            id="wareupdtbtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="trueBackdropLabel" aria-hidden="true"
        style="padding-right:2px !important; margin-left:9px;">

        <div class="modal-dialog modal-xl">

            <div class="modal-content">

                <div class="modal-header">


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">
                    <div class="container">

                        <div class="row">

                            <div class="col-lg-6">

                                <div class="row">



                                    <div class="col-md-10">

                                        <div class="">
                                            <h5 style="color: black; font-weight:800;">Warehouse Details</h5>
                                            <table class="table table-sm">

                                                <tbody>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Warehouse ID:-</th>

                                                        <td id="ware_id"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Warehouse Name:-</th>

                                                        <td id="ware_name"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Contact Person:-</th>

                                                        <td id="ware_contac"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Contact Number:-</th>

                                                        <td id="ware_num"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Email:-</th>

                                                        <td id="ware_email"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Date:-</th>

                                                        <td id="ware_date"></td>

                                                    </tr>

                                                    <!-- <tr>

                                                                                                                                                <th scope="row"></th>

                                                                                                                                                <th>Updated Date:-</th>

                                                                                                                                                <td id="ware_updatedate"></td>



                                                                                                                                            </tr> -->

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Waretype:-</th>

                                                        <td id="ware_type"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>TAX Number:-</th>

                                                        <td id="ware_gst"></td>

                                                    </tr>

                                                    <tr>

                                                        <th></th>

                                                        <th>Alterate Contact Number:-</th>

                                                        <td id="ware_altnum"></td>

                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-6" id="captain">
                                <div class="row">
                                    <h5 style="color: black; font-weight: 800;">Warehouse Address</h5>
                                    <div class="col-md-10">

                                        <div class="">



                                            <table class="table table-sm ">

                                                <tbody>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Address:-</th>

                                                        <td id="ware_addre"></td>



                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Pin:-</th>

                                                        <td id="ware_pin"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>City:-</th>

                                                        <td id="ware_city"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>State:-</th>

                                                        <td id="ware_state"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Return Address:-</th>

                                                        <td id="ware_returnadd"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Return Pin:-</th>

                                                        <td id="ware_returnpin"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Return City:-</th>

                                                        <td id="ware_returncity"></td>



                                                    </tr>



                                                    <th scope="row"></th>

                                                    <th>Return State:-</th>

                                                    <td id="ware_returnstate"></td>

                                                    </tr>



                                                    <!-- <tr>

                                                                                                                                                    <th scope="row"></th>

                                                                                                                                                        <th>Status:-</th>

                                                                                                                                                        <td></td>

                                                                                                                                                    </tr> -->

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Seller Name:-</th>

                                                        <td id="seller_name"></td>

                                                    </tr>

                                                    <tr>

                                                        <th scope="row"></th>

                                                        <th>Seller Address:-</th>

                                                        <td id="seller_add"></td>



                                                    </tr>



                                                    <th scope="row"></th>

                                                    <th>Seller GST:-</th>

                                                    <td id="seller_gst"></td>

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



                <!--<div class="modal-footer">-->

                <!--  <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Close</button>-->

                <!--</div>-->

            </div>

        </div>

    </div>
    <!-- === Modal End ===  -->


    <script>
        $(document).ready(function() {
            var _ = $('body');
            var createRecord = 'Are you sure you want to save the record?';
            var updateRecord = 'Are you sure you want to modify this record?';
            var deleteRecord = 'Are you sure you want to delete this record?';
            var pendpickuptable = $('#warehouse_tbl').DataTable({

                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Warehouse"
                },

                ajax: {
                    url: "{{ route('user.warehouse-ajaxcall') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.date_range = $('#date_range').val();
                        d.client = $('#client').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();

                    }
                },
                columns: [

                    @if (get_role(Auth::user()->usertype) == 1)
                        {
                            data: 'default',
                            orderable: true
                        },
                    @endif

                    {
                        data: 'id',
                        orderable: true
                    },
                    @if (get_role(Auth::user()->usertype) == 2)
                        {
                            data: 'client_name',
                            orderable: false
                        },
                    @endif {
                        data: 'name',
                        orderable: true
                    }, {
                        data: 'contact_person',
                        orderable: true
                    }, {
                        data: 'phone',
                        orderable: true
                    }, {
                        data: 'address',
                        orderable: true
                    }, {
                        data: 'pin',
                        orderable: true
                    }, {
                        data: 'status',
                        orderable: false
                    }, {
                        data: 'Rec_Time_Stamp',
                        orderable: true
                    },
                    @if (get_role(Auth::user()->usertype) == 1)

                        {
                            data: 'action',
                            orderable: false
                        }, {
                            data: 'edit',
                            orderable: false
                        },
                    @endif

                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
                order: [
                    [3, 'DESC']
                ]
            });

            // $('.dataTables_filter label').prepend('<i class="fa fa-search"></i>');

            $('#filterButton').click(function() {
                pendpickuptable.ajax.reload();
            });

            $('.tab_change').click(function() {

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

    <script>
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

        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {

                x.style.display = "block";

            } else {

                x.style.display = "none";

            }

        }

        $('#filterButton').on('click', function() {
            pendpickuptable.ajax.reload();
        });
    </script>

    <script>
        $(function() {
            $('#reportrangeshipment').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                autoUpdateInput: false,
                showCustomRangeLabel: true, // Hide Custom Range option
                maxSpan: {
                    days: 92 // Maximum 3 months (approx)
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                    // 'All Time': [moment('2000-01-01'), moment()]
                },
                opens: 'left'
            }, function(start, end, label) {
                $('#date-range-display').html(start.format('DD-MM-YYYY') + ' - ' + end.format(
                    'DD-MM-YYYY'));

                let dateRangeValue;
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
                        // case 'All Time':
                        //     dateRangeValue = 'All Time Order';
                        //     break;
                }
                $('#date_range').val(dateRangeValue);
            });
        });
        $('#reportrangeshipment').on('apply.daterangepicker', function(ev, picker) {
            let startDate = picker.startDate;
            let endDate = picker.endDate;

            if (endDate.diff(startDate, 'months') > 3) {
                alert('You can only select a date range of up to 3 months.');
                return false;
            }

            $('#reportrangeshipment').on('apply.daterangepicker', function(ev, picker) {
                $('#date-range-display').html(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate
                    .format('DD-MM-YYYY'));
                $('#from_date').val(picker.startDate.format('DD-MM-YYYY'));
                $('#to_date').val(picker.endDate.format('DD-MM-YYYY'));
            });
        });


        $("#upload_report").click(function() {
            var activeTabId = $('.nav-item .active').attr('id');
            var tableId = activeTabId;
            var userId = $('#client').val();
            var date_range = $('#date_range').val() || "All Time Order";
            if (date_range) {
                var exportUrl =
                    `{{ route('user.export-warehouse') }}?date_range=${date_range}&tableId=${tableId}&userId=${userId}`;
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
    </script>
    <script>
        $(document).on("change", ".qwerty", function() {
            let id = $(this).val();

            $.ajax({
                url: "{{ route('user.defaultWarehouse') }}", // backend route
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token required
                    id: id
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        width: 500, // px optional
                        customClass: {
                            title: 'small-font-title'
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        width: 500,
                    });
                }
            });
        });
    </script>
@endsection
