{{-- @extends('user.dashboard.layout.master')

@section('user-contant')
<div class="main-content supreme-container">
    <section class="section" style="margin-top:-34px;">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header supreme-container" style="display: block;">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h4 class="float-left">Delivery Tat</h4>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                        class="btn btn-primary mr-1 go_forbtn float-right"
                                        style="color:white;border-radius: 5px;padding: 0.3rem 0.8rem !important;"
                                        data-toggle="tooltip" data-placement="top" title="Go Back" type="submit">
                                        <i class="fa-sharp fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <section class="content">

                            <form id="tatForm">
                                <div class="row px-6">
                                    <div class="col-md-4">
                                        <input type="text" id="originpincode" class="form-control m-2"
                                            placeholder="From Pincode">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Pincode<span class="text-danger">*</span></label>
                                        <input type="text" id="destinationpincode" name="pin" class="form-control"
                                            placeholder="Enter Customer Pincode" required=""
                                            onchange="despindetails(this.value)" maxlength="6" minlength="6" value=""
                                            required onKeyPress="if(this.value.length==6) return false;">
                                        <input type="hidden" name="destinationpin-city" id="destinationpin-city">
                                        <input type="hidden" name="destinationpin-state" id="destinationpin-state">
                                        <input type="hidden" name="destinationpin-country" id="destinationpin-country">
                                        <input type="text" id="zonebtwn1" name="zone" value="">
                                    </div>
                                    <div class="card-footer text-right" style="margin-right: -41px;">
                                        <button class="btn btn-primary mr-1" type="button" name="submit1"
                                            id="show_courier" onclick="calculateraterefresh()">Get Courier</button>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12">
                                <div id="All_Records">
                                    <div id="b2c_calculate_list">B2C estimate couries loading...
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $('#tatForm').on('submit', function (e) {
        e.preventDefault();
        var oripin = $("#originpincode").val();
        var destinpin = $("#destinationpincode").val();
        if (from.length < 3 || to.length < 3) {
            alert("Please enter valid From and To Pincodes");
            return;
        }
        $("#All_Records").html("<br><center><h4>Loading...<h4></center>");

    });

    function checklaneandamt() {
        alert("checklaneandamt");

        oripin = $("#originpincode").val();
        destinpin = $("#destinationpincode").val();
        zone = $("#zonebtwn1").val();
        html = '';
        paymode = $("#paymentmode").val();
        prodamt = $("#valueininr").val();
        codamt = $("#confirmpassword").val();
        order_type = $("#order_type").val();
        freightWeightare = $("#FreightWeightare").val();

        $.ajax({
            type: "GET",
            url: 'retailer-calculator-estimate',
            data: {
                param: 'D',
                paymode: 'COD',
                prodamt: prodamt,
                codamt: codamt,
                freightWeightare: '2',
                order_type: 'single_order',
                oripin: oripin,
                destinpin: destinpin
            },
            success: function (data) {
                // alert(data.success);`
                data = isJson(data) ? JSON.parse(data) : data;
                if (data.success == false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.msg,
                        customClass: {
                            popup: 'small-swal-popup',
                            htmlContainer: 'custom-text-error-color',
                            title: 'custom-title-error-color'
                        }
                    });
                } else {
                    // alert("else");
                    $("#b2c_calculate_list").html(data.html);
                    $("#rate_calcule_amountsdiv").css({
                        'display': 'block'
                    });
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>

<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection --}}


@extends('user.dashboard.layout.master')
@section('user-contant')
    <style type="text/css">
        .rate_cal_shadow_css {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);

        }

        #myTable tr td:nth-child(1),
        #myTable th:nth-child(1) {

            display: none;

        }

        input.qwerty {
            display: none;
        }

        .table.table-md th,
        .table.table-md td {
            padding: 5px 10px !important;
        }
    </style>

    <body>
        <!-- Main Content -->
        <div class="main-content">
            <section class="section  supreme-container" style="margin-top:-34px;">
                <div class="row">
                    <div class="card" style="width:100%">
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
                                        <h4 class="mb-0">Delivery Tat</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-header">
                            <h4>Calculate Estimate Amount</h4>
                        </div> --}}
                        <div class="card-body">
                            <div class="col-md-12">
                                {{-- <a href="#content1" class="btn btn-primary font-18 ">B2C Calculator</a> --}}
                                {{-- <a href="#content2" class="btn btn-primary font-18"> B2B Calculator</a>
                                <a href="#content3" class="btn btn-primary font-18">International
                                    Calculator</a> --}}

                                <!-- Rate List Button -->


                            </div>
                            <br>
                            <div id="content1" style="display:block">
                                <!-- <div id="b2c_calculate_list">Workng</div> -->
                                <div class="row">
                                    <div class="col-md-12 card">
                                        <input type="hidden" id="zonebtwn1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3 my-3">
                                                        <div class="form-group">
                                                            <label>Pickup- Pincode</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i data-feather="map-pin"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text" name="originpincode" id="originpincode"
                                                                    class="form-control phone-number"
                                                                    onblur="oripindetails(this.value)" maxlength="6">

                                                                <input type="hidden" name="originpin-city"
                                                                    id="originpin-city">
                                                                <input type="hidden" name="originpin-state"
                                                                    id="originpin-state">
                                                                <input type="hidden" name="originpin-country"
                                                                    id="originpin-country">
                                                            </div>
                                                            <span class="text-center" style="color:#6777ef "
                                                                id="originpin-state-show"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 my-3">
                                                        <div class="form-group">
                                                            <label>Delivery Pincode</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i data-feather="map-pin"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text" name="destinationpincode"
                                                                    id="destinationpincode"
                                                                    class="form-control phone-number"
                                                                    onblur="despindetails(this.value)" maxlength="6">
                                                                <input type="hidden" name="destinationpin-city"
                                                                    id="destinationpin-city">
                                                                <input type="hidden" name="destinationpin-state"
                                                                    id="destinationpin-state">
                                                                <input type="hidden" name="destinationpin-country"
                                                                    id="destinationpin-country">

                                                                <input type="hidden" name="distancebtwn" id="distancebtwn">
                                                                <input type="hidden" name="distancebtwnkm"
                                                                    id="distancebtwnkm">
                                                                <input type="hidden" name="distancebtwntype"
                                                                    id="distancebtwntype">
                                                            </div>
                                                            <span class="text-center" style="color:#6777ef "
                                                                id="destinationpin-state-show"></span>
                                                        </div>
                                                    </div>
                                                    <div class="my-4 col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <a class="btn btn-primary form-control"
                                                                    onclick="calculateraterefresh()"
                                                                    style="width: 100%; height: 35px; margin: 15px;"><i
                                                                        class="fa fa-rss-square" aria-hidden="true"></i> Get
                                                                    Data</a>
                                                            </div>
                                                            <div class="col-md-6" id="Export" style=" display: none;">
                                                                <a class="btn btn-primary form-control" onclick="Export()"
                                                                    style="width: 100%; height: 35px; margin: 15px;">Export
                                                                    Data</a>
                                                            </div>
                                
                                                            <a href="javascript:void(0);" class="btn btn-primary"
                                                                style="height: 35px; margin: 15px; align-self: flex-end; justify-self: flex-end; text-align: end; margin-left: auto;"
                                                                data-toggle="modal" data-target=".bd-example-modal-lg">
                                                                <i class="fa fa-list"></i> TAT List
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" id="rate_calcule_amountsdiv" style="display: none;">
                                        <div class="rate_cal_shadow_css">
                                            <div class="row p-3">
                                                <div class="col-md-6" style="color: blue;text-align:left;">
                                                    <strong>Pickup Pincode: <span id="pikcuppinno" style="color: black;">
                                                            <span></strong> <br>
                                                </div>
                                                <div class="col-md-6" style="color: blue;text-align:right;">
                                                    <strong>Destination Pincode : <span id="destinpinno"
                                                            style="color: black;"> <span> </strong><br>
                                                </div>
                                            </div>
                                            <div id="b2c_calculate_list">B2C estimate couries loading...</div>
                                        </div>
                                        {{-- <p class=""><span style="color:blue">*</span>GST Additional</p> --}}
                                    </div>

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
                                        style="background: blue; color: white; display: none;">Forward</a>
                                    {{-- <a href="#rto" class="btn btn font-18" style="background: blue; color: white;">RTO</a>
                                    <a href="#reverse" class="btn btn font-18"
                                        style="background: blue; color: white;">Reverse</a> --}}
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
                                          
                                                    <th>Provider</th>
                                                    <th>Mode</th>
                                                    <th>Local (A)</th>
                                                    <th>Regional (B)</th>
                                                    <th>Metro (C)</th>
                                                    <th>National (D)</th>
                                                    <th>Remote (E)</th>          
                                                    @if ($rateListDatas->isEmpty())
                                                        <tr>
                                                            <td colspan="11" class="text-center">No Record Found</td>
                                                        </tr>
                                                    @else
                                                        @foreach ($rateListDatas as $index => $rateListData)
                                                            <tr>
                                              
                                                                <td>{{ $rateListData->courier }}
                                                            
                                                                </td>
                                                                <td>
                                                                    @if ($rateListData->mode == 'Surface')
                                                                        <i class="fas fa-truck"></i>
                                                                    @else
                                                                        <i class="fa fa-plane"></i>
                                                                    @endif
                                                                </td>
                                            
                                                                <td>{{ $rateListData->A_tat }}</td>
                                                                <td>{{ $rateListData->B_tat }}</td>
                                                                <td>{{ $rateListData->C_tat }}</td>
                                                                <td>{{ $rateListData->D_tat }}</td>
                                                                <td>{{ $rateListData->E_tat }}</td>
                                                        
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                 
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


        <script type="text/javascript">
            function checklaneandamt() {
                oripin = $("#originpincode").val();
                destinpin = $("#destinationpincode").val();
                zone = $("#zonebtwn1").val();
                html = '';
                paymode = $("#paymentmode").val();
                prodamt = $("#valueininr").val();
                order_type = $("#order_type").val();
                freightWeightare = $("#FreightWeightare").val();

                $.ajax({
                    type: "GET",
                    url: 'delivery_tat-calculator-estimate',
                    data: {
                        param: zone,
                        paymode: paymode,
                        prodamt: prodamt,
                        freightWeightare: freightWeightare,
                        order_type: order_type,
                        oripin: oripin,
                        destinpin: destinpin
                    },
                    success: function (data) {
                        // data = isJson(data) ? JSON.parse(data) : data;

                        $("#rate_calcule_amountsdiv").css({
                            'display': 'block'
                        });
                        $("#Export").css({
                            'display': 'block'
                        });
                        $("#b2c_calculate_list").html(data.html);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        </script>

        <script type="text/javascript">
            function Export() {
                const oripin = $("#originpincode").val();
                const destinpin = $("#destinationpincode").val();
                const zone = $("#zonebtwn1").val();
                const paymode = $("#paymentmode").val();
                const prodamt = $("#valueininr").val();
                const order_type = $("#order_type").val();
                const freightWeightare = $("#FreightWeightare").val();

                const params = new URLSearchParams({
                    param: zone,
                    paymode: paymode,
                    prodamt: prodamt,
                    freightWeightare: freightWeightare,
                    order_type: order_type,
                    oripin: oripin,
                    destinpin: destinpin
                });


                window.location.href = '{{ route('user.delivery_tat_export') }}?' + params.toString();
            }
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

        <script>
    document.getElementById("downloadExcel").addEventListener("click", function () {
        // Table ka element select karo
        var table = document.querySelector("table");

        // Table ko Excel sheet me convert karo
        var wb = XLSX.utils.table_to_book(table, { sheet: "RateList" });

        // File download trigger karo
        XLSX.writeFile(wb, "RateList.xlsx");
    });
</script>


@endsection