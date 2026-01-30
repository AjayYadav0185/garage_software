@php
    $allStages = ['Ready To Ship', 'Shipped', 'In-trasit', 'OFD', 'Delivered'];
@endphp

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

        .tracking-timeline {
            max-height: 500px;
            overflow-y: auto;
        }

        .timeline-item {
            position: relative;
            padding-left: 25px !important;
            border-left: 4px solid #007bff !important;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .timeline-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .timeline-item.border-success {
            border-left-color: #28a745 !important;
        }

        .timeline-item:before {
            content: '';
            position: absolute;
            left: -10px;
            top: 20px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #007bff;
            border: 3px solid #fff;
            box-shadow: 0 0 0 3px #007bff;
            z-index: 1;
        }

        .timeline-item.border-success:before {
            background-color: #28a745;
            box-shadow: 0 0 0 3px #28a745;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .timeline-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
        }

        .timeline-item.border-success .timeline-content {
            background: linear-gradient(135deg, #d4edda 0%, #f8f9fa 100%);
            border-color: #28a745;
        }

        .badge {
            font-size: 0.75em;
            padding: 0.5em 0.75em;
        }

        .badge-success {
            background-color: #28a745 !important;
        }

        .badge-info {
            background-color: #17a2b8 !important;
        }

        .badge-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }

        /* Card styling */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        .card-header.bg-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {

            .timeline-item .row .col-md-3,
            .timeline-item .row .col-md-6 {
                margin-bottom: 8px;
            }

            .timeline-item {
                padding-left: 20px !important;
            }

            .timeline-item:before {
                left: -8px;
                width: 12px;
                height: 12px;
            }
        }

        /* Loading spinner */
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        /* Icons */
        .fas {
            width: 16px;
            text-align: center;
        }
    </style>
    <style>
        /* Gradient Header */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
        }

        /* Modal Body Timeline */
        .tracking-timeline {
            padding-left: 0.75rem;
            max-height: 500px;
            overflow-y: auto;
        }

        .timeline-item {
            position: relative;
            padding-left: 25px !important;
            border-left: 4px solid #007bff !important;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .timeline-item:hover {
            transform: translateX(4px);
            background-color: #f9f9f9;
            border-left-color: #0056b3 !important;
        }

        .timeline-item:before {
            content: '';
            position: absolute;
            left: -10px;
            top: 15px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #007bff;
            border: 3px solid #fff;
            box-shadow: 0 0 0 3px #007bff;
        }

        .timeline-item.border-success {
            border-left-color: #28a745 !important;
        }

        .timeline-item.border-success:before {
            background-color: #28a745;
            box-shadow: 0 0 0 3px #28a745;
            animation: pulse 2s infinite;
        }

        .timeline-content {
            background: #ffffff;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e0e0e0;
            position: relative;
        }

        .timeline-content h6 {
            font-weight: 600;
        }

        .timeline-content small {
            color: #6c757d;
        }

        /* Badges */
        .badge {
            font-size: 0.75em;
            padding: 0.45em 0.7em;
            border-radius: 0.4rem;
        }

        .badge-success {
            background-color: #28a745 !important;
        }

        .badge-info {
            background-color: #17a2b8 !important;
        }

        .badge-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }

        /* Pulse animation */
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Spinner */
        .spinner-border {
            width: 2.5rem;
            height: 2.5rem;
        }

        .modal-content {
            border-radius: 1rem;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .timeline-item {
                padding-left: 15px !important;
            }

            .timeline-item:before {
                left: -8px;
                top: 12px;
                width: 12px;
                height: 12px;
            }
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
                                                    {{ $data->Height ?? '' }}
                                                </td>
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
                                        {{-- <h4>Delivery Address</h4> --}}
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
                                                <td>{{ $data->Address2 ?? 'Not available' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Landmark :</th>
                                                <td>{{ $data->landmark ?? 'Not available' }}</td>
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
                                    <div class="card-header">
                                        {{-- <h4>Pickup Address</h4> --}}
                                        <h4 style="border-bottom:1px solid black;">Pickup Address</h4>
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

                                <div class="card">
                                    <div class="card-header">
                                        {{-- <h4>Pickup Address</h4> --}}
                                        <h4 style="border-bottom:1px solid black;">Product Information</h4>
                                    </div>
                                    <table class="table table-sm dsfffd">
                                        <tbody>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Product Name :</th>
                                                <td>{{ $data->Item_Name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Product Category :</th>
                                                <td>{{ $data->item_cate ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Product Quantity :</th>
                                                <td>{{ $data->Quantity ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <th>Product Value :</th>
                                                <td>{{ $data->Invoice_Value ?? '' }}</td>
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
                    // echo 'aa';
                } elseif ($current_statusdata == 'Intransit') {
                    // echo 'bb';
                } elseif ($current_statusdata == 'Delivered') {
                    // echo 'cc';
                } elseif ($current_statusdata == 'Out For Delivery') {
                    // echo 'dd';
                } elseif ($current_statusdata == 'RTO') {
                    // echo 'ee';
                } elseif ($current_statusdata == 'Lost') {
                    // echo 'ff';
                } elseif ($current_statusdata == 'Cancelled') {
                    // echo 'gg';
                } elseif ($current_statusdata == 'Failed') {
                    // echo 'hh';
                } elseif ($current_statusdata == 'Processing') {
                    // echo 'ii';
                } elseif ($current_statusdata == 'Ready To Ship') {
                    // echo 'jj';
                } elseif ($current_statusdata == 'Undelivered') {
                    // echo 'kk';
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"></h5>
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="awb_input" id="awb_input"
                                    value="{{ $data->Awb_Number ?? '' }}">
                                @if (!in_array($data->awb_gen_by, ['1', '2', '3', '4']))
                                    <button type="button" class="btn btn-outline-primary update">
                                        Real-Time Tracking
                                    </button>
                                @else
                                    <button type="button" class="btn btn-outline-primary update1">
                                        Real-Time Tracking
                                    </button>
                                @endif
                            </form>

                        </div>

                        @php
                            $defaultStages = [
                                'Ready to ship',
                                'Shipped',
                                'Pending for Pickup',
                                'In Transit',
                                'Cancelled',
                                'Out for Delivery',
                                'Delivered',
                            ];

                            $normalize = fn($stage) => strtolower(str_replace(' ', '', $stage));
                            $normalizedDefaultStages = array_map($normalize, $defaultStages);

                            $actualStagesNormalized = collect($allStatusLogs)
                                ->map(fn($log) => $normalize($log->order_status_show))
                                ->unique()
                                ->values()
                                ->all();

                            // Check if cancelled is present
                            $cancelPresent = in_array('cancelled', $actualStagesNormalized);

                            $allStagesList = [];
                            foreach ($normalizedDefaultStages as $stage) {
                                if ($stage === 'cancelled') {
                                    if ($cancelPresent) {
                                        $allStagesList[] = $stage;
                                    }
                                } else {
                                    $allStagesList[] = $stage;
                                }
                            }

                            $cancelledIndex = array_search('cancelled', $allStagesList);

                            if ($cancelledIndex !== false) {
                                // Keep all elements up to and including "cancelled"
                                $allStagesList = array_slice($allStagesList, 0, $cancelledIndex + 1);
                            }

                            $statusLogMap = [];
                            foreach ($allStatusLogs as $log) {
                                $key = $normalize($log->order_status_show);
                                $statusLogMap[$key] = $log;
                            }

                            // Determine reached stage
                            if ($cancelPresent) {
                                $reachedStageIndex = array_search('cancelled', $allStagesList);
                            } else {
                                $reachedStageIndex = 0;
                                foreach ($allStagesList as $i => $stage) {
                                    if (in_array($stage, $actualStagesNormalized)) {
                                        $reachedStageIndex = $i;
                                    }
                                }
                            }

                            $minStepHeight = 130;
                            $maxStepHeight = 150;
                            $extraHeightPerStage = 20;

                            $stepHeights = [];
                            $lineHeight = 0;

                            foreach ($allStagesList as $stageKey) {
                                $log = $statusLogMap[$stageKey] ?? null;
                                $messageLength = strlen($log->order_status_show ?? '');
                                $hasLocation = false;

                                if ($log && $log->json) {
                                    $jsonData = json_decode($log->json, true);
                                    $location = $jsonData['location'] ?? [];
                                    $hasLocation =
                                        !empty($location['city'] ?? '') ||
                                        !empty($location['stateOrRegion'] ?? '') ||
                                        !empty($location['postalCode'] ?? '');
                                }

                                $height = $minStepHeight;
                                if ($messageLength > 100) {
                                    $height += $extraHeightPerStage;
                                }
                                if ($hasLocation) {
                                    $height += $extraHeightPerStage;
                                }
                                $height = min($height, $maxStepHeight);

                                $stepHeights[] = $height;
                                $lineHeight += $height;
                            }

                            $completedLineHeight = 0;
                            for ($i = 0; $i < $reachedStageIndex; $i++) {
                                if (isset($stepHeights[$i])) {
                                    $completedLineHeight += $stepHeights[$i];
                                }
                            }

                        @endphp

                        <div class="card-body">
                            <div>
                                <div
                                    style="max-width: 400px; margin: auto; background: #fff; padding: 30px 40px; border-radius: 8px; box-shadow: 0 0 12px rgba(0,0,0,0.1);">
                                    <h2 style="margin: 0 0 10px 0; color: #222;">Order Tracking</h2>
                                    <p style="margin: 0 0 30px 0; color: #555; font-size: 14px;">
                                        Order #<strong>{{ $data->orderno ?? 'N/A' }}</strong>
                                    </p>

                                    <div style="position: relative;">
                                        <!-- Timeline Vertical Line -->
                                        <div
                                            style="position: absolute; left: 20px; top: 10px; height: {{ $lineHeight }}px; width: 4px; border-radius: 2px; background: #ddd;">
                                            <div
                                                style="width: 100%; height: {{ $completedLineHeight }}px; background: #4caf50; border-radius: 2px 2px 0 0;">
                                            </div>
                                        </div>

                                        <!-- Steps -->
                                        @php
                                        @endphp


                                        @foreach ($allStagesList as $index => $normalizedStageKey)
                                            @php
                                                $isCancelled = $normalizedStageKey === 'cancelled';

                                                if ($normalizedStageKey == 'readytoship') {
                                                    $log = $statusLogMap['upload'] ?? null;
                                                }elseif ($normalizedStageKey == 'readytoship') {
                                                    $log = $statusLogMap['cancelled'] ?? null;
                                                } else {
                                                    $log = $statusLogMap[$normalizedStageKey] ?? null;
                                                }

                                                // Determine if reached:
                                                if ($isCancelled) {
                                                    // Mark cancelled stage as reached always (even if log null)
                                                    $isReached = true;
                                                } else {
                                                    // For other stages, only reached if index <= reachedStageIndex AND log is NOT null
                                                    $isReached = $index <= $reachedStageIndex && $log !== null;
                                                }

                                                $stepColor = $isCancelled
                                                    ? '#f44336'
                                                    : ($isReached
                                                        ? '#4caf50'
                                                        : '#ccc');
                                                $textColor = $isCancelled
                                                    ? '#f44336'
                                                    : ($isReached
                                                        ? '#4caf50'
                                                        : '#999');

                                                $jsonData = $log && $log->json ? json_decode($log->json, true) : null;

                                                if ($normalizedStageKey == 'readytoship') {
                                                    $eventTime = $log->ready_to_ship_date ?? null;
                                                } elseif ($normalizedStageKey == 'cancelled') {
                                                    $eventTime = $log->canceldatetime ?? null;
                                                } elseif ($normalizedStageKey == 'shipped') {
                                                    $eventTime = $log->shipped_date ?? null;
                                                } else {
                                                    $eventTime = $jsonData['eventTime'] ?? null;
                                                }

                                                $location = $jsonData['location'] ?? null;
                                                $city = $location['city'] ?? null;
                                                $state = $location['stateOrRegion'] ?? null;
                                                $postalCode = $location['postalCode'] ?? null;

                                                $dateFormatted = $eventTime
                                                    ? \Carbon\Carbon::parse($eventTime)
                                                        ->setTimezone('Asia/Kolkata')
                                                        ->format('M d, Y')
                                                    : '—';

                                                $timeFormatted = $eventTime
                                                    ? \Carbon\Carbon::parse($eventTime)
                                                        ->setTimezone('Asia/Kolkata')
                                                        ->format('D, H:i')
                                                    : '—';

                                                $originalLabel =
                                                    $defaultStages[
                                                        array_search($normalizedStageKey, $normalizedDefaultStages)
                                                    ];
                                                $statusLabel = match ($normalizedStageKey) {
                                                    'ofd', 'outfordelivery' => 'Out for Delivery',
                                                    'rto' => 'RTO',
                                                    'lost' => 'Lost',
                                                    'cancelled', 'cancel' => 'Cancelled',
                                                    'readytoship' => 'Ready to Ship',
                                                    'shipped' => 'Manifested',
                                                    default => $originalLabel,
                                                };

                                                $statusMessage = $log
                                                    ? $log->order_status_show ?? 'Waiting for update'
                                                    : ($isCancelled
                                                        ? 'Cancelled'
                                                        : 'Waiting for update');
                                            @endphp

                                            <div style="position: relative; padding-left: 50px; margin-bottom: 40px;">
                                                <div
                                                    style="
                position: absolute;
                left: 12px;
                top: 2px;
                width: 20px;
                height: 20px;
                background-color: {{ $isReached ? $stepColor : '#fff' }};
                border-radius: 50%;
                border: 3px solid {{ $stepColor }};
                box-sizing: border-box;
                display: flex;
                justify-content: center;
                align-items: center;
                color: {{ $isReached ? '#fff' : '#bbb' }};
                font-weight: bold;
                font-size: 14px;">
                                                    @if ($isCancelled)
                                                        ✖
                                                    @elseif ($isReached)
                                                        ✔
                                                    @else
                                                        {{ $index + 1 }}
                                                    @endif
                                                </div>

                                                <div
                                                    style="font-weight: 600; font-size: 16px; color: {{ $textColor }};">
                                                    {{ $statusLabel }}
                                                </div>
                                                <div
                                                    style="color: #555; font-size: 14px; margin-top: 4px; line-height: 1.4;">
                                                    {{ $statusMessage }}
                                                </div>

                                                @if ($city || $state || $postalCode)
                                                    <div style="font-size: 13px; color: #666; margin-top: 4px;">
                                                        {{ implode(', ', array_filter([$city, $state, $postalCode])) }}
                                                    </div>
                                                @endif

                                                <div style="margin-top: 6px;">
                                                    <h6 style="margin: 0; font-size: 13px; color: #333;">
                                                        {{ $dateFormatted }}</h6>
                                                    <small style="color: #888;">{{ $timeFormatted }}</small>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                @else
                    <div class="text-align : center;">
                        <h5 style="color: red;">No record Found</h5>
                    </div>
                    @endif
                </div>
        </section>
    </div>

    {{-- Modal --}}

    <div class="modal fade tracking-modal" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-lg border-0">

                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <i class="fas fa-shipping-fast mr-2"></i> AWB Tracking Details
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4" style="max-height: 70vh; overflow-y: auto;">
                    <div id="modal-body-content" class="tracking-timeline">
                        <!-- Dynamic timeline content -->
                    </div>

                    <span id="spanerror1" class="text-danger d-none"></span>
                    <span id="spanerror2" class="text-danger d-none"></span>
                    <input type="hidden" id="hiddenup_id">
                </div>

                <div class="modal-footer bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->




    <script>
        $(document).ready(function() {

            $('body').on('click', '.update', function(e) {

                var awb_number = $(this).closest('form').find('#awb_input').val();

                console.log('AWB Number found:', awb_number); // Debug log

                if (!awb_number) {
                    alert('AWB number is required');
                    return;
                }

                $("#staticBackdrop").modal("show");
                $("#spanerror2").text("");
                $("#spanerror1").text("");


                $("#modal-body-content").html(
                    '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
                );


                var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]')
                    .val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.gettrackingdetails') }}",
                    data: {
                        awb_number: awb_number,
                        _token: csrfToken
                    },
                    dataType: 'json',
                    timeout: 30000,
                    success: function(response) {
                        console.log('API Response:', response); // Debug log
                        if (response.success && response.data) {
                            var data = response.data;
                            var trackingHtml = '';

                            // Basic info section with card design
                            trackingHtml += '<div class="card mb-4">';
                            trackingHtml += '<div class="card-header bg-primary text-white">';
                            trackingHtml +=
                                '<h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Shipment Information</h5>';
                            trackingHtml += '</div>';
                            trackingHtml += '<div class="card-body">';
                            trackingHtml += '<div class="row">';
                            trackingHtml += '<div class="col-md-4">';
                            trackingHtml +=
                                '<p><strong>AWB Number:</strong><br><span style="color: blue!important;">' +
                                data.airwaybill_no + '</span></p>';
                            trackingHtml += '</div>';
                            trackingHtml += '<div class="col-md-4">';
                            trackingHtml += '<p><strong>Current Status:</strong><br>';
                            trackingHtml += '<span class="badge badge-' + getStatusBadgeClass(
                                data.status_name) + '">' + data.status_name + '</span>';
                            trackingHtml += '</p>';
                            trackingHtml += '</div>';
                            trackingHtml += '<div class="col-md-4">';
                            trackingHtml += '<p><strong>Delivery Date:</strong><br>' + (data
                                    .delivery_date ||
                                    '<span class="text-muted">Not delivered yet</span>') +
                                '</p>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';

                            // Tracking timeline with improved design
                            if (data.tracking_detail && data.tracking_detail.length > 0) {
                                trackingHtml += '<div class="card">';
                                trackingHtml +=
                                    '<div class="card-header bg-success text-white">';
                                trackingHtml +=
                                    '<h5 class="mb-0"><i class="fas fa-route mr-2"></i>Tracking Timeline</h5>';
                                trackingHtml += '</div>';
                                trackingHtml += '<div class="card-body">';
                                trackingHtml += '<div class="timeline">';

                                data.tracking_detail.forEach(function(item, index) {
                                    var isLast = (index === data.tracking_detail
                                        .length - 1);
                                    var eventClass = getEventClassForTracking(item
                                        .scan);

                                    trackingHtml += '<div class="timeline-item ' + (!
                                            isLast ? 'timeline-item-with-line' : '') +
                                        '">';
                                    trackingHtml += '<div class="timeline-content">';
                                    trackingHtml += '<div class="timeline-header">';
                                    trackingHtml += '<h6 class="timeline-title">' + item
                                        .scan + '</h6>';
                                    trackingHtml += '<small class="text-muted">' +
                                        formatDateTime(item.scan_date_time) +
                                        '</small>';
                                    trackingHtml += '</div>';

                                    // Location info
                                    if (item.location) {
                                        trackingHtml +=
                                            '<div class="timeline-location">';
                                        trackingHtml +=
                                            '<i class="fas fa-map-marker-alt text-muted mr-1"></i>';
                                        trackingHtml += '<span class="text-muted">' +
                                            item.location + '</span>';
                                        trackingHtml += '</div>';
                                    }

                                    // Remarks/Description
                                    if (item.remark) {
                                        trackingHtml +=
                                            '<div class="timeline-description">';
                                        trackingHtml += '<p class="text-muted mb-0">' +
                                            item.remark + '</p>';
                                        trackingHtml += '</div>';
                                    }

                                    trackingHtml += '</div>';
                                    trackingHtml += '</div>';
                                });

                                trackingHtml += '</div>';
                                trackingHtml += '</div>';
                                trackingHtml += '</div>';
                            } else {
                                trackingHtml += '<div class="card">';
                                trackingHtml += '<div class="card-body text-center">';
                                trackingHtml +=
                                    '<p class="text-muted">No tracking events available for this shipment.</p>';
                                trackingHtml += '</div>';
                                trackingHtml += '</div>';
                            }

                            $("#modal-body-content").html(trackingHtml);
                        } else {
                            var message = response.message ||
                                'No tracking data found for this AWB number.';
                            $("#modal-body-content").html(
                                '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle mr-2"></i>' +
                                message + '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error Details:');
                        console.error('Status:', status);
                        console.error('Error:', error);
                        console.error('Response Text:', xhr.responseText);
                        console.error('Status Code:', xhr.status);

                        var errorMessage = 'Error fetching tracking data. ';

                        if (xhr.status === 0) {
                            errorMessage += 'Network error.';
                        } else if (xhr.status === 404) {
                            errorMessage += 'Route not found.';
                        } else if (xhr.status === 500) {
                            errorMessage += 'Server error.';
                        } else if (status === 'timeout') {
                            errorMessage += 'Request timed out.';
                        } else {
                            errorMessage += 'Status: ' + xhr.status + ' - ' + error;
                        }

                        $("#modal-body-content").html(
                            '<div class="alert alert-danger"><i class="fas fa-exclamation-circle mr-2"></i>' +
                            errorMessage +
                            '<br><small>Check console for details.</small></div>');
                    }
                });
            });

            // Helper function to format date and time
            function formatDateTime(dateTimeString) {
                if (!dateTimeString) return 'N/A';

                try {
                    var date = new Date(dateTimeString);

                    var day = ('0' + date.getDate()).slice(-2);
                    var month = ('0' + (date.getMonth() + 1)).slice(-2); // Months are 0-based
                    var year = date.getFullYear();

                    var hours = ('0' + date.getHours()).slice(-2);
                    var minutes = ('0' + date.getMinutes()).slice(-2);
                    var seconds = ('0' + date.getSeconds()).slice(-2);

                    return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
                } catch (e) {
                    return dateTimeString; // Return original if parsing fails
                }
            }

            // Helper function for tracking event styling
            function getEventClassForTracking(scanType) {
                switch (scanType.toLowerCase()) {
                    case 'delivered':
                        return 'bg-success';
                    case 'out for delivery':
                    case 'ofd':
                        return 'bg-warning';
                    case 'in transit':
                    case 'shipped':
                    case 'pickup':
                        return 'bg-info';
                    case 'cancelled':
                    case 'returned':
                        return 'bg-danger';
                    default:
                        return 'bg-secondary';
                }
            }

        });

        $('body').on('click', '.update1', function(e) {

            var awb_number = $(this).closest('form').find('#awb_input').val();

            console.log('AWB Number found:', awb_number); // Debug log

            if (!awb_number) {
                alert('AWB number is required');
                return;
            }

            $("#staticBackdrop").modal("show");
            $("#spanerror2").text("");
            $("#spanerror1").text("");

            $("#modal-body-content").html(
                '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
            );

            var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val();

            $.ajax({
                type: "POST",
                url: "{{ route('user.getamazontrackingdetails') }}", // Updated route name
                data: {
                    awb_number: awb_number,
                    _token: csrfToken
                },
                dataType: 'json',
                timeout: 30000,
                success: function(response) {
                    //console.log('API Response:', response); // Debug log
                    if (response.success && response.data) {
                        var data = response.data;

                        var trackingHtml = '';

                        // Basic info section
                        trackingHtml += '<div class="card mb-4">';
                        trackingHtml += '<div class="card-header bg-primary text-white">';
                        trackingHtml +=
                            '<h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Shipment Information</h5>';
                        trackingHtml += '</div>';
                        trackingHtml += '<div class="card-body">';
                        trackingHtml += '<div class="row">';
                        trackingHtml += '<div class="col-md-4">';
                        trackingHtml +=
                            '<p><strong>AWB Number:</strong><br><span style="color: blue!important;">' +
                            data.awb_number + '</span></p>';
                        trackingHtml += '</div>';
                        trackingHtml += '<div class="col-md-4">';
                        trackingHtml += '<p><strong>Current Status:</strong><br>';
                        trackingHtml += '<span class="badge badge-' + getStatusBadgeClass(data
                                .processed_status.current_status) + '">' + data.processed_status
                            .current_status + '</span>';
                        trackingHtml += '</p>';
                        trackingHtml += '</div>';
                        trackingHtml += '</div>';

                        // Additional status info
                        // if (data.processed_status.attempt_count > 0) {
                        //     trackingHtml += '<div class="row mt-3">';
                        //     trackingHtml += '<div class="col-md-6">';
                        //     trackingHtml += '<p><strong>Delivery Attempts:</strong> ' + data.processed_status.attempt_count + '</p>';
                        //     trackingHtml += '</div>';
                        //     if (data.processed_status.is_rto) {
                        //         trackingHtml += '<div class="col-md-6">';
                        //         trackingHtml += '<p><strong>RTO Status:</strong> <span class="badge badge-warning">Return to Origin</span></p>';
                        //         trackingHtml += '</div>';
                        //     }
                        //     trackingHtml += '</div>';
                        // }

                        // Alternate tracking ID if available
                        if (data.alternate_tracking_id) {
                            trackingHtml += '<div class="row mt-3">';
                            trackingHtml += '<div class="col-12">';
                            trackingHtml += '<p><strong>Alternate Tracking ID:</strong> ' + data
                                .alternate_tracking_id + '</p>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                        }

                        trackingHtml += '</div>';
                        trackingHtml += '</div>';

                        // Tracking timeline
                        if (data.event_history && data.event_history.length > 0) {
                            trackingHtml += '<div class="card">';
                            trackingHtml += '<div class="card-header bg-success text-white">';
                            trackingHtml +=
                                '<h5 class="mb-0"><i class="fas fa-route mr-2"></i>Tracking Timeline</h5>';
                            trackingHtml += '</div>';
                            trackingHtml += '<div class="card-body">';
                            trackingHtml += '<div class="timeline">';

                            data.event_history.forEach(function(item, index) {
                                var isLast = (index === data.event_history.length - 1);
                                var eventClass = getEventClass(item.event_code);

                                trackingHtml += '<div class="timeline-item ' + (!isLast ?
                                    'timeline-item-with-line' : '') + '">';
                                // trackingHtml += '<div class="timeline-marker ' + eventClass + '">';
                                // trackingHtml += '<i class="fas ' + getEventIcon(item.event_code) + '"></i>';
                                // trackingHtml += '</div>';
                                trackingHtml += '<div class="timeline-content">';
                                trackingHtml += '<div class="timeline-header">';
                                trackingHtml += '<h6 class="timeline-title">' + formatEventCode(
                                    item.event_code) + '</h6>';
                                trackingHtml += '<small class="text-muted">' + item.event_time +
                                    '</small>';
                                trackingHtml += '</div>';

                                // Location info if available
                                if (item.location && (item.location.city || item.location
                                        .stateOrRegion || item.location.countryCode)) {
                                    trackingHtml += '<div class="timeline-location">';
                                    trackingHtml +=
                                        '<i class="fas fa-map-marker-alt text-muted mr-1"></i>';
                                    var locationParts = [];
                                    if (item.location.city) locationParts.push(item.location
                                        .city);
                                    if (item.location.stateOrRegion) locationParts.push(item
                                        .location.stateOrRegion);
                                    if (item.location.countryCode) locationParts.push(item
                                        .location.countryCode);
                                    trackingHtml += '<span class="text-muted">' + locationParts
                                        .join(', ') + '</span>';
                                    trackingHtml += '</div>';
                                }

                                // Description if available
                                if (item.description) {
                                    trackingHtml += '<div class="timeline-description">';
                                    trackingHtml += '<p class="text-muted mb-0">' + item
                                        .description + '</p>';
                                    trackingHtml += '</div>';
                                }

                                trackingHtml += '</div>';
                                trackingHtml += '</div>';
                            });

                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                        } else {
                            trackingHtml += '<div class="card">';
                            trackingHtml += '<div class="card-body text-center">';
                            trackingHtml +=
                                '<p class="text-muted">No tracking events available for this shipment.</p>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                        }

                        $("#modal-body-content").html(trackingHtml);
                    } else {
                        var message = response.message || 'No tracking data found for this AWB number.';
                        $("#modal-body-content").html(
                            '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle mr-2"></i>' +
                            message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error Details:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    console.error('Status Code:', xhr.status);

                    var errorMessage = 'Error fetching tracking data. ';

                    if (xhr.status === 0) {
                        errorMessage += 'Network error.';
                    } else if (xhr.status === 404) {
                        errorMessage += 'Route not found.';
                    } else if (xhr.status === 500) {
                        errorMessage += 'Server error.';
                    } else if (status === 'timeout') {
                        errorMessage += 'Request timed out.';
                    } else {
                        errorMessage += 'Status: ' + xhr.status + ' - ' + error;
                    }

                    $("#modal-body-content").html(
                        '<div class="alert alert-danger"><i class="fas fa-exclamation-circle mr-2"></i>' +
                        errorMessage + '<br><small>Check console for details.</small></div>');
                }
            });
        });

        // Helper functions for styling and formatting
        function getStatusBadgeClass(status) {
            switch (status.toLowerCase()) {
                case 'delivered':
                    return 'success';
                case 'ofd':
                case 'out for delivery':
                    return 'warning';
                case 'in transit':
                case 'shipped':
                    return 'info';
                case 'cancelled':
                case 'pickupcancelled':
                case 'lost':
                case 'undelivered':
                    return 'danger';
                case 'rto':
                    return 'warning';
                default:
                    return 'secondary';
            }
        }

        function getEventClass(eventCode) {
            switch (eventCode.toLowerCase()) {
                case 'delivered':
                    return 'bg-success';
                case 'outfordelivery':
                    return 'bg-warning';
                case 'intransit':
                case 'readyforreceive':
                    return 'bg-info';
                case 'pickupcancelled':
                case 'cancelled':
                    return 'bg-danger';
                case 'pickupdone':
                    return 'bg-primary';
                default:
                    return 'bg-secondary';
            }
        }

        function getEventIcon(eventCode) {
            switch (eventCode.toLowerCase()) {
                case 'delivered':
                    return 'fa-check-circle';
                case 'outfordelivery':
                    return 'fa-truck';
                case 'intransit':
                    return 'fa-route';
                case 'pickupdone':
                    return 'fa-box';
                case 'pickupcancelled':
                case 'cancelled':
                    return 'fa-times-circle';
                case 'readyforreceive':
                    return 'fa-clock';
                default:
                    return 'fa-circle';
            }
        }

        function formatEventCode(eventCode) {
            // Convert camelCase to readable format
            return eventCode.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
        }
    </script>
@endsection
