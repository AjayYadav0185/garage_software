@extends('user.dashboard.layout.master')
@section('user-contant')

    <body>

        <style>
            .hover:hover {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                transform: translateZ(-5px);
                transition: all 0.3s ease-in-out;
            }

            .setting-icon {
                width: 80px;
                height: 80px;
            }
        </style>



        <div id="app">
            <div class="main-wrapper main-wrapper-1 supreme-container">

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">


                        <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                                <div class="card" style="text-align: center">
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
                                                    <h4 class="mb-0">Settings</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="row px-4">
                                        <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
                                            <div class="card box w-100 hover">
                                                <a href="{{ route('user.courier-selection') }}"
                                                    class="text-decoration-none">
                                                    <div class="card-body">
                                                        <div class="pb-2">
                                                            <button type="button" class="btn m-b-15"
                                                                fdprocessedid="34t64e">
                                                                <img src="{{ asset('setting_icon/courier_selection.png') }}"
                                                                    class="setting-icon w-25 h-25">
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <h6 class="fw-600 text-dark">Courier Selection</h6>
                                                            {{-- <p class="text-muted m-0 fw-600">Courier selection</p> --}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
                                            <div class="card box w-100 hover">
                                                <a href="{{ route('user.courier-priority') }}" class="text-decoration-none">
                                                    <div class="card-body">
                                                        <div class="pb-2">
                                                            <button type="button" class="btn m-b-15" fdprocessedid="qrjh4">
                                                                <img src="{{ asset('setting_icon/courier_priority.png') }}"
                                                                    class="setting-icon w-25 h-25">
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <h6 class="fw-600 text-dark">Courier Priority</h6>
                                                            {{-- <p class="text-muted m-0 fw-600">Manage your courier priority</p> --}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
                                            <div class="card box w-100 hover">
                                                <a href="{{ route('user.profile-kyc') }}" class="text-decoration-none">
                                                    <div class="card-body">
                                                        <div class="pb-2">
                                                            <button type="button" class="btn m-b-15"
                                                                fdprocessedid="6nspa5">
                                                                <img src="{{ asset('setting_icon/KYC.png') }}"
                                                                    class="setting-icon w-25 h-25">
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <h6 class="fw-600 text-dark">Profile & KYC Setting </h6>
                                                            {{-- <p class="text-muted m-0 fw-600">Your profile & KYC</p> --}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>




                                        <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
                                            <div class="card box w-100 hover">
                                                <a href="{{ route('user.label-setting') }}" class="text-decoration-none">
                                                    <div class="card-body">
                                                        <div class="pb-2">
                                                            <button type="button" class="btn m-b-15"
                                                                fdprocessedid="7qosew">
                                                                <img src="{{ asset('setting_icon/label.png') }}"
                                                                    class="setting-icon w-25 h-25">
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <h6 class="fw-600 text-dark">Labels</h6>
                                                            {{-- <p class="text-muted m-0 fw-600">Set your shipping label format</p> --}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        {{-- Invoice --}}

                                        {{-- <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{route('user.invoices')}}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="7qosew">
                  <img src="{{asset('setting_icon/invoice_setting.png')}}" class="setting-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Invoice Setting</h6>
                <p class="text-muted m-0 fw-600">Set your shipping label format</p>
                </div>
              </div>
              </a>
            </div>
            </div> --}}

                                        <div class="col-lg-3 col-md-6 col-sm-6 d-flex box-shadow">
                                            <div class="card box w-100 hover">
                                                <a href="{{ route('user.invoices') }}" class="text-decoration-none"
                                                    onclick="showComingSoon(event)">
                                                    <div class="card-body">
                                                        <div class="pb-2">
                                                            <button type="button" class="btn m-b-15">
                                                                <img src="{{ asset('setting_icon/invoice_setting.png') }}"
                                                                    class="setting-icon w-25 h-25">
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <h6 class="fw-600 text-dark">Invoice Setting</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <script>
                                            function showComingSoon(event) {
                                                event.preventDefault(); // prevent redirect if only showing message
                                                alert("Coming Soon");
                                            }
                                        </script>


                                        {{-- Freeze Product & Packet --}}

                                        <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
                                            <div class="card box w-100 hover">
                                                <a href="#" class="text-decoration-none"
                                                    onclick="showComingSoon(event)">
                                                    <div class="card-body">
                                                        <div class="pb-2">
                                                            <button type="button" class="btn m-b-15"
                                                                fdprocessedid="7qosew">
                                                                <img src="{{ asset('setting_icon/freeze.png') }}"
                                                                    class="setting-icon w-25 h-25">
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <h6 class="fw-600 text-dark">Freeze Product & Packet</h6>
                                                            {{-- <p class="text-muted m-0 fw-600">Set your shipping label format</p> --}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        {{-- Rules --}}

                                        <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
                                            <div class="card box w-100 hover">
                                                <a href="#" class="text-decoration-none"
                                                    onclick="showComingSoon(event)">
                                                    <div class="card-body">
                                                        <div class="pb-2">
                                                            <button type="button" class="btn m-b-15"
                                                                fdprocessedid="7qosew">
                                                                <img src="{{ asset('setting_icon/rules.png') }}"
                                                                    class="setting-icon w-25 h-25">
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <h6 class="fw-600 text-dark">Rules</h6>
                                                            {{-- <p class="text-muted m-0 fw-600">Set your shipping label format</p> --}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>







                                        <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
                                            <div class="card box w-100 hover">

                                                @if (get_role(Auth::user()->usertype) == 2)
                                                    <a href="{{ route('user.adminpincode') }}" class="text-decoration-none">
                                                    @else
                                                        <a href="{{ route('user.pincode') }}"
                                                            class="text-decoration-none">
                                                @endif


                                                <div class="card-body">
                                                    <div class="pb-2">
                                                        <button type="button" class="btn m-b-15" fdprocessedid="taothc">
                                                            <img src="{{ asset('setting_icon/pincode.png') }}"
                                                                class="setting-icon w-25 h-25">
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-600 text-dark">Serviceable Pincodes</h6>

                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                    </section>
                </div>
            </div>
        </div>
        <!-- recharge model  -->
        <script src="https://unpkg.com/sweetalert%402.1.2/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endsection
