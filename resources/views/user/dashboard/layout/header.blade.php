<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>MeriGarage - Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Tab Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('user/assets/bundles/pretty-checkbox/pretty-checkbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/custom.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- <link rel='shortcut icon' type='image/x-icon' href='assets/img/reppidxlogoicon.png' /> -->
    <!--<link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">


    <script src="https://securegw.paytm.in/merchantpgpui/checkoutjs/merchants/{{ env('PAYTM_MERCHANT_ID') }}.js"></script>


    <script src="{{ asset('user/assets/js/app.min.js') }}"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<style>
    body {
        font-family: 'DM Sans', sans-serif;
    }

    .blance_cssbtn:hover {
        color: black !important;
    }

    body.modal-open .supreme-container {
        background-color: #F8F8F8;
        -webkit-filter: blur(1px);
        -moz-filter: blur(1px);
        -o-filter: blur(1px);
        -ms-filter: blur(1px);
        filter: blur(1px);
    }

    .dropdown-list .dropdown-list-content {
        height: 100%;
    }

    .custom-file-input {

        opacity: 1 !important;
        border: 1px solid rgb(187 184 184);
        padding-top: 3px;
        padding-left: 4px;
    }

    .icon-size {
        width: 20px;
        height: 20px;
        /* color: #fff !important; */
    }

    .small-swal-popup {
        max-width: 300px !important;
        padding: 0px !important;
        font-size: 14px;
    }

    .custom-text-color {
        color: blue;
        font-size: 16px;
    }

    .custom-title-color {
        color: #2b8a3e;
        font-size: 20px;
    }

    .custom-text-error-color {
        color: red;
        font-size: 16px;
    }

    .custom-title-error-color {
        color: red;
        font-size: 20px;
    }

    .btn-primary,
    .btn-primary.disabled {
        box-shadow: none !important
    }

    .underline-action span {
        text-decoration: underline;
    }

    .underline-action:hover span {
        text-decoration: underline;
    }

    .main-sidebar {
        /* background-color: #fffff6 !important; */
        background-color: #11151f !important;
    }

    .light-sidebar.sidebar-mini .main-sidebar:after {
        background-color: #11151f !important;
    }

    .light-sidebar.sidebar-mini .main-sidebar .sidebar-menu {
        background-color: #11151f !important;
    }

    .theme-white .navbar {
        background-color: #fffff6 !important;
    }

    .blance_cssbtn.btn-primary:hover {
        background-color: #6777ef !important;
        color: #ffffff !important;
    }

    .theme-white .nav-pills .nav-link {
        color: #bbbbbb !important;
        background-color: transparent !important;
        border: 2px solid #bbbbbb !important;
        shape-outside: none;
    }

    .theme-white .nav-pills .nav-link.active {
        color: #000 !important;
        background-color: transparent !important;
        border: 2px solid #41454E !important;
        shape-outside: none;
    }

    .theme-white .btn-outline-primary {
        color: #000 !important;
        background-color: #FFFF00 !important;
        border: 2px solid #FFFF00 !important;
        shape-outside: none;
    }

    .nav-pills .nav-item .nav-link.active {
        box-shadow: none;
    }

    .nav-pills .nav-item .nav-link:hover {
        background-color: #fff !important;
    }

    .theme-white .btn-primary {
        color: #000 !important;
        background-color: hsl(60, 100.00%, 57.50%) !important;
    }

    .btn-outline-primary:hover,
    .btn-outline-primary:focus,
    .btn-outline-primary:active,
    .btn-outline-primary.disabled:hover,
    .btn-outline-primary.disabled:focus,
    .btn-outline-primary.disabled:active {
        color: #000 !important;
        background-color: #FFFF00 !important;
    }

    .dataTables_wrapper table th {
        font-size: 14px !important;
    }

    .dataTables_wrapper table td {
        font-size: 12px !important;
    }

    .nav-pills .nav-link {
        border-radius: 0px !important;
    }

    .dropdown-list {
        width: 220px !important;
    }

    .dropdown-list .dropdown-item {
        padding-top: 7px;
        padding-bottom: 7px;
    }

    .dropdown-menu::before {
        content: "";
        position: absolute;
        top: -10px;
        /* Adjust this to move the arrow */
        right: 20px;
        /* Adjust the position as needed */
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #000;
        /* Same color as dropdown background */
    }

    .custom-dropdown::before {
        content: "";
        position: absolute;
        top: -10px;
        right: 20px;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #fff;
    }
</style>

<style>
    .dataTables_filter input {
        width: 300px !important;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        outline: none !important;
        box-shadow: none !important;
    }
</style>

<style>
    .search-item {
        height: auto;
        padding: 5px 0;
    }

    .search-form {
        display: flex;
        align-items: center;
    }

    .search-input-group {
        display: flex;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .search-input-group:focus-within {
        border-color: #4a90e2;
        box-shadow: 0 2px 8px rgba(74, 144, 226, 0.3);
    }

    .search-input {
        width: 250px;
        padding: 8px 12px;
        border: none;
        outline: none;
        font-size: 14px;
        background-color: white;
    }

    .search-button {
        padding: 8px 12px;
        border: none;
        background-color: black;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-button:hover {
        background-color: black;
    }

    .search-button i {
        font-size: 15px;
    }

    .dropdown-menu form {
        pointer-events: auto;
    }
</style>

<body class="sidebar-mini">
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg">
            </div>

            <nav class="navbar navbar-expand-lg main-navbar sticky supreme-container">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a>
                        </li>
                        <li class="search-item">
                            <form method="POST" class="search-form" id="searchform"
                                action="{{  route('jobcards.estimate.page')  }}">
                                {!! csrf_field() !!}
                                <div class="search-input-group">
                                    <input type="search" class="search-input"
                                        placeholder="JC-12345"
                                        name="searchdata">
                                    <button class="search-button" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>

                    </ul>
                </div>
                @php
                $color = '#e61f15';
                @endphp
                <ul class="navbar-nav navbar-right" style="margin-top: 10px !important;">

                    <button hidden class="btn btn-dark ms-2 mx-2" style="height: 36px !important; cursor: pointer;"
                        onclick="location.reload();">
                        <i class="fas fa-sync-alt"></i>
                    </button>

                    {{-- <div class="buttons">
                        <a href="#"
                            class="btn btn-icon icon-left blance_cssbtn btn btn-primary wallet-btn">
                            <i class="fas fa-wallet" style="font-size: 17px;"></i> {{currency_symbol()}}&nbsp;{{
                            getWalletAmt(Auth::user()->User_Id) }}
                    </a>
        </div> --}}
        {{-- wallet end --}}

        {{-- <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link message-toggle nav-link-lg"><i
                                data-feather="bell" class="bell"></i>
                            <span class="badge headerBadge1">
                                4 </span> </a>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                Notifications

                            </div>

                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li> --}}

        <style>
            body {
                background-color: #f8f9fa;
            }

            .profile-card {
                background: linear-gradient(135deg, #ff416c, #ff4b2b);
                color: white;
                border-radius: 15px;
                padding: 40px;
                max-width: 400px;
                margin: auto;
                position: relative;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            }

            .profile-card img {
                width: 85px;
                height: 85px;
                border-radius: 50%;
                border: 4px solid white;
                position: absolute;
                top: 5px;
                left: 50%;
                transform: translateX(-50%);
            }

            .profile-card h3 {
                margin-top: 50px;
                font-weight: bold;
            }

            .stats {
                display: flex;
                justify-content: space-around;
                margin-top: 20px;
            }

            .stats div {
                text-align: center;
            }

            .stats span {
                display: block;
                font-weight: bold;
                font-size: 18px;
            }

            .btn-custom {
                background-color: white;
                color: #ff416c;
                border: none;
                border-radius: 20px;
                padding: 8px 20px;
                margin-top: 15px;
            }

            .share-icons {
                margin-top: 20px;
            }

            .share-icons a {
                margin: 0 5px;
                color: white;
                font-size: 20px;
            }

            /* .dropdown-menu{
         width : 400px !important;
        } */
            .dropdown-menu .dropdown-title {
                color: #fff !important;
                border-bottom: 1px solid #FFF !important;
            }
        </style>

        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                {{-- <img alt="image" src="{{ asset('assets/img/user.png') }}"
                class="user-img-radious-style"> --}}
                <i data-feather="user"></i>
                <span class="d-sm-none d-lg-inline-block"></span></a>

            <div class="dropdown-menu dropdown-menu-right pullDown">

                <a href="{{ route('profile.edit-page') }}" class="dropdown-item has-icon text-danger">
                    <i class="fa fa-user"></i> {{ __('Profile') }}
                </a>

                <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-lock-open"></i> {{ __('Password') }}
                </a>

                <!-- Language Switcher -->
                <!-- <form action="{{ route('profile.language.update') }}" method="POST" class="dropdown-item p-2">
                    @csrf
                    @method('PUT')

                    <div class="d-flex dropdown-item has-icon text-danger" style="padding: 0px 15px;">
                        <i class="fas fa-language mr-2" style="margin-top: 10px;"></i>

                        @php
                        $countryCode = Auth::user()->country->code ?? 'IN';
                        $languages = \App\Enums\Language::allowedByCountry($countryCode);
                        @endphp

                        <select name="lang" class="form-control form-control-sm text-danger" onchange="this.form.submit()">
                            @foreach($languages as $language)
                            <option value="{{ $language->value }}"
                                {{ Auth::user()->lang === $language->value ? 'selected' : '' }}>
                                {{ $language->label() }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                </form> -->


                <a href="{{ route('logout') }}"
                    class="dropdown-item has-icon text-danger logouttrigger text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>

        </li>


        </ul>
        </nav>
        <!-- Modal -->

        <div class="modal fade" id="exampleModalCenterkyc" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterkycTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">KYC Verification</h5>
                        <button type="button" class="close kycclose" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Your KYC is not verified. Please complete your KYC process to continue.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary kycclose"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="kycform">Complete
                            KYC</button>
                        {{-- <a href="" class="btn btn-primary">Complete KYC</a> --}}
                    </div>
                </div>
            </div>
        </div>








        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Blade Condition -->
        @if (
        Auth::check() &&
        (Auth::user()->kyc_status == '0' || Auth::user()->kyc_status == null || Auth::user()->kyc_status == '')
        )
        <script>
            $(document).ready(function() {

                $('#exampleModalCenterkyc').modal('hide');

                console.log('Modal shown.');

                $('.kycclose').on('click', function() {
                    console.log('Close button clicked.');

                    $('#exampleModalCenterkyc').modal('hide');
                });
            });
        </script>
        @endif

        <input type="hidden" name="kycstatus" id="kycctatusF">

        <script>
            $(document).ready(function() {

                $('#kycform').on('click', function() {

                    // alert('111111');

                    var id = $('#kycctatusF').val();

                    $.ajax({
                        url: "#",
                        type: "GET",
                        data: id,
                        success: function(response) {

                        }
                    });

                });

            });

            // $('body').on('click', '.collapse-btn', function() {
            //     if ($('.logo1head').is(':visible')) {
            //         $('.logo1head').hide();
            //     } else {
            //         $('.logo1head').show();
            //     }
            // });
        </script>