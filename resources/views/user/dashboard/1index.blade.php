<div class="newpage"></div>

@php
$StatesRevenue = 10;
$Contribution = 10;
$averageOrderValue = 10;
$totalRevenue = 10;
$totalshipment = 10;
$totalShipmentData = 10;
$totalRTO = 10;
$totalpending = 10;
$totalShipmentToday = 10;
$totalavgw = 10;
$todaytotaloeder = 10;
$averageOrderValue1 = 10;
@endphp


@extends('user.dashboard.layout.master')
@section('user-contant')
    {{-- @include('dash'); --}}

    <style>
        .all_orderborder {
            border-right: 1px solid rgb(228 235 242);
        }

        .card .card-body {
            /* padding-top: 17px; */
            /* padding-bottom: 4px; */
        }
    </style>
    <style>
        .progress {
            width: 100px;
            height: 100px;
            background: none;
            position: relative;
        }

        .progress::after {
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 6px solid #eee;
            position: absolute;
            top: 0;
            left: 0;
        }

        .progress>span {
            width: 50%;
            height: 100%;
            overflow: hidden;
            position: absolute;
            top: 0;
            z-index: 1;
        }

        .progress .progress-left {
            left: 0;
        }

        .progress .progress-bar {
            width: 100%;
            height: 100%;
            background: none;
            border-width: 6px;
            border-style: solid;
            position: absolute;
            top: 0;
        }

        .progress .progress-left .progress-bar {
            left: 100%;
            border-top-right-radius: 80px;
            border-bottom-right-radius: 80px;
            border-left: 0;
            -webkit-transform-origin: center left;
            transform-origin: center left;
        }

        .progress .progress-right {
            right: 0;
        }

        .progress .progress-right .progress-bar {
            left: -100%;
            border-top-left-radius: 80px;
            border-bottom-left-radius: 80px;
            border-right: 0;
            -webkit-transform-origin: center right;
            transform-origin: center right;
        }

        .progress .progress-value {
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
    <style>
        .progress {
            width: 100px;
            height: 100px;
            background: none;
            position: relative;
        }

        .progress::after {
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 6px solid #eee;
            position: absolute;
            top: 0;
            left: 0;
        }

        .progress>span {
            width: 50%;
            height: 100%;
            overflow: hidden;
            position: absolute;
            top: 0;
            z-index: 1;
        }

        .progress .progress-left {
            left: 0;
        }

        .progress .progress-bar {
            width: 100%;
            height: 100%;
            background: none;
            border-width: 6px;
            border-style: solid;
            position: absolute;
            top: 0;
        }

        .progress .progress-left .progress-bar {
            left: 100%;
            border-top-right-radius: 80px;
            border-bottom-right-radius: 80px;
            border-left: 0;
            -webkit-transform-origin: center left;
            transform-origin: center left;
        }

        .progress .progress-right {
            right: 0;
        }

        .progress .progress-right .progress-bar {
            left: -100%;
            border-top-left-radius: 80px;
            border-bottom-left-radius: 80px;
            border-right: 0;
            -webkit-transform-origin: center right;
            transform-origin: center right;
        }

        .progress .progress-value {
            position: absolute;
            top: 0;
            left: 0;
        }

        /* text  */

        .table:not(.table-sm):not(.table-md):not(.dataTable) td,
        .table:not(.table-sm):not(.table-md):not(.dataTable) th {
            height: 28px !important;
        }

        body {
            font-size: 12px !important;
            background-color: #fff !important;
            box-shadow: 0.375rem 0.375rem 3.375rem rgba(0, 0, 0, 0.05) !important;
        }

        p {
            line-height: 21px !important color: #202224 !important;
        }


        table th {
            font-size: 12px;
        }

        table th,
        td {
            font-size: 12px;
        }

        .card {
            /* margin-bottom : 0px; */
            padding-top: 0px;
            box-shadow: 0.375rem 0.375rem 3.375rem rgba(0, 0, 0, 0.05) !important;
        }

        #myChart3 {
            width: 100% !important;
            height: 100% !important;
        }

        .shadow {
            box-shadow: 0.375rem 0.375rem 3.375rem rgba(0, 0, 0, 0.05) !important;
        }
    </style>
    <style>
        .section>*:first-child {
            margin-top: -92px;
        }

        .theme-white .nav-pills .nav-link {
            color: #bbbbbb !important;
            background-color: transparent !important;
            border: 2px solid #38373794 !important;
            shape-outside: none;
        }
    </style>
    <style>
        .right-icon {
            color: #888;
            font-size: 18px;
        }

        .count-value {
            font-size: 25px;
            font-weight: bold;
            color: #000;
        }

        .text-success.small {
            margin-top: 20px;
            font-size: 15px;
            font-weight: 600;
        }

        .right-icon i {
            font-size: 18px;
            font color: #888;
        }
    </style>

    <div class="loader" style="display:none;"></div>

    <div id="app" style="background-color: #adadad14;">
        <div class="main-wrapper main-wrapper-1 supreme-container">
            <div class="" style="display: none;">
                <input type="text" name="dashfromdate" id="dashfromdate" class="dashfromdate">
                <input type="text" name="dashtodate" id="dashtodate" class="dashtodate">
            </div>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section" style=";">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div class="">
                                <ul class="nav nav-pills" id="myTab3" role="tablist">

                                </ul>
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                        aria-labelledby="home-tab3">

                                        <div class="tab-content px-4" id="myTabContent2" hidden>
                                            <!-- Row for Tab Navigation -->
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end">
                                                    <div style="width: 180px; ">
                                                        <select class="form-control" style=" margin-left: -10px !important">
                                                            <option>B2C ( Domestic )</option>
                                                            <option>Document</option>
                                                            <option>Hyperlocal</option>
                                                            <option>B2B ( Domestic )</option>
                                                            <option>International</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-4 d-flex justify-content-start align-items-start"
                                                    style="margin-left: -15px !important;">
                                                    <div class="font-weight-bold text-center"
                                                        style="color: #6777ef; font-size: 8px;  !important;">
                                                        <h4 class="d-inline" style=" font-size: 17px;  !important;">
                                                            Welcome <b> <span class="text-decoration-underline fw-bold"
                                                                    style=" font-size: 20px;">
                                                                    {{ Auth::user()->first_name }}
                                                                    {{ Auth::user()->last_name }}
                                                                </span> </b>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-4 d-flex justify-content-start align-items-start">
                                                </div>
                                         
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="tab-content" id="myTabContent2">
                                            <div class="tab-pane fade show active" id="Executive" role="tabpanel"
                                                aria-labelledby="home-tab3">
                                                <div class="row p-0 m-2">
                                                    <div class="col-12 d-flex P-0" style="gap: 10px;">
                                                        
                                                    
                                                        <div class="card text-left w-100   shadow"
                                                            style="background-color: #EBF3FF;">
                                                            <a class="text-decoration-none text-black">
                                                                <div class="card-body  P-2 d-flex flex-column">
                                                                    <img alt="image"
                                                                        src="{{ asset('dash_icon/total_pending.png') }}"
                                                                        class="header-logo mb-2"
                                                                        style="width: 30px; height: 30px;" />
                                                                    <h5 style="color: black;">
                                                                        {{ $totalpending }}
                                                                    </h5>
                                                                    <p class="card-text font-weight-bold"
                                                                        style="color: #78ADF9;">
                                                                        Total Customer</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                              

                                                        <div class="card text-left w-100   shadow"
                                                            style="background-color:#FCFBE0;">
                                                            <a class="text-decoration-none text-black">
                                                                <div class="card-body  P-2 d-flex flex-column ">

                                                                    <img alt="image"
                                                                        src="{{ asset('dash_icon/average.png') }}"
                                                                        class="header-logo mb-2"
                                                                        style="width: 30px; height: 30px;" />

                                                                    <h5 class="text-black" style="color: black;">
                                                                        {{ number_format($totalavgw, 2) }}
                                                                    </h5>
                                                                    <p class="card-text font-weight-bold"
                                                                        style=" color: #5E5E5D;">
                                                                        Inventory Stock</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="card text-left w-100   shadow"
                                                            style="background-color:#f7ebf4;">
                                                            <a class="text-decoration-none text-black">
                                                                <div class="card-body  P-2 d-flex flex-column ">

                                                                    <img alt="image"
                                                                        src="{{ asset('dash_icon/average_daily.png') }}"
                                                                        class="header-logo mb-2"
                                                                        style="width: 30px; height: 30px;" />

                                                                    <h5 class="text-black" style="color: black;">
                                                                        {{ $todaytotaloeder }}
                                                                    </h5>
                                                                    <p class="card-text font-weight-bold"
                                                                        style=" color: #6966F2;">
                                                                        Running Job Cards</p>
                                                                </div>
                                                            </a>
                                                        </div>
    <div class="card text-left w-100   shadow"
                                                            style="background-color: #fcf5f5;">
                                                            <a class="text-decoration-none text-black">
                                                                <div class="card-body   P-2 d-flex flex-column">
                                                                    <img alt="image" src="{{ asset('dash_icon/rto.png') }}"
                                                                        class="header-logo mb-2"
                                                                        style="width: 30px; height: 30px;" />
                                                                    <h5 style="color: black;">{{ $totalRTO }}
                                                                    </h5>
                                                                    <p class="card-text font-weight-bold"
                                                                        style="color: #F96969;">
                                                                        Complete Job Cards</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>


                                        </div>

                                        <div class="tab-pane fade" id="profile2" role="tabpanel"
                                            aria-labelledby="home-tab3">

                                            <div class="row">
                                                &nbsp;&nbsp;&nbsp;&nbsp;<h5>Hyper local</h5>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="International" role="tabpanel"
                                            aria-labelledby="home-tab3">

                                            <div class="row">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5>International</h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <input type="hidden" id="overallfrom" class="overallfrom">
    <input type="hidden" id="overallto" class="overallto">

    {{-- Graph HTML --}}
    {{-- <div class="d-none" id="chartDataContainer">
        <span id="weightLabels">{{ json_encode($weightlabels) }}</span>
        <span id="weightData">{{ json_encode($weightdata) }}</span>
        <span id="wt_0_0_5_pct">{{ json_encode($wt_0_0_5_pct) }}</span>
        <span id="wt_0_5_1_pct">{{ json_encode($wt_0_5_1_pct) }}</span>
        <span id="wt_1_2_pct">{{ json_encode($wt_1_2_pct) }}</span>
        <span id="wt_2_3_pct">{{ json_encode($wt_2_3_pct) }}</span>

        <span id="wt_3_5_pct">{{ json_encode($wt_3_5_pct) }}</span>
        <span id="wt_5_10_pct">{{ json_encode($wt_5_10_pct) }}</span>
        <span id="wt_10_plus_pct">{{ json_encode($wt_10_plus_pct) }}</span>
    </div> --}}
    {{-- Graph end --}}

    <!-- recharge model  -->
    <script src="https://unpkg.com/sweetalert%402.1.2/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script src="{{ asset('utils.js') }}"></script>

    <script>
        $(document).ready(function () {
            window.overalltable = $('#overalltable').DataTable({
                processing: true,
                searching: false,
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'overall';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',

                columns: [{
                    data: 'date',
                    orderable: false
                },
                {
                    data: 'count',
                    orderable: false
                },
                {
                    data: 'total_shiped',
                    orderable: false
                },
                {
                    data: 'total_pending',
                    orderable: false
                },
                {
                    data: 'total_Delivered',
                    orderable: false
                },
                {
                    data: 'total_ndr',
                    orderable: false
                },
                {
                    data: 'total_ndr',
                    orderable: false
                },
                {
                    data: 'total_ndr',
                    orderable: false
                },
                {
                    data: 'total_ndr',
                    orderable: false
                },
                {
                    data: 'total_Lost',
                    orderable: false
                },

                ]


            });

            window.statewisedata = $('.Statewisedata').DataTable({
                processing: true,
                searching: false,
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'statewise';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',
                columns: [{
                    data: 'State',
                    orderable: false
                },
                {
                    data: 'count',
                    orderable: false
                },
                {
                    data: 'total_shiped',
                    orderable: false
                },
                {
                    data: 'total_pending',
                    orderable: false
                },
                {
                    data: 'total_Delivered',
                    orderable: false
                },
                {
                    data: 'total_transit',
                    orderable: false
                },
                {
                    data: 'total_rto',
                    orderable: false
                },
                {
                    data: 'total_ndr',
                    orderable: false
                },
                {
                    data: 'total_Cancelled',
                    orderable: false
                },
                {
                    data: 'total_Lost',
                    orderable: false
                }
                ]
            });

            window.Zonnewisedata = $('.Zonnewisedata').DataTable({
                processing: true,
                searching: false,
                dom: 'tip',
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'Zonnewisedata';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },

                columns: [{
                    data: 'zone',
                    orderable: false
                },
                {
                    data: 'count',
                    orderable: false
                },
                {
                    data: 'total_shiped',
                    orderable: false
                },
                {
                    data: 'total_pending',
                    orderable: false
                },
                {
                    data: 'total_Delivered',
                    orderable: false
                },
                {
                    data: 'total_transit',
                    orderable: false
                },
                {
                    data: 'total_rto',
                    orderable: false
                },
                {
                    data: 'total_ndr',
                    orderable: false
                },
                {
                    data: 'total_Cancelled',
                    orderable: false
                },
                {
                    data: 'total_Lost',
                    orderable: false
                },
                ]
            });

            window.courierwisedata = $('.courierwisedata').DataTable({
                processing: true,
                searching: false,
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'courierwisedata';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',
                columns: [{
                    data: 'courier_name',
                    orderable: false
                },
                {
                    data: 'count',
                    orderable: false
                },
                {
                    data: 'total_shiped',
                    orderable: false
                },
                {
                    data: 'total_pending',
                    orderable: false
                },
                {
                    data: 'total_Delivered',
                    orderable: false
                },
                {
                    data: 'total_transit',
                    orderable: false
                },
                {
                    data: 'total_rto',
                    orderable: false
                },
                {
                    data: 'total_ndr',
                    orderable: false
                },
                {
                    data: 'total_Cancelled',
                    orderable: false
                },
                {
                    data: 'total_Lost',
                    orderable: false
                },
                ]
            });



            window.productwisedata = $('.productwisedata').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Courier Name"
                },
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'productwisedata';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',
                columns: [
                    { data: 'Item_Name', orderable: false, searchable: true },
                    { data: 'count', orderable: false, searchable: false },
                    { data: 'total_shiped', orderable: false, searchable: false },
                    { data: 'total_pending', orderable: false, searchable: false },
                    { data: 'total_Delivered', orderable: false, searchable: false },
                    { data: 'total_transit', orderable: false, searchable: false },
                    { data: 'total_rto', orderable: false, searchable: false },
                    { data: 'total_ndr', orderable: false, searchable: false },
                    { data: 'total_Cancelled', orderable: false, searchable: false },
                    { data: 'total_Lost', orderable: false, searchable: false }
                ]
            });



            window.volumetreanddata = $('.volumetreanddata').DataTable({
                processing: true,
                searching: false,
                dom: 'tip',
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'volumetreanddata';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },

                columns: [{
                    data: 'Order_Type',
                    orderable: false
                },
                {
                    data: 'count',
                    orderable: false
                },
                {
                    data: 'total_shiped',
                    orderable: false
                },
                {
                    data: 'total_pending',
                    orderable: false
                },
                {
                    data: 'total_Delivered',
                    orderable: false
                },
                {
                    data: 'total_transit',
                    orderable: false
                },
                {
                    data: 'total_rto',
                    orderable: false
                },
                {
                    data: 'total_ndr',
                    orderable: false
                },
                {
                    data: 'total_Cancelled',
                    orderable: false
                },
                {
                    data: 'total_Lost',
                    orderable: false
                },
                ]
            });

            window.ShipmentProgress = $('.ShipmentProgress').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'ShipmentProgress';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',
                columns: [{
                    data: 'mode',
                    orderable: false
                },
                {
                    data: 'count',
                    orderable: false
                },
                {
                    data: 'total_shipped',
                    orderable: false
                },
                {
                    data: 'total_pending',
                    orderable: false
                },
                {
                    data: 'total_delivered',
                    orderable: false
                },
                {
                    data: 'total_transit',
                    orderable: false
                },
                {
                    data: 'total_rto',
                    orderable: false
                },
                {
                    data: 'total_ndr',
                    orderable: false
                },
                {
                    data: 'total_cancelled',
                    orderable: false
                },
                ]
            });




            window.tatDelivered = $('.tatDelivered').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'tatDelivered';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',
                columns: [{
                    data: '1',
                    orderable: false
                },
                {
                    data: 'day1',
                    orderable: false
                },
                {
                    data: 'day2',
                    orderable: false
                },
                {
                    data: 'day3',
                    orderable: false
                },
                {
                    data: 'day4',
                    orderable: false
                },
                {
                    data: 'day5',
                    orderable: false
                },
                {
                    data: 'day6',
                    orderable: false
                }

                ]
            })
            window.tatProcessing = $('.tatProcessing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'tatProcessing';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',
                columns: [{
                    data: 'courier_name',
                    orderable: false
                },
                {
                    data: 'day1',
                    orderable: false
                },
                {
                    data: 'day2',
                    orderable: false
                },
                {
                    data: 'day3',
                    orderable: false
                },
                {
                    data: 'day4',
                    orderable: false
                },
                {
                    data: 'day5',
                    orderable: false
                },
                {
                    data: 'day6',
                    orderable: false
                },
                {
                    data: 'day7',
                    orderable: false
                }
                ]
            })


            window.tatAirDelivered = $('.tatAirDelivered').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'tatAirDelivered';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',
                columns: [{
                    data: 'courier_name',
                    orderable: false
                },
                {
                    data: 'day1',
                    orderable: false
                },
                {
                    data: 'day2',
                    orderable: false
                },
                {
                    data: 'day3',
                    orderable: false
                },
                {
                    data: 'day4',
                    orderable: false
                },
                {
                    data: 'day5',
                    orderable: false
                },
                {
                    data: 'day6',
                    orderable: false
                },
                {
                    data: 'day7',
                    orderable: false
                }
                ]
            })



            window.tatAirProcessing = $('.tatAirProcessing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'tatAirProcessing';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',
                columns: [{
                    data: 'courier_name',
                    orderable: false
                },
                {
                    data: 'day1',
                    orderable: false
                },
                {
                    data: 'day2',
                    orderable: false
                },
                {
                    data: 'day3',
                    orderable: false
                },
                {
                    data: 'day4',
                    orderable: false
                },
                {
                    data: 'day5',
                    orderable: false
                },
                {
                    data: 'day6',
                    orderable: false
                },
                {
                    data: 'day7',
                    orderable: false
                }
                ]
            })




            window.surfacetreanddata = $('.surfacetreanddata').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'surfacetreanddata';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',
                columns: [{
                    data: 'mode',
                    orderable: false
                },
                {
                    data: 'tat_a',
                    orderable: false
                },
                {
                    data: 'tat_b',
                    orderable: false
                },
                {
                    data: 'tat_c',
                    orderable: false
                },
                {
                    data: 'tat_d',
                    orderable: false
                },
                {
                    data: 'tat_e',
                    orderable: false
                },
                {
                    data: 'tat_f',
                    orderable: false
                },
                {
                    data: 'tat_f',
                    orderable: false
                }
                ]
            });

            window.Airtat = $('.Airtat').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "#",
                    data: function (d) {
                        d.type = 'Airtat';
                        d.start_date = $('#overallfrom').val();
                        d.end_date = $('#overallto').val();
                    }
                },
                dom: 'ftlip',
                columns: [{
                    data: 'mode',
                    orderable: false
                },
                {
                    data: 'tat_a',
                    orderable: false
                },
                {
                    data: 'tat_b',
                    orderable: false
                },
                {
                    data: 'tat_c',
                    orderable: false
                },
                {
                    data: 'tat_d',
                    orderable: false
                },
                {
                    data: 'tat_e',
                    orderable: false
                },
                {
                    data: 'tat_f',
                    orderable: false
                },
                {
                    data: 'tat_f',
                    orderable: false
                }
                ]
            });


        });
    </script>


    <script>
        $(document).ready(function () {
            var startDate = $('.dashfromdate').val();
            var endDate = $('.dashtodate').val();

            // console.log('From Date:', startDate);
            // console.log('To Date:', endDate);
            check(startDate, endDate);

            // Event listener when date inputs change
            $('.dashfromdate, .dashtodate').on('change', function () {
                var newStartDate = $('.dashfromdate').val();
                var newEndDate = $('.dashtodate').val();

                // console.log('Date changed');
                // console.log('New From Date:', newStartDate);
                // console.log('New To Date:', newEndDate);

                check(newStartDate, newEndDate);
            });

        });

        // Modify check() to accept startDate and endDate as parameters
        function check(startDate, endDate) {
            $('.loader').show();
            $.ajax({
                url: '#',
                type: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    // console.log(response); // check output in console
                    $('.loader').hide();

                    // alert(response.fatCount);
                    $('#fatCount').text(response.fatCount);
                    $('#fadCount').text(response.fad);
                    $('#fadPercentage').text(response.fadPercentage + '%');
                    $('#delayedUndelivered').text(response.delayedUndelivered ?? '0');
                    $('#delayPercentage').text((response.delayPercentage ?? '0') + '%');

                    let data = response.totalShipmentData;
                    $('#total_shipment').text(data.total_shipment ?? '0');
                    $('#total_pending').text(data.total_pending ?? '0');
                    $('.total_delivered').text(data.total_delivered ?? '0');
                    $('#total_transit').text(data.total_transit ?? '0');
                    $('.total_rto').text(data.total_rto ?? '0');
                    $('.NDR').text(data.NDR ?? '0');
                    $('#Reattempt').text(data.Reattempt ?? '0');
                    $('#totalcod').text(response.totalcod ?? '0');
                    $('#totalcodRemitted').text(response.totalcodRemitted ?? '0');
                    $('#totalcodpending').text(response.totalcodpending ?? '0');

                    let totalrevenueData = response.totalrevenueData;
                    $('#total_cod_amount').text(totalrevenueData.total_cod_amount ?? '0');
                    $('#total_prepaid_amount').text(totalrevenueData.total_prepaid_amount ?? '0');
                    let totalRevenue = (parseFloat(totalrevenueData.total_cod_amount ?? 0) + parseFloat(totalrevenueData.total_prepaid_amount ?? 0)).toFixed(2);
                    $('#total_revenue').text(totalRevenue);
                },
                error: function (xhr) {
                    $('.loader').hide();
                    console.log(xhr.responseText);
                }
            });
        }

    </script>


    <script>
        $(document).ready(function () {
            var startDate = $('.dashfromdate').val();
            var endDate = $('.dashtodate').val();
            // console.log('From Date:', startDate);
            // console.log('To Date:', endDate);
            checkWeightTrend(startDate, endDate);

            // Event listener when date inputs change
            $('.dashfromdate, .dashtodate').on('change', function () {
                var newStartDate = $('.dashfromdate').val();
                var newEndDate = $('.dashtodate').val();

                // console.log('Date changed');
                // console.log('New From Date:', newStartDate);
                // console.log('New To Date:', newEndDate);

                checkWeightTrend(newStartDate, newEndDate);
            });

        });

        function checkWeightTrend(startDate, endDate) {
            // alert(`Start Date: ${startDate}, End Date: ${endDate}`);
            $.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    // console.log('Weight Trend:', response);

                    // call your chart update here
                    updateWeightChart(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }


        function updateWeightChart(data) {
            const ctx = document.getElementById('weightTrendChart').getContext('2d');

            if (window.weightTrendChart instanceof Chart) {
                window.weightTrendChart.destroy();
            }

            window.weightTrendChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            label: '0-0.5kg',
                            data: data.wt_0_0_5,
                            barThickness: 15,
                            backgroundColor: '#514C7F' // blue

                        },
                        {
                            label: '0.5-1kg',
                            data: data.wt_0_5_1,
                            barThickness: 15,
                            backgroundColor: '#615C8C' // green
                        },
                        {
                            label: '1-2kg',
                            data: data.wt_1_2,
                            barThickness: 15,
                            backgroundColor: '#716D98' // yellow
                        },
                        {
                            label: '2-3kg',
                            data: data.wt_2_3,
                            barThickness: 15,
                            backgroundColor: '#817DA5' // red
                        },
                        {
                            label: '3-5kg',
                            data: data.wt_3_5,
                            barThickness: 15,
                            backgroundColor: '#918DB2' // purple
                        },
                        {
                            label: '5-10kg',
                            data: data.wt_5_10,
                            barThickness: 15,
                            backgroundColor: '#A19DBF' // pink
                        },
                        {
                            label: '10+kg',
                            data: data.wt_10_plus,
                            barThickness: 15,
                            backgroundColor: '#C1BED8' // gray
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        },
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            //  display: false
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            display: false

                        }
                    }
                },
                barThickness: 10,
                maxBarThickness: 10
            });
        }



    </script>

    <script>
        $(document).ready(function () {
            // Call checkVolumeTrend() on page load with default input values
            var startDate = $('.dashfromdate').val();
            var endDate = $('.dashtodate').val();

            // console.log('From Date:', startDate);
            // console.log('To Date:', endDate);
            checkVolumeTrend(startDate, endDate);

            // Event listener when date inputs change
            $('.dashfromdate, .dashtodate').on('change', function () {
                var newStartDate = $('.dashfromdate').val();
                var newEndDate = $('.dashtodate').val();

                // console.log('Date changed');
                // console.log('New From Date:', newStartDate);
                // console.log('New To Date:', newEndDate);

                checkVolumeTrend(newStartDate, newEndDate);
            });

        });

        function checkVolumeTrend(startDate, endDate) {
            // alert(`V Start Date: ${startDate}, End Date: ${endDate}`);
            $.ajax({
                url: '#', // ✅ your Volume Trend route
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    // console.log('Volume Trend:', response);

                    // call your chart update here
                    updateVolumeChart(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function updateVolumeChart(data) {
            // alert(data.labels);
            const ctx = document.getElementById('volumeTrendChart').getContext('2d');

            if (window.volumeTrendChart instanceof Chart) {
                window.volumeTrendChart.destroy();
            }

            window.volumeTrendChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            label: 'COD Volume',
                            data: data.codData,
                            barThickness: 15,
                            backgroundColor: '#514C7F' // purple
                        },
                        {
                            label: 'Prepaid Volume',
                            data: data.prepaidData,
                            barThickness: 15,
                            backgroundColor: '#B1AEC8' // lighter purple
                        },
                        // {
                        //     label: 'Total Volume',
                        //     data: data.totalVolume,
                        //     barThickness: 15,
                        //     backgroundColor: '#716D98' // another shade for total
                        // }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        },
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            display: false
                        }
                    }
                }
            });
        }

    </script>



    <script>
        $(document).ready(function () {
            // Initial load with current dates
            var initialStartDate = $('.dashfromdate').val();
            var initialEndDate = $('.dashtodate').val();
            loadCourierSplit(initialStartDate, initialEndDate);

            $('.dashfromdate, .dashtodate').on('change', function () {
                var newStartDate = $('.dashfromdate').val();
                var newEndDate = $('.dashtodate').val();

                // console.log('Date changed');
                // console.log('New From Date:', newStartDate);
                // console.log('New To Date:', newEndDate);

                loadCourierSplit(newStartDate, newEndDate);
            });
        });


        function loadCourierSplit(newStartDate, newEndDate) {
            $.ajax({
                url: "#",
                type: "POST",
                data: {
                    start_date: newStartDate,
                    end_date: newEndDate,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    let data = response.totaldelhivery || [];
                    let colors = [
                        '#584BDC', '#357EFA', '#9B92E9', '#94BDF7', '#ACABCE',
                        '#C5C3F4', '#7CADF8', '#CFCDF9', '#D0DCEF'
                    ];
                    let html = '';

                    data.forEach((item, index) => {
                        let color = colors[index % colors.length];

                        html += `
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 mb-4 d-flex flex-column align-items-center">
                                            <div class="progress rounded-circle mb-2" data-value="${item.count}">
                                                <span class="progress-left">
                                                    <span class="progress-bar" style="border-color: ${color};"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar" style="border-color: ${color};"></span>
                                                </span>
                                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                    <div class="h5 font-weight-bold text-dark">
                                                        ${item.count}<sup class="small">%</sup>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center text-dark font-weight-bold small">
                                                ${item.courier_name}
                                            </div>

                                        </div>
                                    `;
                    });

                    $("#courierwiselead").html(html);

                    // If you have JS to animate the progress, call it here
                    animateProgress();
                }
            });
        }



        function animateProgress() {
            $(".progress").each(function () {
                let value = $(this).attr('data-value');
                let left = $(this).find('.progress-left .progress-bar');
                let right = $(this).find('.progress-right .progress-bar');

                if (value > 0) {
                    if (value <= 50) {
                        right.css('transform', `rotate(${percentageToDegrees(value)}deg)`);
                    } else {
                        right.css('transform', `rotate(180deg)`);
                        left.css('transform', `rotate(${percentageToDegrees(value - 50)}deg)`);
                    }
                }
            });
        }

        function percentageToDegrees(percentage) {
            return percentage / 100 * 360;
        }


    </script>

    {{-- delivery_performance_chart --}}

    <script>
        let myChart2 = null; // Global

        $(document).ready(function () {
            var initialStartDate = $('.dashfromdate').val();
            var initialEndDate = $('.dashtodate').val();
            loadDeliveryPerformance(initialStartDate, initialEndDate);

            $('.dashfromdate, .dashtodate').on('change', function () {
                var newStartDate = $('.dashfromdate').val();
                var newEndDate = $('.dashtodate').val();

                console.log('Date changed:', newStartDate, newEndDate);
                loadDeliveryPerformance(newStartDate, newEndDate);
            });
        });

        function loadDeliveryPerformance(newStartDate, newEndDate) {
            $.ajax({
                url: "#",
                type: "POST",
                data: {
                    start_date: newStartDate,
                    end_date: newEndDate,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    let labels = response.performanceLabelsStatus || [];
                    let dataValues = response.performanceDataStatus || [];

                    const chartColors = [
                        '#584BDC', '#357EFA', '#9B92E9', '#94BDF7', '#ACABCE',
                        '#C5C3F4', '#7CADF8', '#CFCDF9', '#D0DCEF'
                    ];

                    const ctx2 = document.getElementById('myChart2').getContext('2d');

                    // Destroy old chart if it exists
                    if (myChart2 !== null) {
                        myChart2.destroy();
                    }

                    // Create new chart
                    myChart2 = new Chart(ctx2, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Records',
                                data: dataValues,
                                backgroundColor: chartColors,
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    color: '#fff',
                                    font: {
                                        weight: 'bold',
                                        size: 14
                                    },
                                    formatter: (value, context) => {
                                        return `${value}`;
                                    },
                                    anchor: 'center',
                                    align: 'center',
                                    clamp: true,
                                    display: true
                                }
                            },
                            cutout: '50%'
                        },
                        plugins: [ChartDataLabels]
                    });
                }
            });
        }
    </script>


    <script>
        let myChart3 = null; // ✅ Define globally to persist across calls

        $(document).ready(function () {
            // Initial load with current input values
            var initialStartDate = $('.dashfromdate').val();
            var initialEndDate = $('.dashtodate').val();
            loadMyChart3(initialStartDate, initialEndDate);

            // On date change
            $('.dashfromdate, .dashtodate').on('change', function () {
                var newStartDate = $('.dashfromdate').val();
                var newEndDate = $('.dashtodate').val();

                console.log('Date changed:', newStartDate, newEndDate);
                loadMyChart3(newStartDate, newEndDate);
            });
        });

        function loadMyChart3(newStartDate, newEndDate) {
            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart3',
                    start_date: newStartDate,
                    end_date: newEndDate
                },
                success: function (response) {
                    const ctx3 = document.getElementById('myChart3').getContext('2d');

                    const chartColors = [
                        '#584BDC', '#357EFA', '#9B92E9', '#94BDF7', '#ACABCE',
                        '#C5C3F4', '#7CADF8', '#CFCDF9', '#D0DCEF'
                    ];

                    const chartData = {
                        labels: response.labels,
                        datasets: [{
                            label: 'Courier Mode Distribution',
                            data: response.data,
                            backgroundColor: chartColors,
                            hoverOffset: 4
                        }]
                    };

                    // Destroy previous chart instance if it exists
                    if (myChart3 !== null) {
                        myChart3.destroy();
                    }

                    // Create new doughnut chart
                    myChart3 = new Chart(ctx3, {
                        type: 'doughnut',
                        data: chartData,
                        options: {
                            plugins: {
                                datalabels: {
                                    color: '#fff',
                                    font: {
                                        weight: 'bold',
                                        size: 14
                                    },
                                    formatter: function (value, context) {
                                        return value;
                                    },
                                    anchor: 'center',
                                    align: 'center',
                                    clamp: true,
                                    display: true
                                }
                            },
                            cutout: '50%'
                        },
                        plugins: [ChartDataLabels]
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
    </script>


    <script>
        let myChart1 = null; // ✅ Declare globally

        $(document).ready(function () {
            // Initial load with current input values
            var initialStartDate = $('#overallfrom').val();
            var initialEndDate = $('#overallto').val();
            loadMyChart1(initialStartDate, initialEndDate);

            // On date change
            $('#overallfrom, #overallto').on('change', function () {
                var newStartDate = $('#overallfrom').val();
                var newEndDate = $('#overallto').val();

                console.log('Date changed for myChart1:', newStartDate, newEndDate);
                loadMyChart1(newStartDate, newEndDate);
            });
        });

        function loadMyChart1(newStartDate, newEndDate) {
            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart1',
                    start_date: newStartDate,
                    end_date: newEndDate
                },
                success: function (response) {
                    const container = $('#escalationsChart-container');
                    const canvasId = 'escalationsChart';



                    // ✅ Recreate canvas if it does not exist or was replaced by a div message
                    if (!document.getElementById(canvasId)) {
                        container.html('<canvas id="escalationsChart" width="400" height="400"></canvas>');
                    }

                    const ctx1 = document.getElementById(canvasId).getContext('2d');

                    const chartColors = [
                        '#584BDC', '#357EFA', '#9B92E9', '#94BDF7',
                        '#ACABCE', '#C5C3F4', '#7CADF8', '#CFCDF9', '#D0DCEF'
                    ];

                    const filteredLabels = [];
                    const filteredData = [];
                    const filteredColors = [];

                    if (response && response.data && response.data.length > 0) {
                        response.data.forEach((value, index) => {
                            if (value > 0) {
                                filteredLabels.push(response.labels[index]);
                                filteredData.push(value);
                                filteredColors.push(chartColors[index % chartColors.length]);
                            }
                        });
                    }

                    // ✅ If no data available
                    if (filteredData.length === 0) {
                        container.html('<div id="' + canvasId + '" class="text-center p-5 text-muted">No data available for this period.</div>');
                        if (myChart1) {
                            myChart1.destroy();
                            myChart1 = null;
                        }
                        return;
                    }

                    const chartData1 = {
                        labels: filteredLabels,
                        datasets: [{
                            label: 'Escalations Report',
                            data: filteredData,
                            backgroundColor: filteredColors,
                            hoverOffset: 4
                        }]
                    };

                    // Destroy previous chart instance if it exists
                    if (myChart1 !== null) {
                        myChart1.destroy();
                    }

                    // Create new doughnut chart
                    myChart1 = new Chart(ctx1, {
                        type: 'doughnut',
                        data: chartData1,
                        options: {
                            plugins: {
                                datalabels: {
                                    color: '#fff',
                                    font: {
                                        weight: 'bold',
                                        size: 14
                                    },
                                    formatter: function (value) {
                                        return value;
                                    },
                                    anchor: 'center',
                                    align: 'center',
                                    clamp: true,
                                    display: true
                                }
                            },
                            cutout: '50%' // inner circle
                        },
                        plugins: [ChartDataLabels]
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data for myChart1:', error);
                    $('#escalationsChart-container').html('<div id="escalationsChart" class="text-center p-5 text-danger">Error loading chart data.</div>');
                    if (myChart1) {
                        myChart1.destroy();
                        myChart1 = null;
                    }
                }
            });
        }
    </script>



    <script>
        let tatChartInstance = null;

        $(document).ready(function () {
            // Initial load with current input values
            var initialStartDate = $('#overallfrom').val();
            var initialEndDate = $('#overallto').val();
            loadTatChart(initialStartDate, initialEndDate);

            // On date change
            $('#overallfrom, #overallto').on('change', function () {
                var newStartDate = $('#overallfrom').val();
                var newEndDate = $('#overallto').val();

                console.log('Date changed for tatChart:', newStartDate, newEndDate);
                loadTatChart(newStartDate, newEndDate);
            });
        });

        function loadTatChart(newStartDate, newEndDate) {
            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'tatChart',
                    start_date: newStartDate,
                    end_date: newEndDate
                },
                success: function (response) {
                    const container = $('#tatChart-container');
                    const canvasId = 'tatChart';

                    // Recreate canvas if it does not exist or was replaced by a div message
                    if (!document.getElementById(canvasId)) {
                        container.html('<canvas id="tatChart" width="400" height="400"></canvas>');
                    }

                    const ctxTat = document.getElementById(canvasId).getContext('2d');

                    const allColors = [
                        '#584BDC', '#357EFA', '#9B92E9', '#94BDF7',
                        '#ACABCE', '#C5C3F4', '#7CADF8', '#CFCDF9', '#D0DCEF'
                    ];

                    const filteredLabels = [];
                    const filteredData = [];
                    const filteredColors = [];

                    if (response && response.data && response.data.length > 0) {
                        response.data.forEach((value, index) => {
                            if (value > 0) {
                                filteredLabels.push(response.labels[index]);
                                filteredData.push(value);
                                filteredColors.push(allColors[index % allColors.length]);
                            }
                        });
                    }

                    // If no data available
                    if (filteredData.length === 0) {
                        container.html('<div id="tatChart" class="text-center p-5 text-muted">No data available for this period.</div>');
                        if (tatChartInstance) {
                            tatChartInstance.destroy();
                            tatChartInstance = null;
                        }
                        return;
                    }

                    const tatChartData = {
                        labels: filteredLabels,
                        datasets: [{
                            label: 'Delivery performance by TAT',
                            data: filteredData,
                            backgroundColor: filteredColors,
                            hoverOffset: 4
                        }]
                    };

                    // Destroy previous chart instance if it exists
                    if (tatChartInstance !== null) {
                        tatChartInstance.destroy();
                    }

                    // Create new doughnut chart
                    tatChartInstance = new Chart(ctxTat, {
                        type: 'doughnut',
                        data: tatChartData,
                        options: {
                            plugins: {
                                datalabels: {
                                    color: '#fff',
                                    font: {
                                        weight: 'bold',
                                        size: 14
                                    },
                                    formatter: function (value) {
                                        return value;
                                    },
                                    anchor: 'center',
                                    align: 'center',
                                    clamp: true,
                                    display: true
                                }
                            },
                            cutout: '50%' // inner radius
                        },
                        plugins: [ChartDataLabels]
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data for tatChart:', error);
                    $('#tatChart-container').html('<div id="tatChart" class="text-center p-5 text-danger">Error loading chart data.</div>');
                    if (tatChartInstance) {
                        tatChartInstance.destroy();
                        tatChartInstance = null;
                    }
                }
            });
        }
    </script>




    <script>
        const today = new Date();
        const priorDate = new Date();
        priorDate.setDate(today.getDate() - 30);

        function formatDate(date) {
            let d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }

        document.getElementById('overallto').value = formatDate(today);
        document.getElementById('overallfrom').value = formatDate(priorDate);
    </script>




    {{-- <canvas id="myChart1" height="100"></canvas> --}}




    {{--
    <script>
        $(document).ready(function () {
            var formdate = $('.dashfromdate').val();
            var todate = $('.dashtodate').val();
            console.log('From Date:', formdate);
            console.log('To Date:', todate);
        });

        let chart;

        window.onload = function () {
            const volumelabels = @json($volumelabels);
            const codData = @json($codData);
            const prepaidData = @json($prepaidData);

            const formattedCOD = codData.map(v => !isNaN(parseFloat(v)) ? parseInt(v) : 0);
            const formattedPrepaid = prepaidData.map(v => !isNaN(parseFloat(v)) ? parseFloat(v).toFixed(2) : '0.00');

            const totalVolume = formattedCOD.map((val, i) => {
                const volume = parseFloat(val) + parseFloat(formattedPrepaid[i]);
                return !isNaN(volume) ? parseFloat(volume.toFixed(2)) : 0;
            });

            const grandTotal = totalVolume.reduce((acc, val) => acc + parseFloat(val), 0);
            const totalCOD = formattedCOD.reduce((acc, val) => acc + parseFloat(val), 0);
            const totalPrepaid = formattedPrepaid.reduce((acc, val) => acc + parseFloat(val), 0);

            const formattedGrandTotal = parseInt(grandTotal).toString();
            const formattedTotalCOD = parseInt(totalCOD).toString();
            const formattedTotalPrepaid = parseInt(totalPrepaid).toString();

            // ✅ If no data available, show message and stop chart
            if (!volumelabels.length || !totalVolume.some(v => parseFloat(v) > 0)) {
                document.getElementById('myChart1').style.display = 'none';
                document.getElementById('myChart1').insertAdjacentHTML('afterend', '<p style="text-align:center; color:#999;">📭 No order data available.</p>');
                return;
            }

            // Purple gradient colors
            const baseColors = ['#514C7F', '#615C8C', '#716D98', '#817DA5', '#918DB2', '#A19DBF', '#B1AEC8', '#C1BED8'];
            const repeatedColors = volumelabels.map((_, i) => baseColors[i % baseColors.length]);

            const ctx = document.getElementById('myChart1').getContext('2d');
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: volumelabels,
                    datasets: [{
                        label: `Total Volume (${formattedGrandTotal})`,
                        data: totalVolume,
                        backgroundColor: repeatedColors,
                        borderColor: repeatedColors,
                        borderWidth: 1,
                        borderRadius: 10,
                        barThickness: 15
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            formatter: function (value) {
                                return `${parseFloat(value)} Order`;
                            },
                            font: {
                                weight: 'bold'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return `${parseFloat(tooltipItem.raw)} Count`;
                                }
                            }
                        },
                        legend: {
                            labels: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            display: false
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            chart.allData = {
                volume: {
                    label: `Total Volume (${formattedGrandTotal})`,
                    data: totalVolume,
                    color: repeatedColors
                },
                cod: {
                    label: `COD Volume (${formattedTotalCOD})`,
                    data: formattedCOD,
                    color: repeatedColors
                },
                prepaid: {
                    label: `Prepaid Volume (${formattedTotalPrepaid})`,
                    data: formattedPrepaid,
                    color: repeatedColors
                }
            };
        };

        function updateChart(type) {
            if (!chart || !chart.allData[type]) return;

            const newData = chart.allData[type];
            const background = Array.isArray(newData.color)
                ? newData.color
                : Array(chart.data.labels.length).fill(newData.color);

            chart.data.datasets = [{
                label: newData.label,
                data: newData.data,
                backgroundColor: background,
                borderColor: background,
                borderWidth: 1,
                borderRadius: 10,
                barThickness: 15
            }];
            chart.update();
        }
    </script> --}}


    {{--
    <script>
        function delivery_Performance() { }
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const chartColors = [
            '#584BDC',
            '#357EFA',
            '#9B92E9',
            '#94BDF7',
            '#ACABCE',
            '#C5C3F4',
            '#7CADF8',
            '#CFCDF9',
            '#D0DCEF'
        ];

        // Chart data
        const data = {
            labels: @json($performanceLabelsStatus), // Example: ['Label 1', 'Label 2', ...]
            datasets: [{
                label: 'Total Records',
                data: @json($performanceDataStatus),  // Example: [10, 20, ...]
                backgroundColor: chartColors,
                hoverOffset: 4
            }]
        };

        // Create doughnut chart
        const myChart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: data,
            options: {
                plugins: {
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value, context) => {
                            const total = context.dataset.data.reduce((acc, curr) => acc + curr, 0);
                            return `${value}`; // You can also show percentage: `${percentage}%`
                        },
                        anchor: 'center',
                        align: 'center',
                        clamp: true,
                        display: true
                    }
                },
                cutout: '50%' // Inner radius for doughnut
            },
            plugins: [ChartDataLabels] // Enable the DataLabels plugin
        });
    </script> --}}


    <script>
        const ctx5 = document.getElementById('Seller_myChart').getContext('2d');
        const Seller_myChart = new Chart(ctx5, {
            type: 'doughnut',
            data: {
                labels: ['Weight Dispute Raised', 'Weight Dispute Accepted ', 'Weight Dispute Rejected', 'Weight Dispute Pending'],
                datasets: [{
                    label: 'Weight Discrepancies',
                    data: [33.3, 33.3, 33.3, 40],
                    backgroundColor: ['#584BDC', '#357EFA', '#9B92E9', '#94BDF7',
                        '#ACABCE', '#C5C3F4', '#7CADF8', '#CFCDF9', '#D0DCEF']
                }]
            },
            options: {
                responsive: true,

            }
        });
    </script>


    <script>
        $(function () {

            $(".progress").each(function () {

                var value = $(this).attr('data-value');
                var left = $(this).find('.progress-left .progress-bar');
                var right = $(this).find('.progress-right .progress-bar');

                if (value > 0) {
                    if (value <= 50) {
                        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                    } else {
                        right.css('transform', 'rotate(180deg)')
                        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                    }
                }

            })

            function percentageToDegrees(percentage) {

                return percentage / 100 * 360

            }

        });
    </script>


    <script>
        let myChart5;
        function loadChartData() {
            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart5',
                    start_date: $('#overallfrom').val(),
                    end_date: $('#overallto').val()
                },
                success: function (response) {
                    const details = response.details;
                    const labels = response.labels;

                    const shipped = details.map(d => d.total_shipped);
                    const pending = details.map(d => d.total_pending);
                    const delivered = details.map(d => d.total_delivered);
                    const transit = details.map(d => d.total_transit);
                    const rto = details.map(d => d.total_rto);
                    const ndr = details.map(d => d.total_ndr);
                    const cancelled = details.map(d => d.total_cancelled);
                    const lost = details.map(d => d.total_lost);

                    const ctx5 = document.getElementById('myChart5').getContext('2d');

                    if (myChart5) {
                        myChart5.destroy();
                    }

                    myChart5 = new Chart(ctx5, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Shipped',
                                    data: shipped,
                                    barThickness: 15,
                                    backgroundColor: '#514C7F'
                                },
                                {
                                    label: 'Pending',
                                    data: pending,
                                    barThickness: 15,
                                    backgroundColor: '#615C8C'
                                },
                                {
                                    label: 'Delivered',
                                    data: delivered,
                                    barThickness: 15,
                                    backgroundColor: '#716D98'
                                },
                                {
                                    label: 'In Transit',
                                    data: transit,
                                    barThickness: 15,
                                    backgroundColor: '#817DA5'
                                },
                                {
                                    label: 'RTO',
                                    data: rto,
                                    barThickness: 15,
                                    backgroundColor: '#918DB2'
                                },
                                {
                                    label: 'NDR',
                                    data: ndr,
                                    barThickness: 15,
                                    backgroundColor: '#A19DBF'
                                },
                                {
                                    label: 'Cancelled',
                                    data: cancelled,
                                    barThickness: 15,
                                    backgroundColor: '#B1AECb'
                                },
                                {
                                    label: 'Lost',
                                    data: lost,
                                    barThickness: 15,
                                    backgroundColor: '#607D8B'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                },
                                legend: {
                                    position: 'top'
                                }
                            },
                            scales: {
                                x: {
                                    stacked: true
                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true,
                                    grid: {
                                        display: false // remove horizontal grid lines
                                    },
                                    ticks: {
                                        display: false // remove y-axis numbers
                                    }
                                }
                            },

                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        $(document).ready(function () {
            loadChartData();
        });

        $('#overallfrom, #overallto').on('change', function () {
            loadChartData();
        });
    </script>



    <script>

        let statewiseNewChartInstance;

        function loadStatewiseNewChart() {
            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'statewisechart',
                    start_date: $('#overallfrom').val(),
                    end_date: $('#overallto').val()
                },
                success: function (response) {
                    const details = response.details || [];
                    const labels = response.labels || [];

                    const ctx = document.getElementById('statewisechart').getContext('2d');

                    // ✅ Destroy previous chart if it exists
                    if (statewiseNewChartInstance) {
                        statewiseNewChartInstance.destroy();
                    }

                    // ✅ Extract each status as dataset arrays
                    const shipped = details.map(d => d.total_shiped || 0);
                    const pending = details.map(d => d.total_pending || 0);
                    const delivered = details.map(d => d.total_Delivered || 0);
                    const transit = details.map(d => d.total_transit || 0);
                    const rto = details.map(d => d.total_rto || 0);
                    const ndr = details.map(d => d.total_ndr || 0);
                    const cancelled = details.map(d => d.total_Cancelled || 0);
                    const lost = details.map(d => d.total_Lost || 0);

                    statewiseNewChartInstance = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Shipped',
                                    data: shipped,
                                    barThickness: 15,
                                    backgroundColor: '#514C7F'
                                },
                                {
                                    label: 'Pending',
                                    data: pending,
                                    barThickness: 15,
                                    backgroundColor: '#615C8C'
                                },
                                {
                                    label: 'Delivered',
                                    data: delivered,
                                    barThickness: 15,
                                    backgroundColor: '#716D98'
                                },
                                {
                                    label: 'In Transit',
                                    data: transit,
                                    barThickness: 15,
                                    backgroundColor: '#817DA5'
                                },
                                {
                                    label: 'RTO',
                                    data: rto,
                                    barThickness: 15,
                                    backgroundColor: '#918DB2'
                                },
                                {
                                    label: 'NDR',
                                    data: ndr,
                                    barThickness: 15,
                                    backgroundColor: '#A19DBF'
                                },
                                {
                                    label: 'Cancelled',
                                    data: cancelled,
                                    barThickness: 15,
                                    backgroundColor: '#B1AEC8'
                                },
                                {
                                    label: 'Lost',
                                    data: lost,
                                    barThickness: 15,
                                    backgroundColor: '#607D8B'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                },
                                legend: {
                                    position: 'top'
                                }
                            },
                            scales: {
                                x: {
                                    stacked: true,

                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true,
                                    grid: {
                                        display: false // remove horizontal grid lines
                                    },
                                    ticks: {
                                        display: false // remove y-axis numbers
                                    }
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching statewise data:', error);
                }
            });
        }

        // ✅ Load on page ready
        $(document).ready(function () {
            loadStatewiseNewChart();
        });

        // ✅ Reload on date change
        $('#overallfrom, #overallto').on('change', function () {
            loadStatewiseNewChart();
        });
    </script>


    <script>
        let myChart6 = null;
        function loadMyChart6() {
            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart6',
                    start_date: $('#overallfrom').val(),
                    end_date: $('#overallto').val()
                },
                success: function (response) {
                    const container = $('#Allocation-container');
                    const canvasId = 'Allocation';

                    // ✅ Recreate canvas if it does not exist or was replaced by a div message
                    if (!document.getElementById(canvasId)) {
                        container.html('<canvas id="Allocation" width="400" height="400"></canvas>');
                    }

                    const ctx6 = document.getElementById(canvasId).getContext('2d');

                    const chartColors = [
                        '#584BDC', '#357EFA', '#9B92E9',
                        '#94BDF7', '#ACABCE', '#C5C3F4',
                        '#7CADF8', '#CFCDF9', '#D0DCEF'
                    ];

                    const filteredLabels = [];
                    const filteredData = [];
                    const filteredColors = [];

                    if (response && response.data && response.data.length > 0) {
                        response.data.forEach((value, index) => {
                            if (value > 0) {
                                filteredLabels.push(response.labels[index]);
                                filteredData.push(value);
                                filteredColors.push(chartColors[index % chartColors.length]);
                            }
                        });
                    }

                    // ✅ If no data available
                    if (filteredData.length === 0) {
                        container.html('<div id="' + canvasId + '" class="text-center p-5 text-muted">No data available for this period.</div>');
                        if (myChart6) {
                            myChart6.destroy();
                            myChart6 = null;
                        }
                        return;
                    }

                    const totalVolume6 = filteredData.reduce((acc, val) => acc + val, 0);

                    const data6 = {
                        labels: filteredLabels,
                        datasets: [{
                            label: `Total: ${totalVolume6}`,
                            data: filteredData,
                            borderWidth: 2,
                            backgroundColor: filteredColors,
                            hoverOffset: 4
                        }]
                    };

                    // Destroy previous chart instance if it exists
                    if (myChart6 !== null) {
                        myChart6.destroy();
                    }

                    // Create new doughnut chart
                    myChart6 = new Chart(ctx6, {
                        type: 'doughnut',
                        data: data6,
                        options: {
                            plugins: {
                                datalabels: {
                                    color: '#fff',
                                    font: {
                                        weight: 'bold',
                                        size: 14
                                    },
                                    formatter: function (value) {
                                        return value;
                                    },
                                    anchor: 'center',
                                    align: 'center',
                                    clamp: true,
                                    display: true
                                }
                            },
                            cutout: '50%'
                        },
                        plugins: [ChartDataLabels]
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data for myChart6:', error);
                    $('#Allocation-container').html('<div id="Allocation" class="text-center p-5 text-danger">Error loading chart data.</div>');
                    if (myChart6) {
                        myChart6.destroy();
                        myChart6 = null;
                    }
                }
            });
        }

        $(document).ready(function () {
            loadMyChart6();
        });

        $('#overallfrom, #overallto').on('change', function () {
            // alert('6');
            loadMyChart6();
        });
    </script>

    <script>
        function loadMyChart7() {
            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart7',
                    start_date: $('#overallfrom').val(),
                    end_date: $('#overallto').val()
                },
                success: function (response) {
                    const details = response.details;
                    const labels = response.labels;
                    const shipped = details.map(d => d.total_shiped);
                    const pending = details.map(d => d.total_pending);
                    const delivered = details.map(d => d.total_Delivered);
                    const transit = details.map(d => d.total_transit);
                    const rto = details.map(d => d.total_rto);
                    const ndr = details.map(d => d.total_ndr);
                    const cancelled = details.map(d => d.total_Cancelled);
                    const lost = details.map(d => d.total_Lost);

                    const ctx7 = document.getElementById('status').getContext('2d');

                    if (window.myChart7) {
                        window.myChart7.destroy();
                    }

                    window.myChart7 = new Chart(ctx7, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Shipped',
                                    data: shipped,
                                    barThickness: 15,
                                    backgroundColor: '#514C7F'
                                },
                                {
                                    label: 'Pending',
                                    data: pending,
                                    barThickness: 15,
                                    backgroundColor: '#615C8C'
                                },
                                {
                                    label: 'Delivered',
                                    data: delivered,
                                    barThickness: 15,
                                    backgroundColor: '#716D98'
                                },
                                {
                                    label: 'In Transit',
                                    data: transit,
                                    barThickness: 15,
                                    backgroundColor: '#817DA5'
                                },
                                {
                                    label: 'RTO',
                                    data: rto,
                                    barThickness: 15,
                                    backgroundColor: '#918DB2'
                                },
                                {
                                    label: 'NDR',
                                    data: ndr,
                                    barThickness: 15,
                                    backgroundColor: '#A19DBF'
                                },
                                {
                                    label: 'Cancelled',
                                    data: cancelled,
                                    barThickness: 15,
                                    backgroundColor: '#B1AECb'
                                },
                                {
                                    label: 'Lost',
                                    data: lost,
                                    barThickness: 15,
                                    backgroundColor: '#607D8B'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    callbacks: {
                                        title: function (context) {
                                            return context[0].label || '';
                                        }
                                    }
                                },
                                legend: {
                                    position: 'top'
                                }
                            },
                            scales: {
                                x: {
                                    stacked: true
                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true,
                                    grid: {
                                        display: false // remove horizontal grid lines
                                    },
                                    ticks: {
                                        display: false // remove y-axis numbers
                                    }
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching myChart7 data:', error);
                }
            });
        }

        $(document).ready(function () {
            loadMyChart7();
        });

        $('#overallfrom, #overallto').on('change', function () {
            // alert('7');
            loadMyChart7();
        });
    </script>


    <script>

        function loadMyChart9() {
            let myChart9;

            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart9',
                    start_date: $('#overallfrom').val(),
                    end_date: $('#overallto').val()
                },
                success: function (response) {
                    const details = response.details;
                    const labels = response.labels;

                    // Extract order statuses
                    const shipped = details.map(d => d.total_shiped);
                    const pending = details.map(d => d.total_pending);
                    const delivered = details.map(d => d.total_Delivered);
                    const transit = details.map(d => d.total_transit);
                    const rto = details.map(d => d.total_rto);
                    const ndr = details.map(d => d.total_ndr);
                    const cancelled = details.map(d => d.total_Cancelled);
                    const lost = details.map(d => d.total_Lost);

                    const ctx9 = document.getElementById('Product').getContext('2d');

                    if (window.myChart9) {
                        window.myChart9.destroy();
                    }

                    window.myChart9 = new Chart(ctx9, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Shipped',
                                    data: shipped,
                                    barThickness: 15,
                                    backgroundColor: '#514C7F'
                                },
                                {
                                    label: 'Pending',
                                    data: pending,
                                    barThickness: 15,
                                    backgroundColor: '#615C8C'
                                },
                                {
                                    label: 'Delivered',
                                    data: delivered,
                                    barThickness: 15,
                                    backgroundColor: '#716D98'
                                },
                                {
                                    label: 'In Transit',
                                    data: transit,
                                    barThickness: 15,
                                    backgroundColor: '#817DA5'
                                },
                                {
                                    label: 'RTO',
                                    data: rto,
                                    barThickness: 15,
                                    backgroundColor: '#918DB2'
                                },
                                {
                                    label: 'NDR',
                                    data: ndr,
                                    barThickness: 15,
                                    backgroundColor: '#A19DBF'
                                },
                                {
                                    label: 'Cancelled',
                                    data: cancelled,
                                    barThickness: 15,
                                    backgroundColor: '#B1AECb'
                                },
                                {
                                    label: 'Lost',
                                    data: lost,
                                    barThickness: 15,
                                    backgroundColor: '#607D8B'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                },
                                legend: {
                                    position: 'top'
                                }
                            },
                            scales: {
                                x: {
                                    stacked: true
                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true,
                                    grid: {
                                        display: false // remove horizontal grid lines
                                    },
                                    ticks: {
                                        display: false // remove y-axis numbers
                                    }
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching myChart9 data:', error);
                }
            });


        }


        $(document).ready(function () {
            loadMyChart9();
        });

        $('#overallfrom, #overallto').on('change', function () {
            // alert('9');
            loadMyChart9();
        });
    </script>

    <script>

        function loadMyChart11() {
            let myChart11;
            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart11',
                    start_date: $('#overallfrom').val(),
                    end_date: $('#overallto').val()
                },
                success: function (response) {
                    const ctx11 = document.getElementById('Codchart').getContext('2d');
                    if (window.myChart11) {
                        window.myChart11.destroy();
                    }

                    const labels = response.labels;

                    // alert(labels);

                    const shipped = response.Shipped_Amount?.map(Number) || [];
                    const pending = response.Pending_Amount?.map(Number) || [];
                    const delivered = response.Delivered_Amount?.map(Number) || [];
                    const transit = response.transit_Cod_Amount?.map(Number) || [];
                    const rto = response.rto_Cod_Amount?.map(Number) || [];
                    const ndr = response.ndr_Cod_Amount?.map(Number) || [];
                    const cancelled = response.cancelled_Cod_Amount?.map(Number) || [];
                    const lost = response.lost_Cod_Amount?.map(Number) || [];

                    window.myChart11 = new Chart(ctx11, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Shipped',
                                    data: shipped,
                                    barThickness: 12,
                                    backgroundColor: '#514C7F'
                                },
                                {
                                    label: 'Pending',
                                    data: pending,
                                    barThickness: 12,
                                    backgroundColor: '#615C8C'
                                },
                                {
                                    label: 'Delivered',
                                    data: delivered,
                                    barThickness: 12,
                                    backgroundColor: '#716D98'
                                },
                                {
                                    label: 'In Transit',
                                    data: transit,
                                    barThickness: 12,
                                    backgroundColor: '#817DA5'
                                },
                                {
                                    label: 'RTO',
                                    data: rto,
                                    barThickness: 12,
                                    backgroundColor: '#918DB2'
                                },
                                {
                                    label: 'NDR',
                                    data: ndr,
                                    barThickness: 12,
                                    backgroundColor: '#A19DBF'
                                },
                                {
                                    label: 'Cancelled',
                                    data: cancelled,
                                    barThickness: 12,
                                    backgroundColor: '#B1AECb'
                                },
                                {
                                    label: 'Lost',
                                    data: lost,
                                    barThickness: 12,
                                    backgroundColor: '#607D8B'
                                }
                            ]
                        },
                        options: {
                            indexAxis: 'y', // horizontal bar chart
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    callbacks: {
                                        label: function (context) {
                                            const val = context.parsed.x || 0;
                                            return `${context.dataset.label}: {{currency_symbol()}}${val.toLocaleString()}`;
                                        }
                                    }
                                },
                                legend: {
                                    position: 'top'
                                }
                            },
                            scales: {
                                x: {
                                    stacked: true,
                                    beginAtZero: true,

                                    beginAtZero: true,
                                    grid: {
                                        display: false // remove horizontal grid lines
                                    },
                                    ticks: {
                                        display: false // remove y-axis numbers
                                    }
                                },
                                y: {
                                    stacked: true
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });

        }

        $(document).ready(function () {
            loadMyChart11();
        });

        $('#overallfrom, #overallto').on('change', function () {
            // alert('11');
            loadMyChart11();
        });

    </script>

    <script>
        $(document).ready(function () {

            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart8',
                    start_date: $('#overallfrom').val(),
                    end_date: $('#overallto').val()
                },
                success: function (response) {
                    // alert('hello');
                    //  console.log(response);
                    const volumedatadData8 = response.data.map(value => value.toFixed(2));
                    const totalvolume8 = volumedatadData8.reduce((acc, value) => acc + parseFloat(
                        value), 0).toFixed(2);

                    const ctx8 = document.getElementById('status1');

                    const data8 = {
                        labels: response.labels,
                        datasets: [{
                            label: totalvolume8,
                            data: response.data,
                            borderWidth: 2,
                            backgroundColor: Utils.barColors(chartData.length),
                            barThickness: 50
                        }]

                    };

                    myChart8 = new Chart(ctx8, {
                        type: 'doughnut',
                        data: data8,
                    });

                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });





            let myChart10;

            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart11',
                    start_date: $('#overallfrom').val(),
                    end_date: $('#overallto').val()
                },
                success: function (response) {
                    const volumedata = response.data.map(value => parseFloat(value.toFixed(2)));
                    const totalVolume = volumedata.reduce((acc, value) => acc + value, 0);

                    const ctx = document.getElementById('Volumetrendchart').getContext('2d');

                    if (window.myChart10) {
                        window.myChart10.destroy();
                    }

                    // Custom color palette
                    const chartColors = [
                        '#584BDC', '#357EFA', '#9B92E9', '#94BDF7',
                        '#ACABCE', '#C5C3F4', '#7CADF8', '#CFCDF9', '#D0DCEF'
                    ];

                    const data = {
                        labels: response.labels,
                        datasets: [{
                            label: `Total COD Volume: {{currency_symbol()}}${totalVolume.toFixed(2)}`,
                            data: volumedata,
                            backgroundColor: chartColors.slice(0, volumedata.length),
                            hoverOffset: 4
                        }]
                    };

                    window.myChart10 = new Chart(ctx, {
                        type: 'doughnut',
                        data: data,
                        options: {
                            plugins: {
                                datalabels: {
                                    color: function (context) {
                                        return context.dataset.backgroundColor[context.dataIndex];
                                    },
                                    font: {
                                        weight: 'bold',
                                        size: 14
                                    },
                                    formatter: function (value, context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percent = ((value / total) * 100).toFixed(1);
                                        return percent + '%';
                                    },
                                    anchor: 'center',
                                    align: 'center',
                                    clamp: true,
                                    display: true
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const percent = totalVolume > 0 ? ((value / totalVolume) * 100).toFixed(1) : 0;
                                            return `${label}: {{currency_symbol()}}${value.toLocaleString()} (${percent}%)`;
                                        }
                                    }
                                }
                            },
                            cutout: '50%'
                        },
                        plugins: [ChartDataLabels]
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching COD pie chart data:', error);
                }
            });




            let myChart12;

            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart12',
                    start_date: $('#overallfrom').val(),
                    end_date: $('#overallto').val()
                },
                success: function (response) {
                    const ctx12 = document.getElementById('Prepaidchart').getContext('2d');

                    if (window.myChart12) {
                        window.myChart12.destroy();
                    }

                    const labels = response.labels;

                    const shipped = response.Shipped_Amount?.map(Number) || [];
                    const pending = response.Pending_Amount?.map(Number) || [];
                    const delivered = response.Delivered_Amount?.map(Number) || [];
                    const transit = response.transit_Prepaid_Amount?.map(Number) || [];
                    const rto = response.rto_Prepaid_Amount?.map(Number) || [];
                    const ndr = response.ndr_Prepaid_Amount?.map(Number) || [];
                    const cancelled = response.cancelled_Prepaid_Amount?.map(Number) || [];
                    const lost = response.lost_Prepaid_Amount?.map(Number) || [];

                    window.myChart12 = new Chart(ctx12, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Shipped',
                                    data: shipped,
                                    barThickness: 12,
                                    backgroundColor: '#514C7F'
                                },
                                {
                                    label: 'Pending',
                                    data: pending,
                                    barThickness: 12,
                                    backgroundColor: '#615C8C'
                                },
                                {
                                    label: 'Delivered',
                                    data: delivered,
                                    barThickness: 12,
                                    backgroundColor: '#716D98'
                                },
                                {
                                    label: 'In Transit',
                                    data: transit,
                                    barThickness: 12,
                                    backgroundColor: '#817DA5'
                                },
                                {
                                    label: 'RTO',
                                    data: rto,
                                    barThickness: 12,
                                    backgroundColor: '#918DB2'
                                },
                                {
                                    label: 'NDR',
                                    data: ndr,
                                    barThickness: 12,
                                    backgroundColor: '#A19DBF'
                                },
                                {
                                    label: 'Cancelled',
                                    data: cancelled,
                                    barThickness: 12,
                                    backgroundColor: '#B1AEC8'
                                },
                                {
                                    label: 'Lost',
                                    data: lost,
                                    barThickness: 12,
                                    backgroundColor: '#607D8B'
                                }
                            ]
                        },
                        options: {
                            indexAxis: 'y', // horizontal bar chart
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    callbacks: {
                                        label: function (context) {
                                            const val = context.parsed.x || 0;
                                            return `${context.dataset.label}: {{currency_symbol()}}${val.toLocaleString()}`;
                                        }
                                    }
                                },
                                legend: {
                                    position: 'top'
                                }
                            },
                            scales: {
                                x: {
                                    stacked: true,
                                    beginAtZero: true,

                                    beginAtZero: true,
                                    grid: {
                                        display: false // remove horizontal grid lines
                                    },
                                    ticks: {
                                        display: false // remove y-axis numbers
                                    }
                                },
                                y: {
                                    stacked: true
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });

            let myChart14;

            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart12',
                    start_date: $('#overallfrom').val(),
                    end_date: $('#overallto').val()
                },
                success: function (response) {
                    const volumedatadData14 = response.data.map(value => parseFloat(value.toFixed(2)));
                    const totalvolume14 = volumedatadData14.reduce((acc, value) => acc + value, 0)
                        .toFixed(2);

                    const ctx14 = document.getElementById('Codpie').getContext('2d');

                    if (window.myChart14) {
                        window.myChart14.destroy();
                    }
                    const chartColors = [
                        '#584BDC', '#357EFA', '#9B92E9', '#94BDF7',
                        '#ACABCE', '#C5C3F4', '#7CADF8', '#CFCDF9', '#D0DCEF'
                    ];

                    const data14 = {
                        labels: response.labels,
                        datasets: [{
                            label: `Total Volume: {{currency_symbol()}}${totalvolume14}`,
                            data: volumedatadData14,
                            borderWidth: 2,
                            backgroundColor: chartColors.slice(0, volumedatadData14.length),

                        }]
                    };

                    window.myChart14 = new Chart(ctx14, {
                        type: 'doughnut',
                        data: data14,
                        options: {
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const percent = totalvolume14 ? ((value /
                                                totalvolume14) * 100).toFixed(1) : 0;
                                            return `${label}: {{currency_symbol()}}${value.toLocaleString()} (${percent}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });



            // $.ajax({
            //     url: "#",
            //     type: "GET",
            //     data: {
            //         type: 'myChart13',
            //         start_date: $('#overallfrom').val(),
            //         end_date: $('#overallto').val()
            //     },
            //     success: function (response) {
            //         // alert('hello');
            //         //  console.log(response);
            //         const volumedatadData13 = response.data.map(value => value.toFixed(2));
            //         const totalvolume13 = volumedatadData13.reduce((acc, value) => acc + parseFloat(
            //             value), 0).toFixed(2);

            //         const Prepaidchart = document.getElementById('Codbar');


            //         if (window.myChart13) {
            //             window.myChart13.destroy();
            //         }
            //         window.myChart13 = new Chart(Prepaidchart, {
            //             type: 'bar',
            //             data: {
            //                 labels: response.labels,
            //                 datasets: [{
            //                     label: 'Prepaid',
            //                     data: response.data,
            //                     borderRadius: 30,
            //                     borderWidth: 2,
            //                     backgroundColor: Utils.CHART_COLORS.fill,
            //                     barThickness: 20
            //                 }]
            //             },
            //             options: {
            //                 indexAxis: 'y',
            //                 scales: {
            //                     x: {
            //                         beginAtZero: true,
            //                         ticks: {
            //                             stepSize: 1000
            //                         }
            //                     }
            //                 },
            //                 plugins: {
            //                     legend: {
            //                         display: false
            //                     },
            //                     tooltip: {
            //                         callbacks: {
            //                             label: function (context) {
            //                                 return context.raw.toLocaleString();
            //                             }
            //                         }
            //                     }
            //                 }
            //             }
            //         });

            //     },
            //     error: function (xhr, status, error) {
            //         console.error('Error fetching data:', error);
            //     }
            // });



            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    type: 'myChart16'
                },
                success: function (response) {
                    // alert('hello');
                    //  console.log(response);
                    const volumedatadData16 = response.data.map(value => value.toFixed(2));
                    const totalvolume16 = volumedatadData16.reduce((acc, value) => acc + parseFloat(
                        value), 0).toFixed(2);

                    const Airpie = document.getElementById('Airpie');

                    const data16 = {
                        labels: response.labels,
                        datasets: [{
                            label: totalvolume16,
                            data: response.data,
                            backgroundColor: [
                                '#584BDC',
                                '#357EFA',
                                '#94BDF7'
                            ],
                            hoverOffset: 4
                        }]
                    };

                    new Chart(Airpie, {
                        type: 'doughnut',
                        data: data16,
                    });

                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>



    <script>
        const CODpie = document.getElementById('CODpie');
        const CODpiedata = {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    '#584BDC',
                    '#357EFA',
                    '#94BDF7'
                ],
                hoverOffset: 4
            }]
        };
        new Chart(CODpie, {
            type: 'doughnut',
            data: CODpiedata,
        });
    </script>


    <script>
        const NDDpie = document.getElementById('NDDpie');
        const NDDpiedata = {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    '#584BDC',
                    '#357EFA',
                    '#94BDF7'
                ],
                hoverOffset: 4
            }]
        };

        new Chart(NDDpie, {
            type: 'doughnut',
            data: NDDpiedata,
        });
    </script>



    <script>
        const AIRpie = document.getElementById('Surface3d');

        const AIRpiedata = {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    '#584BDC',
                    '#357EFA',
                    '#94BDF7'
                ],
                hoverOffset: 4
            }]
        };

        new Chart(AIRpie, {
            type: 'doughnut',
            data: AIRpiedata,
        });
    </script>


    <script>
        const SDDpie = document.getElementById('SDDpie');

        const SDDpiedata = {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    '#584BDC',
                    '#357EFA',
                    '#94BDF7'
                ],
                hoverOffset: 4
            }]
        };

        new Chart(SDDpie, {
            type: 'doughnut',
            data: SDDpiedata,
        });



    </script>

    {{-- Surface3d --}}


    <style>
        .modal-backdrop.show {
            opacity: 0 !important;
            z-index: 0;
        }
    </style>

@endsection