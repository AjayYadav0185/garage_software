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

        .nav-item-card {
            cursor: pointer;
        }

        .grey-bg {
            background-color: #F5F7FA;
        }

        .card-content-body {
            text-align: center;
        }

        .icon-center {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: #f0f0f0;
            margin: 0 auto 1rem auto;
            /* Center the icon and space below */
        }

        .icon-center i {
            font-size: 2.5rem;
            /* Adjust icon size as needed */
            color: #333;
            /* Adjust icon color as needed */
        }

        .card-content-body h3 {
            margin: 0;
        }

        .card-content-body span {
            display: block;
            margin-top: 0.5rem;
            font-size: 1rem;
        }

        .progress {
            margin-top: 1rem;
        }

        h3 {
            font-size: 1rem;
        }
    </style>
    <div class="loader"></div>

    <div class="main-content supreme-container">
        <section class="section" style="margin-top:-34px;">
            <div class="section-body">
                <div class="row card">
                    <div class="card-header" style="display: block;">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                        class="btn btn-primary go_forbtn"
                                        style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;"
                                        data-toggle="tooltip" data-placement="top" title="Go Back">
                                        <i class="fa-sharp fa fa-arrow-left"></i>
                                    </a>&nbsp;&nbsp;
                                    <h4 class="mb-0">Courier Priority</h4>
                                </div>
                            </div>
                        </div>
                        <hr>
      <?php

$cards = [
    [
        'title' => 'Recommended By Rappidx',
        'icon' => 'fas fa-thumbs-up primary',
        'bgColor' => '#00b5b824',
        'href' => '#description',
        'ariaControls' => 'description',
        'active' => true,
    ],
    [
        'title' => 'Customize',
        'icon' => 'fas fa-cogs warning',
        'bgColor' => '#ffa87d47',
        'href' => '#history',
        'ariaControls' => 'history',
        'active' => false,
    ],
    [
        'title' => 'Fastest',
        'icon' => 'fas fa-tachometer-alt success',
        'bgColor' => '#16d39a2e',
        'href' => '#deals',
        'ariaControls' => 'deals',
        'active' => false,
    ],
    [
        'title' => 'Cheapest',
        'icon' => 'fas fa-dollar-sign danger',
        'bgColor' => '#ff75882e',
        'href' => '#total_pincodes',
        'ariaControls' => 'total_pincodes',
        'active' => false,
    ],
    [
        'title' => 'Best Rating',
        'icon' => 'fas fa-star info',
        'bgColor' => '#2dcee333',
        'href' => '#activated_pincodes',
        'ariaControls' => 'activated_pincodes',
        'active' => false,
    ],
];

