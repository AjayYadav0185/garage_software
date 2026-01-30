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

        .dataTables_length {
            margin-top: 15px !important;

        }

        div#profile3-table_wrapper {
            margin-top: -40px;
        }

        /* .card .card-header {
                border-bottom-color: #f9f9f9;
                line-height: 30px;
                -ms-grid-row-align: center;
                align-self: center;
                width: 100%;
                padding: 10px 25px;
                display: flex !important;
                align-items: center;
            } */
    </style>
    <div class="loader"></div>

    <div class="main-content supreme-container">
        <section class="section" style="margin-top:-34px;">
            <div class="card">
                <div class="row">
                    <div class="card-header" style="display: block;">
                        <div class="row">
                 <div class="col-sm-12">
    <div class="d-flex align-items-center gap-2">
        <!-- Go Back Button -->
        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
            class="btn btn-primary go_forbtn"
            style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem; "
            data-toggle="tooltip" data-placement="top" title="Go Back">
            <i class="fa-sharp fa fa-arrow-left"></i>
        </a>

        <!-- Title -->
        <h4 class="mb-0"> Courier Selection</h4>

        <!-- Add Courier Button -->
        {{-- <a href="{{ route('add_courier') }}" 
            class="btn btn-success ms-auto"
                 style=" align-self: flex-end; justify-self: flex-end; text-align: end; margin-left: auto;"
            data-toggle="tooltip" data-placement="top" title="Add Courier">
            <i class="fa fa-plus"></i> Add Courier
        </a> --}}

        <!-- Rate List Button -->
        {{-- <a href="javascript:void(0);" 
            class="btn btn-primary"
            style=" align-self: flex-end; justify-self: flex-end; text-align: end; margin-left: auto;"
            data-toggle="modal" data-target=".bd-example-modal-lg">
            <i class="fa fa-list"></i> Rate List
        </a> --}}
    </div>
