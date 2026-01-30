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

        .badge.green {
            background-color: #ecfdf5;
            color: #059669;
        }

        .badge.red {
            background-color: #fef2f2;
            color: #dc2626
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
                                            <h4 class="mb-0">Escalations</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-header-form">
                                <div class=" text-right " style="margin-right:2% ;">



                                    @if (get_role(Auth::user()->usertype) == 2)
                                        <a href="javascript:void()"
                                            onclick="window.location.href='{{ route('user.escalations') }}'"
                                            class="btn btn-outline-primary" type="reset">&nbsp;Refresh &nbsp;</i></a>

                                        <a class="btn btn-outline-primary" onclick="myFunction()">&nbsp;Filter&nbsp;</i></a>
                                    @else
                                        <a href="{{ route('user.add_escalations') }}" class="btn btn-primary"><i
                                                class="fa fa-plus fa-lg"></i> Raise a Ticket</a>
                                    @endif



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
                                            aria-selected="false">All</a>
                                    </li>


                                    <li class="nav-item">
                                        <a class="nav-link class_check" id="contact-tab6" data-toggle="tab"
                                            href="#contact5" role="tab" aria-controls="contact5"
                                            aria-selected="false">Open</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link class_check" id="home-tab3" data-toggle="tab" href="#home3"
                                            role="tab" aria-controls="home" aria-selected="true">Closed</a>
                                    </li>
                                </ul>

                                <div class="tab-content excel" id="myTabContent2" style="text-align: center;">

                                    <div class="tab-pane fade show active my-2" id="profile3" role="tabpanel"
                                        aria-labelledby="profile-tab3">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="profile3-table">
                                                <thead>
                                                    <tr>

                                                        <th>Sr. No.</th>
                                                        @if (get_role(Auth::user()->usertype) == 2)
                                                            <th>Client Name</th>
                                                        @endif
                                                        <th>Ticket Id</th>
                                                        <th class="date-field">Date</th>
                                                        <th>Subject</th>
                                                        <th class="date-field">AWB</th>
                                                        <th>Message</th>
                                                        <th>Status</th>
                                                        <th>Closure By</th>
                                                        <th class="date-field">Latest Update Date</th>
                                                        {{-- <th>Action</th> --}}

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

                                                        <th>Sr. No.</th>
                                                        
                                                        @if (get_role(Auth::user()->usertype) == 2)
                                                            <th>Client Name</th>
                                                        @endif
                                                        <th>Ticket Id</th>
                                                        <th>Date</th>
                                                        <th>Subject</th>
                                                        <th>AWB</th>
                                                        <th>Message</th>
                                                        <th>Status</th>
                                                        <th>Closure By</th>
                                                        <th>Latest Update Date</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="tbodyfiltr_data"></tbody>

                                            </table>
                                        </div>
                                    </div>

                                    {{-- 2nd --}}

                                    {{-- 3rd --}}
                                    <div class="tab-pane fade show  my-2" id="home3" role="tabpanel"
                                        aria-labelledby="home-tab3">
                                        <div class="table-responsive">
                                            <table class="table table-striped  table-bordered" id="alltable">
                                                <thead>
                                                    <tr>

                                                        <th>Sr. No.</th>
                                                        
                                                        @if (get_role(Auth::user()->usertype) == 2)
                                                            <th>Client Name</th>
                                                        @endif
                                                        <th>Ticket Id</th>
                                                        <th>Date</th>
                                                        <th>Subject</th>
                                                        <th>AWB</th>
                                                        <th>Message</th>
                                                        <th>Status</th>
                                                        <th>Closure By</th>
                                                        <th>Latest Update Date</th>


                                                    </tr>
                                                </thead>
                                                <tbody class="tbodyfiltr_data">

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    {{-- 3rd --}}
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
                    searchPlaceholder: "Search By Ticket Id"
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.all-escalations-ajax') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.status = $('#order_status1').val();
                        d.client = $('#client').val();

                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },
                columns: [{
                        data: 'id',
                        orderable: false
                    },


                    @if (get_role(Auth::user()->usertype) == 2)

                        {
                            data: 'client_name',
                            orderable: false
                        },
                    @endif {
                        data: 'ticket_id',
                        orderable: false
                    },
                    {
                        data: 'created_at',
                        orderable: true
                    },
                    {
                        data: 'subject',
                        orderable: true
                    },
                    {
                        data: 'awb',
                        orderable: false
                    },

                    {
                        data: 'escalation_message',
                        orderable: false
                    },
                    {
                        data: 'status_view',
                        orderable: false
                    },

                    {
                        data: 'closureBy',
                        orderable: false
                    },
                    {
                        data: 'lastUpdate',
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

            //failed_table

            var failedlisttable = $('#failed_table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Ticket Id"
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.open-escalations-ajax') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.status = $('#order_status1').val();
                        d.client = $('#client').val();
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },
                columns: [{
                        data: 'id',
                        orderable: false
                    },


                    @if (get_role(Auth::user()->usertype) == 2)

                        {
                            data: 'client_name',
                            orderable: false
                        },
                    @endif {
                        data: 'ticket_id',
                        orderable: false
                    },
                    {
                        data: 'created_at',
                        orderable: true
                    },
                    {
                        data: 'subject',
                        orderable: true
                    },
                    {
                        data: 'awb',
                        orderable: false
                    },

                    {
                        data: 'escalation_message',
                        orderable: false
                    },
                    {
                        data: 'status_view',
                        orderable: false
                    },

                    {
                        data: 'closureBy',
                        orderable: false
                    },
                    {
                        data: 'lastUpdate',
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

            //   alltable

            var alllisttable = $('#alltable').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Ticket Id"
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.closed-escalations-ajax') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.status = $('#order_status1').val();
                        d.client = $('#client').val();
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();



                    }
                },
                columns: [

                    {
                        data: 'id',
                        orderable: false
                    }, {
                        data: 'client_name',
                        orderable: false
                    }, {
                        data: 'ticket_id',
                        orderable: false
                    },


                    @if (get_role(Auth::user()->usertype) == 2)

                        {
                            data: 'client_name',
                            orderable: false
                        },
                    @endif {
                        data: 'subject',
                        orderable: true
                    },
                    {
                        data: 'awb',
                        orderable: false
                    },

                    {
                        data: 'escalation_message',
                        orderable: false
                    },
                    {
                        data: 'status_view',
                        orderable: false
                    },

                    {
                        data: 'closureBy',
                        orderable: false
                    },
                    {
                        data: 'lastUpdate',
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
                table.ajax.reload();
                failedlisttable.ajax.reload();
                alllisttable.ajax.reload();
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