// Remove "Customize" card for users with role == 2
if (get_role(Auth::user()->usertype) == 2) {
    $cards = array_filter($cards, function ($card) {
        return $card['title'] !== 'Customize';
    });
    // Reindex array if needed
    $cards = array_values($cards);
}
?>


                        <ul class="nav nav-pills card-header-pills nav-justified m-2" id="bologna-list" role="tablist">
                            <?php foreach ($cards as $card): ?>
                            <li class="nav-item nav-item-card">
                                <div class="col">
                                    <div class="card" style="width: 200px; height: 150px; padding: 20px;">
                                        <div class="card-content">
                                            <div class="card-content-body">
                                                <div class="icon-center" style="background-color: <?= $card['bgColor'] ?>;">
                                                    <i class="<?= $card['icon'] ?>"></i>
                                                </div>
                                                <h3 class="card-title"><?= $card['title'] ?></h3>
                                                <a class="nav-link d-none <?= $card['active'] ? 'active' : '' ?>"
                                                    href="<?= $card['href'] ?>" role="tab"
                                                    aria-controls="<?= $card['ariaControls'] ?>"
                                                    aria-selected="<?= $card['active'] ? 'true' : 'false' ?>">
                                                    <?= $card['title'] ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                    <div class="card-body tab_shadow">
                        <div class="tab-content mt-3">
                            <div class="tab-pane active" id="description" role="tabpanel">
                                <div class="card-header">
                                    <h4>Recommended By Rappidx</h4>
                                    <div class="card-header-action">
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped py-5"
                                            style="text-align: center">
                                            <thead>
                                                <tr class="table-active">
                                                    <th class="border">
                                                        <strong style="color: black;">Logo</strong>
                                                    </th>
                                                    <th class="border">
                                                        <strong style="color: black;">Provider
                                                        </strong>
                                                    </th>
                                                    <th class="border">
                                                        <strong style="color: black;">Icon
                                                        </strong>
                                                    </th>
                                                    <th class="border">
                                                        <strong style="color: black;">Pickup Cutoff
                                                        </strong>
                                                    </th>
                                                    {{-- <th class="border">
                                                        <strong style="color: black;">Action Date
                                                        </strong>
                                                    </th> --}}

                                                </tr>
                                            </thead>
                                            <tbody class="sortable-table"
                                                id="{{ get_role(Auth::user()->usertype) == 2 ? 'my-table-id4' : 'no' }}">
                                                @forelse($recByAdmin as $row)
                                                    <tr id="{{ $row->id }}">
                                                        @php
                                                            $path = 'assets/img/courier_logo/';
                                                            $final_logo = $path . $row->courier_logo;
                                                        @endphp
                                                        <td class="border">
                                                            <img src="{{ $final_logo }}" style="width:50px;">
                                                        </td>
                                                        <td class="border">{{ $row->courier_name }}</td>
                                                        <td class="text-center border">
                                                            @if ($row->mode == 'Surface')
                                                                <i class="fas fa-truck"></i>
                                                            @else
                                                                <i class="fas fa-plane"></i>
                                                            @endif

                                                        </td>
                                                        <td class="border">
                                                            {{ $row->cutoff }}
                                                        </td>

                                                        {{-- <td class="border">
                                                            {{$row->action_date ? date('d-m-Y',strtotime($row->action_date )) :
                                                            '-' }}
                                                        </td> --}}
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No records found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>

                            <div class="{{ get_role(Auth::user()->usertype) == 2 ? 'd-none' : 'tab-pane' }}" id="history"
                                role="tabpanel" aria-labelledby="history-tab">




                                {{-- New --}}
                                <div class="card-header">
                                    <h4>Drag & Drop Row</h4>
                                    <div class="card-header-action">
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped py-5"
                                            style="text-align: center">
                                            <thead>
                                                <tr class="table-active">
                                                    {{-- <th class="border">
                                                        <strong style="color: black;">
                                                            <i class="fas fa-th text-dark"></i>
                                                        </strong>
                                                    </th> --}}
                                                    <th class="border">
                                                        <strong style="color: black;">Logo</strong>
                                                    </th>
                                                    <th class="border">
                                                        <strong style="color: black;">Provider
                                                        </strong>
                                                    </th>
                                                    <th class="border">
                                                        <strong style="color: black;">
                                                            Icon

                                                        </strong>
                                                    </th>
                                                    <th class="border">
                                                        <strong style="color: black;">Pickup Cutoff
                                                        </strong>
                                                    </th>
                                                    {{-- <th class="border">
                                                        <strong style="color: black;">Action Date
                                                        </strong>
                                                    </th> --}}
                                                </tr>
                                            </thead>
                                            <tbody class="sortable-table" id="my-table-id1">
                                                @forelse($sortedCourierPartners as $row)
                                                    <tr id="{{ $row->id }}">
                                                        {{-- <td class="border">
                                                            <div class="sort-handler ">
                                                                <i class="fas fa-th"></i>
                                                            </div>
                                                        </td> --}}

                                                        @php
                                                            $path = 'assets/img/courier_logo/';
                                                            $final_logo = $path . $row->courier_logo;

                                                        @endphp


                                                        <td class="border">

                                                            <img src="{{ $final_logo }}" style="width:50px;">
                                                        </td>
                                                        <td class="border">{{ $row->courier_name }}</td>
                                                        <td class="text-center border">
                                                            @if ($row->mode == 'Surface')
                                                                <i class="fas fa-truck"></i>
                                                            @else
                                                                <i class="fas fa-plane"></i>
                                                            @endif

                                                        </td>
                                                        <td class="border">
                                                            {{ $row->cutoff }}
                                                        </td>

                                                        {{-- <td class="border">
                                                            {{ $row->action_date ? date('d-m-Y H:i:s',
                                                            strtotime($row->action_date)) : '-' }}
                                                        </td> --}}

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No records found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- New --}}


                            <div class="tab-pane" id="deals" role="tabpanel" aria-labelledby="deals-tab">

                                <div class="card-header">
                                    <h4>Fastest</h4>
                                    <div class="card-header-action">
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped py-5"
                                            style="text-align: center">
                                            <thead>
                                                <tr class="table-active">

                                                    <th class="border">
                                                        <strong style="color: black;">Logo</strong>
                                                    </th>
                                                    <th class="border">
                                                        <strong style="color: black;">Provider
                                                        </strong>
                                                    </th>
                                                    <th class="border">
                                                        <strong style="color: black;">
                                                        </strong>
                                                    </th>
                                                </tr>
                                            </thead>
                                            {{-- <tbody class="sortable-table" id="my-table-id2"> --}}
                                            <tbody class="sortable-table"
                                                id="{{ get_role(Auth::user()->usertype) == 2 ? 'my-table-id2' : 'no1' }}">

                                                @php
                                                    $count = 1;
                                                @endphp

                                                @forelse($fastestCourierPartners as $row)
                                                    <tr id="{{ $row->id }}">

                                                        @php
                                                            $path = 'assets/img/courier_logo/';
                                                            $final_logo = $path . $row->courier_logo;
                                                        @endphp

                                                        <td class="border">
                                                            <img src="{{ $final_logo }}" style="width:50px;">
                                                        </td>

                                                        <td class="border">{{ $row->courier_name }}</td>
                                                        <td class="text-center border">
                                                            @if ($row->mode == 'Surface')
                                                                <i class="fas fa-truck"></i>
                                                            @else
                                                                <i class="fas fa-plane"></i>
                                                            @endif

                                                        </td>


                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No records found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="total_pincodes" role="tabpanel" aria-labelledby="total_pincodes-tab">

                                <div class="card-header">
                                    <h4>Cheapest</h4>
                                    <div class="card-header-action">
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped py-5"
                                            style="text-align: center">
                                            <thead>
                                                <tr class="table-active">
                                                    <th class="border">
                                                        <strong style="color: black;">Logo</strong>
                                                    </th>
                                                    <th class="border">
                                                        <strong style="color: black;">Provider
                                                        </strong>
                                                    </th>
                                                    <th class="border">
                                                        <strong style="color: black;">
                                                        </strong>
                                                    </th>
                                                </tr>
                                            </thead>
                                            {{-- <tbody class="sortable-table" id="my-table-id3"> --}}
                                            <tbody class="sortable-table"
                                                id="{{ get_role(Auth::user()->usertype) == 2 ? 'my-table-id3' : 'no2' }}">

                                                @php
                                                    $count = 1;
                                                @endphp

                                                @forelse($cheapestCourierPartners as $row)
                                                    <tr id="{{ $row->id }}">



                                                        @php
                                                            $path = 'assets/img/courier_logo/';
                                                            $final_logo = $path . $row->courier_logo;
                                                        @endphp

                                                        <td class="border">
                                                            <img src="{{ $final_logo }}" style="width:50px;">
                                                        </td>

                                                        <td class="border">{{ $row->courier_name }}</td>
                                                        <td class="text-center border">
                                                            @if ($row->mode == 'Surface')
                                                                <i class="fas fa-truck"></i>
                                                            @else
                                                                <i class="fas fa-plane"></i>
                                                            @endif

                                                        </td>


                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No records found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="activated_pincodes" role="tabpanel"
                                aria-labelledby="activated_pincodes-tab">
                                <p>Coming Soon......</p>
                            </div>
                        </div>






                        {{-- <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link class_check active tab_change" id="home-tab3" data-toggle="tab"
                                    href="#home3" role="tab" data-tab="all" aria-controls="home"
                                    aria-selected="true">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link class_check tab_change" id="profile-tab3" data-toggle="tab"
                                    href="#profile3" role="tab" aria-controls="profile" aria-selected="false"
                                    data-tab='activated'>Activated</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link class_check tab_change" id="contact-tab3" data-toggle="tab"
                                    href="#contact3" role="tab" aria-controls="contact" aria-selected="false"
                                    data-tab='deactivated'>Deactivated</a>
                            </li>
                        </ul> --}}


                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script>
        $('.nav-item-card').on('click', function (e) {
            e.preventDefault();
            var targetTab = $(this).find('.nav-link').attr('href');
            $('.nav-link').removeClass('active');
            $(this).find('.nav-link').addClass('active');
            $('.tab-pane').removeClass('active');
            $(targetTab).addClass('active');
        });


        $("#my-table-id4").sortable({
            delay: 150,
            stop: function () {
                var selectedData = [];
                $('#my-table-id4 tr').each(function () {
                    selectedData.push($(this).attr('id'));
                });
                var activeTab = $('.nav-link.active').attr('href');
                updateOrder(selectedData, activeTab);
            }
        });

        $("#my-table-id1").sortable({
            delay: 150,
            stop: function () {
                var selectedData = [];
                $('#my-table-id1 tr').each(function () {
                    selectedData.push($(this).attr('id'));
                });
                var activeTab = $('.nav-link.active').attr('href');
                updateOrder(selectedData, activeTab);
            }
        });

        $("#my-table-id2").sortable({
            delay: 150,
            stop: function () {
                var selectedData = [];
                $('#my-table-id2 tr').each(function () {
                    selectedData.push($(this).attr('id'));
                });
                var activeTab = $('.nav-link.active').attr('href');
                updateOrder(selectedData, activeTab);
            }
        });

        $("#my-table-id3").sortable({
            delay: 150,
            stop: function () {
                var selectedData = [];
                $('#my-table-id3 tr').each(function () {
                    selectedData.push($(this).attr('id'));
                });
                var activeTab = $('.nav-link.active').attr('href');
                updateOrder(selectedData, activeTab);
            }
        });

        function updateOrder(data, activeTab) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update the order priority.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('user.update-priority') }}",
                        type: "post",
                        data: {
                            data,
                            activeTab
                        },
                        success: function (response) {
                            if (response.status == true) {
                                toastr.success(response.message);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
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
                }
            });
        }



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
                    width: '40px'
                },
                {
                    data: 'courier_name',
                    orderable: false,
                    width: '200px'
                },
                {
                    data: 'icon',
                    orderable: false
                },
                {
                    data: 'id',
                    orderable: false
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
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],

            });
            $('#filterButton').click(function () {
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

        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection