@extends('user.dashboard.layout.master')
@section('user-contant')
    <style>
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

        .card-header {
            border-bottom: 0px !important;
        }



        .card .card-header {
            /*border-bottom-color: #f9f9f9;*/
            /* line-height: 30px; */
            -ms-grid-row-align: center;
            align-self: center;
            width: 100%;
            /* padding: 10px 16px !important; */
            display: flex;
            align-items: center;
        }


        .card .card-header h4 {
            font-size: 17px;
            line-height: 28px;
            /*padding: 10px 16px !important;*/
            margin-bottom: 0;
            color: #212529;

        }

        .delivery_addcss h4 {
            font-size: 15px;
            color: #212529;
            padding: 10px 16px !important;
        }

        .grid-item {
            word-wrap: break-word;
            /* Break long words if necessary */
            white-space: pre-wrap;
            /* Preserve whitespace and wrap the text */
            overflow-wrap: break-word;
            /* Handle word breaking */
            word-break: break-word;
            /* Handle word breaking in some older browsers */
            max-width: 100%;
            /* Ensure it doesn't overflow its container */
        }

        .list-group-item.active {
            background: #ffc107;
        }

        /* end common class */
        .top-status ul {
            list-style: none;
            display: flex;
            justify-content: space-around;
            justify-content: center;
            flex-wrap: wrap;
            padding: 0;
            margin: 0;
        }

        .top-status ul li {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            border: 8px solid #ddd;
            box-shadow: 1px 1px 10px 1px #ddd inset;
            margin: 10px 5px;
        }

        .top-status ul li.active {
            border-color: #ffc107;
            box-shadow: 1px 1px 20px 1px #ffc107 inset;
        }
    </style>

    <style>
        .container {
            width: 384px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .progres-bar {
            position: relative;
            display: flex;
            height: 300px;
            width: 100%;

            flex-direction: column;
            justify-content: space-between;
        }

        .progress-container {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .progress-container span {
            position: absolute;
            height: 20px;
            width: 20px;
            margin: 0;
            background-color: #a3a1a1;
            border-radius: 50%;
        }

        .progres-bar::before {
            content: "";
            position: absolute;
            top: 0;
            left: 49.5%;
            height: 100%;
            width: 4px;
            background-color: blue;
        }

        .progress-step {
            position: absolute;
            left: 220px;
        }

        .progress-date {
            position: absolute;
            right: 220px;
        }

        .active {
            background-color: blue !important;
            z-index: 1;
        }

        .end {
            background-color: rgb(32, 215, 32) !important;
        }
    </style>

    <div class="loader"></div>
    <div class="main-content">
        <section class="section">
            <div class="row d-flex">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="card h-100">
                        @if (!empty($singleproquery) && count($singleproquery) > 0)
                            @foreach ($singleproquery as $data)
                                <div class="card-header">
                                    <h4 style="border-bottom:1px solid #c7cccf; width:100%;">Orders Shipment Summary</h4>
                                </div>
                                </hr>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 style="border-bottom:1px solid black;">Order Information</h4>
                                    </div>
                                    <table class="table table-sm dsfffd">
                                        <tbody>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Order Number :</th>
                                                <td>{{ $data->orderno ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>AWB Number :</th>
                                                <td>{{ $data->Awb_Number ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Date :</th>
                                                <td>{{ date('d-m-Y  H:i:s', strtotime($data->Rec_Time_Stamp)) }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Order Type :</th>
                                                <td>{{ $data->Order_Type ?? '' }}</td>

                                            </tr>
                                            @if ($data->Order_Type == 'cod' || $data->Order_Type == 'Cod' || $data->Order_Type == 'COD')
                                                <tr>
                                                    <th scope="row"></th>
                                                    <th>COD Value :</th>
                                                    <td>{{ $data->Cod_Amount ?? '' }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Order Status :</th>
                                                <td>{{ $data->order_status1 == 'Shipped' ? 'Pending Pickup' : $data->order_status1 }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Courier :</th>
                                                <td>{{ $data->courier_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Declarest Weight :</th>
                                                <td>{{ $data->Actual_Weight ?? '' }} KG</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Physical Weight :</th>
                                                <td>{{ $data->Actual_Weight ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Dimension :</th>
                                                <td>{{ $data->Length ?? '' }} x
                                                    {{ $data->Width ?? '' }} x
                                                    {{ $data->Height ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th>Volumetric Weight :</th>
                                                <td>{{ $data->VolumetricWeigh ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card">

                                    <div class="card-header">
                                        <h4 style="border-bottom:1px solid black;">Shipping Information</h4>
                                    </div>

                                    <div class="delivery_addcss">
                                        <h4>Delivery Address</h4>
                                    </div>


                                    <table class="table table-sm dsfffd">
                                        <tbody>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Name :</th>
                                                <td>{{ $data->Name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Address1 :</th>
                                                <td>{{ $data->Address ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Address2 :</th>
                                                <td>{{ $data->Address2 ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Landmark :</th>
                                                <td>{{ $data->landmark ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Mobile :</th>
                                                <td>{{ $data->Mobile ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>City :</th>
                                                <td>{{ $data->City ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>State :</th>
                                                <td>{{ $data->State ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Country :</th>
                                                <td>INDIA</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Pincode :</th>
                                                <td>{{ $data->Pincode ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <div class="card">
                                    <div class="delivery_addcss">
                                        <h4>Pickup Address</h4>
                                    </div>

                                    <table class="table table-sm dsfffd">
                                        <tbody>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Name :</th>
                                                <td>{{ $data->ware_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Address :</th>
                                                <td>{{ $data->sell_add ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>City :</th>
                                                <td>{{ $data->pickcity ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>State :</th>
                                                <td>{{ $data->pick_state ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th>Mobile :</th>
                                                <td>{{ $data->sell_phone ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th>Pincode :</th>
                                                <td>{{ $data->sell_pin ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                @php
                                    $pick_state = $data->pick_state;
                                @endphp
                            @endforeach


                    </div>
                </div>

                <?php
                $current_statusdata = $data->order_status1 ?? '';
                $current_statusdata = $current_statusdata == 'Shipped' ? 'Pending Pickup' : $current_statusdata;
                $current_statusdata = $current_statusdata == 'In Transit' ? 'Intransit' : $current_statusdata;
                $current_statusdata = $current_statusdata == 'Delivered' ? 'Delivered' : $current_statusdata;
                $current_statusdata = $current_statusdata == 'OFD' ? 'Out For Delivery' : $current_statusdata;
                $current_statusdata = $current_statusdata == 'RTO' ? 'RTO' : $current_statusdata;
                $current_statusdata = $current_statusdata == 'Lost' ? 'Lost' : $current_statusdata;
                $current_statusdata = $current_statusdata == 'Cancelled' ? 'Cancelled' : $current_statusdata;
                $current_statusdata = $current_statusdata == 'Failed' ? 'Failed' : $current_statusdata;
                $current_statusdata = $current_statusdata == 'Processing' ? 'Processing' : $current_statusdata;
                $current_statusdata = $current_statusdata == 'Upload' ? 'Ready To Ship' : $current_statusdata;
                $current_statusdata = $current_statusdata == 'Undelivered' ? 'Undelivered' : $current_statusdata;
                ?>

                <?php if ($current_statusdata == 'Pending Pickup') {
                    echo 'aa';
                } elseif ($current_statusdata == 'Intransit') {
                    echo 'bb';
                } elseif ($current_statusdata == 'Delivered') {
                    echo 'cc';
                } elseif ($current_statusdata == 'Out For Delivery') {
                    echo 'dd';
                } elseif ($current_statusdata == 'RTO') {
                    echo 'ee';
                } elseif ($current_statusdata == 'Lost') {
                    echo 'ff';
                } elseif ($current_statusdata == 'Cancelled') {
                    echo 'gg';
                } elseif ($current_statusdata == 'Failed') {
                    echo 'hh';
                } elseif ($current_statusdata == 'Processing') {
                    echo 'ii';
                } elseif ($current_statusdata == 'Ready To Ship') {
                    echo 'jj';
                } elseif ($current_statusdata == 'Undelivered') {
                    echo 'kk';
                }
                
                ?>

                <style>
                    .card .d-flex {
                        padding: 10px 15px;
                    }
                </style>
                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Current Status</h6>
                                            <h4 style="color: #ffcc00;">{{ $current_statusdata }}</h4>
                                        </div>
                                        <div>
                                            <span style="color: black;">Last Updated on
                                                {{ now()->format('d M Y, l') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 style="font-size: 14px; color: black;">
                                <img src="{{ asset('img/track.png') }}" alt="shadow" class="img-fluid"
                                    style="width: 20%; height: 45px;">
                                &nbsp;&nbsp;&nbsp;&nbsp;Real Time Tracking
                            </h3>
                            {{-- <h2>&nbsp; Real Time Tracking</h2> --}}
                        </div>
                        <div class="card-body">
                            <div class="container px-6">
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="progres-bar">
                                                    @foreach ($allStatusLogs as $key => $logs)
                                                        <div class="progress-container">
                                                            <div class="progress-date">
                                                                <h6>{{ \Carbon\Carbon::parse($logs->created_at)->format('M d, Y') }}
                                                                </h6>
                                                                <small>{{ \Carbon\Carbon::parse($logs->created_at)->format('D, H:i') }}</small>
                                                            </div>
                                                            <span class="active"></span>
                                                            <div class="progress-step">
                                                                <h6>{{ $logs->order_status1 ?? 'No Status' }}</h6>
                                                                <small><img src="{{ asset('img/MapPin.png') }}"
                                                                        alt=""
                                                                        style="height: 20px;">{{ $pick_state }}</small>
                                                            </div>
                                                        </div>

                                                        @if ($current_statusdata == 'Cancelled')
                                                            <div class="progress-container">
                                                                <div class="progress-date">
                                                                </div>
                                                                <span class="" style="background-color : red;"></span>
                                                                <div class="progress-step">
                                                                    <h6 style="color:red;"><?php echo $current_statusdata; ?></h6>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>

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
@else
    {{-- <div class="row"> --}}
    <div class="text-align : center;">
        <h5 style="color: red;">No record Found</h5>
    </div>
    {{-- </div> --}}
    @endif


@endsection