</div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon l-bg-purple">
                                    {{-- <i class="fa fa-handshake-o" aria-hidden="true"></i> --}}
                                    <i class="fa fa-handshake-o" aria-hidden="true"></i>

                                </div>
                                <div class="card-wrap">
                                    <div class="padding-20">
                                        <div class="text-right">
                                            <h3 class="font-light mb-0">
                                                <i class="ti-arrow-up text-success"></i>{{ $totalCourier ?? 0 }}
                                            </h3>
                                            <span class="text-muted">Total Partners</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon l-bg-green">
                                    {{-- <i class="fas fa-hiking"></i> --}}
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="padding-20">
                                        <div class="text-right">
                                            <h3 class="font-light mb-0">
                                                <i class="ti-arrow-up text-success"></i>{{ $activatedCourier ?? 0 }}
                                            </h3>
                                            <span class="text-muted">Activated </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon l-bg-cyan">
                                    {{-- <i class="fas fa-chart-line"></i> --}}
                                    <i class="fa fa-map-o" aria-hidden="true"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="padding-20">
                                        <div class="text-right">
                                            <h3 class="font-light mb-0">
                                                <i class="ti-arrow-up text-success"></i>
                                                {{ $totalPin ?? 0 }}
                                            </h3>
                                            <span class="text-muted">Total Pincodes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon l-bg-orange">
                                    <i class="fas fa fa-map-marker"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="padding-20">
                                        <div class="text-right">
                                            <h3 class="font-light mb-0">
                                                <i class="ti-arrow-up text-success"></i> {{ $activatedPin ?? 0 }}
                                            </h3>
                                            <span class="text-muted">Activated Pincodes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-header-form">
                        <!-- Filters -->
                        <div id="myDIV" style="display: none;">
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
                                                <div class="form-group">
                                                    <select class="form-control" id="mode" name="mode">
                                                        <option value="">Select Mode</option>
                                                        <option value="Surface">Surface</option>
                                                        <option value="Air">Air</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" id="filterButton">
                                                        Search....</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Filters -->
                        {{-- <div class=" text-left mt-3" style="position:absolute;">

                            <a href="#" class="btn btn-outline-primary" onclick="myFunction()">&nbsp;Filter&nbsp;</i></a>
                        </div>
                    </div> --}}
                    {{-- <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link class_check active tab_change" id="home-tab3" data-toggle="tab" href="#home3"
                                role="tab" data-tab="all" aria-controls="home" aria-selected="true">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link class_check tab_change" id="profile-tab3" data-toggle="tab" href="#profile3"
                                role="tab" aria-controls="profile" aria-selected="false" data-tab='activated'>Activated</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link class_check tab_change" id="contact-tab3" data-toggle="tab" href="#contact3"
                                role="tab" aria-controls="contact" aria-selected="false"
                                data-tab='deactivated'>Deactivated</a>
                        </li>
                    </ul> --}}
                    <input type="hidden" id="type" value="all">
                    <div class="tab-content" id="myTabContent2">

                        <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                            <div class="table-responsive">
                                <div class="form-group" style="width: 50%; max-width: 200px;">
                                    <div>
                                        <label for="">Select Status</label>
                                        <select name="" id="statusfilter" class="form-control">
                                            <option value="Select Status">Select Status</option>
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered" id="profile3-table">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th></th>
                                            <th>Provider</th>
                                            <th>Icon</th>
                                            <th>ID</th>
                                            <th>Is Active</th>
                                            <th>Action</th>
                                            <th>Action Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbodyfiltr_data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>



        <!-- model for pricing plans model <button>Rate List</button>  -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="max-width:150%;width:150%;margin-left:-25%">
                    <div class="modal-header">
                        {{-- <h5 class="modal-title" id="">Pricing Plans</h5> --}}
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="position:absolute; top:15px; right:15px;">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                         <button type="button" class="btn-close" data-toggle="modal" data-target=".bd-example-modal-lg"    style="position:absolute; top:15px; right:15px;">
                   <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12" id="nav">
                                    <a href="#forward" class="btn btn font-18 active"
                                        style="background: blue; color: white;">Forward</a>
                                    <a href="#rto" class="btn btn font-18" style="background: blue; color: white;">RTO</a>
                                    <a href="#reverse" class="btn btn font-18"
                                        style="background: blue; color: white;">Reverse</a>
                                </div>
                            </div>
                        </div>
                        {{-- New --}}
                        <div id="forward" class="toggle" style="display:block">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-end mb-3">
                                                <button id="downloadExcel" class="btn btn-dark">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered table-md">
                                                    {{-- <th>Sr.No.</th> --}}
                                                    {{-- <th>Logo</th> --}}
                                                    <th>Provider</th>
                                                    <th>Mode</th>
                                                    {{-- <th>Additional Weight</th> --}}
                                                    <th>Local (A)</th>
                                                    {{-- <th>Additional (A)</th> --}}
                                                    <th>Regional (B)</th>
                                                    {{-- <th>Additional (B)</th> --}}
                                                    <th>Metro (C)</th>
                                                    {{-- <th>Additional (C)</th> --}}
                                                    <th>National (D)</th>
                                                    {{-- <th>Additional (D)</th> --}}
                                                    <th>Remote (E)</th>
                                                    {{-- <th>Additional (E)</th> --}}
                                                    {{-- <th>SP Location (F)</th> --}}
                                                    {{-- <th>Additional (F)</th> --}}
                                                    <th>Min COD</th>
                                                    <th>COD %</th>
                                                    <th>Liability</th>
                                                    <th>Divisor </th>

                                                    @if ($rateListDatas->isEmpty())
                                                        <tr>
                                                            <td colspan="11" class="text-center">No Record Found</td>
                                                        </tr>
                                                    @else
                                                        @foreach ($rateListDatas as $index => $rateListData)
                                                            <tr>
                                                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                                                {{-- <td class="text-center align-middle">
                                                                    <img alt="courier_logo" height="45px" width="45px"
                                                                        src="{{ asset('user/assets/img/courier_logo/' . $rateListData->courier_logo) }}">
                                                                </td> --}}
                                                                <td>{{ $rateListData->courier }}
                                                                 <hr class="dark"> Additonal {{ $rateListData->weight }} Kg
                                                                </td>
                                                                <td>
                                                                    @if ($rateListData->mode == 'Surface')
                                                                        <i class="fas fa-truck"></i>
                                                                    @else
                                                                        <i class="fa fa-plane"></i>
                                                                    @endif
                                                                </td>
                                                                {{-- <td>{{ $rateListData->add_weight }}</td> --}}
                                                                <td>{{ $rateListData->A }}<hr class="dark">{{ $rateListData->A_add }}</td>
                                                                <td>{{ $rateListData->B }}<hr class="dark">{{ $rateListData->B_add }}</td>
                                                                <td>{{ $rateListData->C }}<hr class="dark">{{ $rateListData->C_add }}</td>
                                                                <td>{{ $rateListData->D }}<hr class="dark">{{ $rateListData->D_add }}</td>
                                                                <td>{{ $rateListData->E }}<hr class="dark">{{ $rateListData->E_add }}</td>
                                                                {{-- <td>{{ $rateListData->F }}<br><br> {{ $rateListData->F_add }}
                                                                </td> --}}
                                                                <td>{{ $rateListData->min_cod}}</td>
                                                                <td>{{ $rateListData->cod_percent }}</td>
                                                                <td>{{ $rateListData->liability }}</td>
                                                                <td>{{ $rateListData->divisor }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>*GST Additional</h6>
                                </div>
                            </div>
                        </div>

                        {{-- 2nd --}}
                        <div id="rto" class="toggle" style="display:none">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="card-body">
                                            <!-- Button Right Aligned -->
                                            <div class="d-flex justify-content-end mb-3">
                                                <button id="downloadRtoExcel" class="btn btn-dark">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-md" id="rtoRateTable">
                                                    <tr>
                                                        {{-- <th>Logo</th> --}}
                                                        <th>Provider</th>
                                                        <th>Mode</th>
                                                        <th>Local (A)</th>
                                                        <th>Regional (B)</th>
                                                        <th>Metro (C)</th>
                                                        <th>National (D)</th>
                                                        <th>Remote (E)</th>
                                                        {{-- <th>SP Location (F)</th> --}}
                                                    </tr>

                                                    @if ($rtoListDatas->isEmpty())
                                                        <tr>
                                                            <td colspan="11" class="text-center">No Record Found</td>
                                                        </tr>
                                                    @else
                                                        @foreach ($rtoListDatas as $index => $rtoListData)
                                                            <tr>
                                                                {{-- <td><img alt="courier_logo" height="45px" width="45px"
                                                                        src="{{ asset('user/assets/img/courier_logo/' . $rtoListData->courier_logo) }}">
                                                                </td> --}}
                                                                <td>{{ $rtoListData->courier }}<hr class="dark">Additonal
                                                                    {{ $rtoListData->weight }}Kg
                                                                </td>
                                                                <td>
                                                                    @if ($rtoListData->mode == 'Surface')
                                                                        <i class="fas fa-truck"></i>
                                                                    @else
                                                                        <i class="fa fa-plane"></i>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $rtoListData->A }}<hr class="dark">{{ $rtoListData->A_add }}</td>
                                                                <td>{{ $rtoListData->B }}<hr class="dark">{{ $rtoListData->B_add }}</td>
                                                                <td>{{ $rtoListData->C }}<hr class="dark">{{ $rtoListData->C_add }}</td>
                                                                <td>{{ $rtoListData->D }}<hr class="dark">{{ $rtoListData->D_add }}</td>
                                                                <td>{{ $rtoListData->E }}<hr class="dark">{{ $rtoListData->E_add }}</td>
                                                                {{-- <td>{{ $rtoListData->F }}<br><br>{{ $rtoListData->F_add }}</td>
                                                                --}}
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>*GST Additional</h6>
                                </div>
                            </div>
                        </div>
                        {{-- 3rd --}}
                        <div id="reverse" class="toggle" style="display:none">
                            {{-- <div class="card-header">
                                <h6>Reverse Pricing Plans</h6>
                            </div> --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <h6>No Record Found</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            #nav a.active {
                background-color: darkgreen !important;
                color: white !important;
            }

   .modal .table th,
.modal .table td {
    border: 2px solid #5a5a5a !important;
    text-align: center;
    vertical-align: middle !important;
}

.modal .table {
    border: 2px solid #5a5a5a !important;
}

.modal .table th {
    font-weight: bold;
}

        </style>
        <script>
            $(document).ready(function () {
                $('#nav a').click(function (e) {
                    e.preventDefault();

                    // Remove active class from all
                    $('#nav a').removeClass('active');

                    // Add active class to clicked one
                    $(this).addClass('active');

                    // Hide all sections
                    $('.toggle').hide();

                    // Show the clicked section
                    let target = $(this).attr('href');
                    $(target).show();
                });
            });
        </script>


    <script>
        $(document).ready(function () {
            var _ = $('body');
            var createRecord = 'Are you sure you want to save the record?';
            var updateRecord = 'Are you sure you want to modify this record?';
            var deleteRecord = 'Are you sure you want to delete this record?';

            var table = $('#profile3-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Courier Name / ID"
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.courier-list') }}",
                    type: "GET",
                    datatype: "json",
                    data: function (d) {
                        d.type = $('#type').val();
                        d.mode = $('#mode').val();
                        d.typestatus = $('#statusfilter').val();
                    }
                },
                columns: [{
                    data: 'sr_no',
                    orderable: false,
                    width: '40px'
                },
                {
                    data: 'logo',
                    orderable: false,
                    width: '150px'
                },
                {
                    data: 'courier_name',
                    orderable: false,
                    width: '200px'
                },
                {
                    data: 'icon',
                    orderable: false,
                    width: '150px'
                },
                {
                    data: 'id',
                    orderable: false,
                    width: '40px'
                },
                {
                    data: 'status',
                    orderable: false
                },
                {
                    data: 'action',
                    orderable: false
                },
                {
                    data: 'action_date',
                    orderable: false
                },
                ],
                "lengthMenu": [
                    [10, 50, 100, 200, 500, -1],
                    [10, 50, 100, 200, 500, "All"]
                ],

            });
            $('#filterButton').click(function () {
                table.ajax.reload();
            });

            $('#statusfilter').change(function () {
                table.ajax.reload();
            });

            $('.tab_change').click(function () {
                var type = $(this).attr('data-tab');


                $('#type').val(type);



                table.ajax.reload();
                $('.tab_change').removeClass('active');

                $(this).addClass('active');

            });
        });

        $('body').on('change', '.status_change', function (e) {

            var courier_id = $(this).attr('data-id');
            var checkbox = $(this).val();

            $.ajax({
                type: "POST",
                url: "{{ route('user.change-status') }}",
                data: {
                    checkbox: checkbox,
                    courier_id: courier_id
                },
                success: function (response) {

                    if (response.status == true) {
                        toastr.success(response.message);


                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                    }
                }
            });
        });

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
            document.getElementById('downloadExcel').addEventListener('click', function () {
                window.location.href = "{{ route('user.export.rate.list') }}";
            });
        </script>


        <script>
            document.getElementById('downloadRtoExcel').addEventListener('click', function () {
                window.location.href = "{{ route('user.export.rto.list') }}";
            });
        </script>
@endsection