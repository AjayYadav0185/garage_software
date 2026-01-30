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

        input::placeholder {
            font-size: 12px;
        }

        select.form-control option:first-child {
            font-size: 12px;
            color: gray;
            font-style: italic;
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
                                        <h4 class="mb-0">{{ translate('Calculate Estimate Amount') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-header">
                            <h4>Calculate Estimate Amount</h4>

                        </div> --}}
                        <div class="card-body">
                            <div class="col-md-12" style="margin-left: -25px;">
                                <a href="#content1" class="btn btn-primary font-15 ">{{ translate('B2C Calculator') }}</a>
                                {{-- <a href="#content2" class="btn btn-primary font-18"> B2B Calculator</a>
                                <a href="#content3" class="btn btn-primary font-18">International
                                    Calculator</a> --}}
                            </div>
                            <br>
                            <div id="content1" style="display:block">
                                <!-- <div id="b2c_calculate_list">Workng</div> -->
                                <div class="row">
                                    <div class="col-md-6 card">
                                        <input type="hidden" id="zonebtwn1">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="row">
                                                    <div class="col-md-4 my-3">
                                                        <div class="form-group">
                                                            <label>{{ translate('Pickup Pincode') }}</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i data-feather="map-pin" color="black"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text" name="originpincode" id="originpincode"
                                                                    class="form-control phone-number"
                                                                    onblur="oripindetails(this.value)" maxlength="6"
                                                                    placeholder="Origin Pincode">
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
                                                    <div class="col-md-4 my-3">
                                                        <div class="form-group">
                                                            <label>{{ translate('Delivery Pincode') }}</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i data-feather="map-pin" color="black"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text" name="destinationpincode"
                                                                    id="destinationpincode"
                                                                    class="form-control phone-number"
                                                                    onblur="despindetails(this.value)" maxlength="6"
                                                                    placeholder="Destination pincode">
                                                                <input type="hidden" name="destinationpin-city"
                                                                    id="destinationpin-city">
                                                                <input type="hidden" name="destinationpin-state"
                                                                    id="destinationpin-state">
                                                                <input type="hidden" name="destinationpin-country"
                                                                    id="destinationpin-country">
                                                            </div>
                                                            <span class="text-center" style="color:#6777ef "
                                                                id="destinationpin-state-show"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 my-3">
                                                        <div class="form-group">
                                                            <label>{{ translate('Actual Weight') }}</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                       {{ translate(' Kg') }}
                                                                    </div>
                                                                </div>
                                                                <input type="number" min="0.1" name="actualweight"
                                                                    id="actualweight" onkeyup="freightWeight()"
                                                                    class="form-control phone-number" placeholder="0.10gm">
                                                                <input type="hidden" name="distancebtwn" id="distancebtwn">
                                                                <input type="hidden" name="distancebtwnkm"
                                                                    id="distancebtwnkm">
                                                                <input type="hidden" name="distancebtwntype"
                                                                    id="distancebtwntype">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <b style="color:rgb(0, 0, 0);">{{ translate('Enter Packet Dimension') }} : (CM)</b>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{-- <label>Length</label> --}}
                                                    <div class="input-group">
                                                        <input type="text" name="lenghtcm" id="lenghtcm"
                                                            onkeyup="VolumetricWeightCal(this.value,'length')"
                                                            class="form-control phone-number" value=""
                                                            placeholder="Length(cm)">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{-- <label>Height</label> --}}
                                                    <div class="input-group">
                                                        <input type="text" name="heightcm" id="heightcm"
                                                            onkeyup="VolumetricWeightCal(this.value,'height')"
                                                            class="form-control phone-number" value=""
                                                            placeholder="Height(cm)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{-- <label>Width </label> --}}
                                                    <div class="input-group">
                                                        <input type="text" name="breadthcm" id="breadthcm"
                                                            onkeyup="VolumetricWeightCal(this.value,'breadth')"
                                                            class="form-control phone-number" value=""
                                                            placeholder="Width(cm)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{-- <label>Volumetric Weight </label> --}}
                                                    <div class="input-group">
                                                        <input type="text" name="VolumetricWeightshow"
                                                            id="VolumetricWeightshow" class="form-control"
                                                            placeholder="Volumetric Weight (kg)" title="Volumetric Weight" readonly />
                                                        <input type="hidden" name="VolumetricWeight" id="VolumetricWeight">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{-- <label>Value in {{currency()}}</label> --}}
                                                    <div class="input-group">
                                                        <input type="text" name="valueininr" id="valueininr"
                                                            class="form-control phone-number" placeholder="Value in {{currency()}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{-- <label>Payment Mode</label> --}}
                                                    <div class="input-group">
                                                        <select name="paymentmode" id="paymentmode" class="form-control"
                                                            required>
                                                            <option value="">{{ translate('Payment Mode') }}</option>
                                                            <option value="COD">{{ translate('COD') }}</option>
                                                            <option value="prepaid">{{ translate('Prepaid') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{-- <label>Chargeable Weight(Kg)</label> --}}
                                                    <div class="input-group">
                                                        <input type="hidden" name="productamount" min="0"
                                                            onkeyup="precheckcalculaterate()" id="productamount"
                                                            class="form-control phone-number" value="">
                                                        <input type="text" name="FreightWeightshow" id="FreightWeightshow"
                                                            class="form-control" placeholder="Chargeable Weight (kg)"
                                                            title="Freight Weight" readonly />
                                                        <input type="hidden" name="FreightWeightare" id="FreightWeightare">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-primary form-control"
                                                            onclick="calculateraterefresh()"
                                                            style="width: 100%; height: 35px;">{{ translate('Calculate') }}</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="javascript:void(0);" class="btn btn-primary form-control"
                                                            data-toggle="modal" data-target=".bd-example-modal-lg"
                                                            style="height: 35px;">{{ translate('Rate List') }}</a>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 card" style="box-shadow: none; background-color: transparent; border: none;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="border text-center" style="margin: auto;border-radius: 10px;">
                                                    <div class="" style="color: black"><b class="" style=" color: blue; font-size: 18px;">{{ translate('Packet Dimension') }}</b><br> {{ translate('Length') }}
                                                        {{ translate('* Width * Height') }} / 5000</div>
                                                            <img src="{{ asset('calculate-img/box ch 2-01.png') }}"
                                                                alt="Box"
                                                               class="img-fluid my-2"
                                                         style="max-height: 310px; width: 100%; object-fit: contain;">
                                                      <div class="m-2 fw-bold" style="font-size: 16px;">{{translate('Volumetric Weight') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="border text-center" style=" margin: auto;border-radius: 10px;">
                                                        <div class="" style="color: black"><b class="" style=" color: blue; font-size: 18px;"></b><br> <br></div>
                                                     <img src="{{ asset('calculate-img/volumetric weight 2 .png') }}"
                                                     alt="Volumetric"
                                                       class="img-fluid my-2"
                                                       style="max-height: 310px; width: 100%; object-fit: contain;">
                                                   <div class="m-2 fw-bold" style="font-size: 16px;">Actual Weight</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-4" id="rate_calcule_amountsdiv" style="display: none;">
                                        <div class="rate_cal_shadow_css">
                                            <div class="row p-3">
                                                <div class="col-md-6" style="color: blue;text-align:left;">
                                                    <strong>Pickup Pincode: <span id="pikcuppinno" style="color: black;">
                                                            <span></strong> <br>
                                                </div>
                                                <div class="col-md-6" style="color: blue;text-align:right;">
                                                    <strong>Destination Pincode : <span id="destinpinno"
                                                            style="color: black;">
                                                            <span> </strong><br>
                                                </div>
                                            </div>
                                            <div id="b2c_calculate_list">B2C estimate couries loading...</div>
                                            <p class="text-center"><span style="color:blue">*</span>GST Additional</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h4>Terms & Conditions:</h4>
                                    </div>
                                    {{-- {{dd($terms)}} --}}
                                    {!! $terms->title !!}
                                </div>
                            </div>


                            <!-- b2b calculator  -->
                            {{-- <div id="content2" class="toggle" style="display:none">

                                <h3 class="" style="padding-top:4rem; padding-left:1rem;">Coming soon</h3>

                            </div> --}}
                            <!-- internation calculator  -->
                            {{-- <div id="content3" class="toggle" style="display:none">


                                <h3 class="" style="padding-top:4rem; padding-left:1rem;">Coming soon</h3>
                            </div> --}}
                        </div>
                    </div>
                </div>
        </div>
        </section>
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





        <!-- calculaor calculate button for b2c model  -->
        <div class="modal fade" id="basicModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Estimate Details B2B</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Pickup Pincode : </strong><span id="pikcuppinno1"> <span> <br>
                            </div>
                            <div class="col-md-6">
                                <strong>Delivery Pincode : </strong><span id="destinpinno1"> <span> <br>
                            </div>
                        </div>
                        <br>

                    </div>
                    <div class="modal-footer bg-whitesmoke br">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- calculaor calculate button for b2c model  -->
        <div class="modal fade" id="basicModa3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Estimate Details International Calculate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>

                </div>
            </div>
        </div>
        <!-- end calculaor button for b2c model  -->
        </div>

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
                    url: 'retailer-calculator-estimate',
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

                        $("#b2c_calculate_list").html(data.html);
                        $("#rate_calcule_amountsdiv").css({
                            'display': 'block'
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        </script>


@endsection
