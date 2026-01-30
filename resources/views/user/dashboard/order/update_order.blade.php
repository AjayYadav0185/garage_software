@extends('user.dashboard.layout.master')
@section('user-contant')
    <style>
        .courier_rowcss {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        }

        .customTable {
            min-height: 15rem;
        }

        .go_forbtn {
            margin-top: -58px;
        }

        .showpincodecss {
            border: 5px solid rgb(235, 236, 236);
            border-collapse: collapse;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        }
    </style>

    <div class="loader"></div>
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header  ">
                                <h4 class="float-left">Update Order</h4>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                </div>
                                <div class="col-sm-2 text-center">
                                    <a href="{{ route('user.upload-order') }}"
                                        class="btn btn-primary mr-1 go_forbtn "style="color:white;" data-toggle="tooltip"
                                        data-placement="top" title="Go Back" type="submit"><i
                                            class="fa-sharp fa fa-arrow-left"></i></a>
                                </div>
                            </div>
                            <form action="" method="POST" id="update_data">
                                @csrf
                                <div class="card-body">
                                    <div class="card-header">
                                        <h4>Shipping Information</h4>
                                    </div>
                                    <input type="hidden" name="edit_id" id="edit_id"
                                        value="{{ $orderData->Single_Order_Id }}">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="row">
                                                    <!-- Left side: Pickup Information -->
                                                    <div class="col-md-6">
                                                        <div class="card-header">
                                                            <h4>Pickup Information</h4>
                                                        </div>

                                                        <div class="form-group pt-2" id="AddPassport" style="padding: 20px;">
                                                            <select class="form-control "
                                                                onchange="showallordershere(this.value)" required
                                                                id="select_box_id" onblur="oripindetails(this.value)">
                                                                <option value=""><b>Select Pickup Address</b></option>

                                                                @foreach ($pickupAddresses as $pickupAddress)
                                                                    <option value="{{ $pickupAddress->id }}"
                                                                        {{ $orderData->Address_Id == $pickupAddress->id ? 'selected' : '' }}>
                                                                        {{ $pickupAddress->name }}
                                                                        ({{ $pickupAddress->id }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                  <div id="All_Records">
                                                              </div>
                                                    </div>

                                                    <!-- Right side: Update Courier -->
                                                    <div class="col-sm-6">
                                                        <div class="card-header">
                                                            <h4>Update Courier</h4>
                                                        </div>

                                                    
                                                            <div class="form-group pt-2" id="AddPassport">
                                                                <select class="form-control" required id="awb_gen_by" name="awb_gen_by" >
                                                                    <option value=""><b>Select Courier</b></option>

                                                                    @foreach ($usercourirpermissions as $usercourir)
                                                                        <option value="{{ $usercourir->courier_id }}"
                                                                            {{ $orderData->awb_gen_by == $usercourir->courier_id ? 'selected' : '' }}>
                                                                            {{ $usercourir->courier_name }}
                                                                            ({{ $usercourir->courier_id }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row my-2">
                                        <div class="col-md-6">
                                            <div class="">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Customer Infomation</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputName">Order Number<span
                                                                        class="text-danger">*</span></label>

                                                                <input type="text" id="val-usernameqwe" name="orderno"
                                                                    class="form-control" placeholder="Enter Order Id"
                                                                    value="{{ $orderData->orderno ?? '' }} " readonly
                                                                    onKeyPress="if(this.value.length==30) return false;">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputName">Name<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="val-username" name="name"
                                                                    class="form-control" placeholder="Enter Customer name"
                                                                    required="" value="{{ $orderData->Name ?? '' }}"
                                                                    onKeyPress="if(this.value.length==30) return false;">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Mobile<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="input-group mb-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">+91</div>
                                                                    </div>
                                                                    <input type="number" id="password" name="mobile"
                                                                        maxlength="10" class="form-control contactvalid"
                                                                        placeholder="Enter  Mobile" required=""
                                                                        value="{{ $orderData->Mobile ?? '' }}"
                                                                        onKeyPress="if(this.value.length==10) return false;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Alternate Mobile</label>
                                                                <div class="input-group mb-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">+91</div>
                                                                    </div>
                                                                    <input type="number" id="password"
                                                                        name="customer_alt_mobile"
                                                                        class="form-control contactvalid"
                                                                        placeholder="Enter  Mobile"
                                                                        value="{{ $orderData->alt_mobile ?? '' }}"
                                                                        onKeyPress="if(this.value.length==10) return false;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <div class="form-group">
                                                                    <label for="inputAddress">Email</label>
                                                                    <input type="email" id="email" name="email"
                                                                        class="form-control"
                                                                        placeholder="Enter Customer email id"
                                                                        value="{{ $orderData->email ?? '' }}"
                                                                        onKeyPress="if(this.value.length==30) return false;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Pincode<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="destinationpincode"
                                                                    name="pin" class="form-control"
                                                                    placeholder="Enter Customer Pincode" required=""
                                                                    onblur="despindetails(this.value)" maxlength="6"
                                                                    minlength="6"
                                                                    value="{{ $orderData->Pincode ?? '' }}" required
                                                                    onKeyPress="if(this.value.length==6) return false;">
                                                                <input type="hidden" name="destinationpin-city"
                                                                    id="destinationpin-city"
                                                                    value="{{ $orderData->City ?? '' }}">
                                                                <input type="hidden" name="destinationpin-state"
                                                                    id="destinationpin-state"
                                                                    value="{{ $orderData->State ?? '' }}">
                                                                <input type="hidden" name="destinationpin-country"
                                                                    id="destinationpin-country" value="">
                                                                <input type="hidden" id="zonebtwn1" name="zone"
                                                                    value="{{ $orderData->zone ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputCity">City<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="customer-city" name="city"
                                                                    class="form-control" placeholder="Enter Customer City"
                                                                    required="" readonly
                                                                    value="{{ $orderData->City ?? '' }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputState">State<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="customer-state" name="state"
                                                                    class="form-control"
                                                                    placeholder="Enter Customer State" required=""
                                                                    readonly value="{{ $orderData->State ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAddress">Address1<small
                                                                    class="text-danger">*(Maximum 60 character allowed
                                                                    here)</small></label>
                                                            <input type="text" id="email" name="address"
                                                                class="form-control" maxlength="60"
                                                                placeholder="Enter Customer Address" required=""
                                                                value="{{ $orderData->Address ?? '' }}"
                                                                onKeyPress="if(this.value.length==60) return false;">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAddress">Address2</label>
                                                            <input type="text" id="email" name="address_sec"
                                                                class="form-control"maxlength="60"
                                                                placeholder="Enter Customer Address"
                                                                value="{{ $orderData->Address2 ?? '' }}"
                                                                onKeyPress="if(this.value.length==60) return false;">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAddress">Landmark</label>
                                                            <input type="text" id="email" name="landmarks"
                                                                class="form-control" placeholder="Enter Customer Landmark"
                                                                value="{{ $orderData->landmark ?? '' }}"
                                                                onKeyPress="if(this.value.length==60) return false;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 card ">
                                            <div class="">
                                                <div class="card-header">
                                                    <h4>Product Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="inputEmail4">Product Name<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="itemname" name="itemname"
                                                                class="form-control" placeholder="Order/Item Name *"
                                                                required="" value="{{ $orderData->Item_Name ?? '' }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputPassword4">Quantity<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" id="quantity" name="quantity"
                                                                class="form-control contactvalid"
                                                                placeholder="No Of Quantity *" min="1"
                                                                required="" value="{{ $orderData->Quantity ?? '' }}"
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputPassword4">Sku</label>
                                                            <input type="text" id="sku" name="sku"
                                                                class="form-control" placeholder="Sku" min="1"
                                                                value="{{ $orderData->sku ?? '' }}"
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputPassword4">Product Category</label>
                                                            <input type="text" name="product_category"
                                                                class="form-control" placeholder="Product Category"
                                                                value="{{ $orderData->product_category ?? '' }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                        <div class=" col-md-6">
                                                            <label class="form-label">Service Type</label>
                                                            <div class="form-group">
                                                                <input type="text" id="service_type"
                                                                    name="service_type" class="form-control"
                                                                    placeholder="Service Type"
                                                                    value="{{ $orderData->service_type ?? '' }}"
                                                                    onKeyPress="if(this.value.length==30) return false;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputPassword4">Product Value<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="valueininr" name="invoicevalue"
                                                                class="form-control contactvalid"
                                                                placeholder="Product Value" required=""
                                                                value="{{ $orderData->Invoice_Value ?? '' }}"
                                                                onKeyPress="if(this.value.length==15) return false;">
                                                        </div>

                                                        <input type="hidden" name="distancebtwn" id="distancebtwn">
                                                        <input type="hidden" name="distancebtwnkm" id="distancebtwnkm">
                                                        <input type="hidden" name="distancebtwntype"
                                                            id="distancebtwntype">
                                                        <div class=" col-md-6">
                                                            <label class="form-label">Payment Mode<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="form-group">
                                                                <select id="paymentmode" name="ordertype"
                                                                    class="form-control select2" style="width:100%"
                                                                    required>
                                                                    <option value="">Select Order Type</option>
                                                                    <option value="COD"
                                                                        @if (strtolower($orderData->Order_Type) == 'cod') selected @endif>
                                                                        COD</option>
                                                                    <option value="Prepaid"
                                                                        @if (strtolower($orderData->Order_Type) == 'prepaid') selected @endif>
                                                                        Prepaid</option>
                                                                </select>

                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="form-row " id="cod_hide">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputEmail4">COD Amount(in Rupees)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="confirmpassword" name="codamount"
                                                                class="form-control" placeholder="COD Amount *"
                                                                value="{{ $orderData->Cod_Amount ?? '' }}">
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="card-header">
                                                    <h4>Packet Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="inputState">Box Length(cm)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="lenghtcm" name="lenght"
                                                                class="form-control contactvalid"
                                                                placeholder="Enter Lenght *" required=""
                                                                onkeyup="VolumetricWeightCal(this.value,'length')"
                                                                onKeyPress="if(this.value.length==10) return false;"
                                                                value="{{ $orderData->Length ?? '' }}">
                                                        </div>
                                                        <div class="form-group ">
                                                            <input type="hidden" id="select21" name="itemextracare"
                                                                value="No">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="inputCity">Box Breadth(cm)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="breadthcm" name="widht"
                                                                class="form-control contactvalid"
                                                                placeholder="Enter Width *" required=""
                                                                onkeyup="VolumetricWeightCal(this.value,'breadth')"
                                                                value="{{ $orderData->Width ?? '' }}"
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="inputState">Box Height(cm)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="heightcm" name="height"
                                                                class="form-control contactvalid"
                                                                placeholder="Enter Height *"
                                                                required=""onkeyup="VolumetricWeightCal(this.value,'height')"
                                                                value="{{ $orderData->Height ?? '' }}"
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="inputEmail4">Physical Weight(KG)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="actualweight"
                                                                class="form-control contactvalid"
                                                                placeholder="Enter Actual Weight" id="actualweight"
                                                                onkeyup="freightWeight()" required=""
                                                                value="{{ $orderData->Actual_Weight ?? '' }}"
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="inputName">Chargeable Weight<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="ChargeableWeight"
                                                                id="FreightWeightshow" class="form-control"
                                                                placeholder="Chargeable Weight" title="Chargeable Weight"
                                                                readonly value="{{ $orderData->ChargeableWeight ?? '' }}"
                                                                onkeyup="precheckcalculaterate()">
                                                            <input type="hidden" name="FreightWeightare"
                                                                id="FreightWeightare">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="inputName">Volumetric Weight(Kg)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="VolumetricWeightshow"
                                                                id="VolumetricWeightshow" class="form-control"
                                                                placeholder="Vol Weight" title="Volumetric Weight"
                                                                readonly value="{{ $orderData->VolumetricWeigh ?? '' }}">
                                                            <input type="hidden" name="VolumetricWeight"
                                                                id="VolumetricWeight">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right" style="margin-right: -41px;">
                                        <button class="btn btn-primary mr-1" type="submit" name="submit1"
                                            id="update_order">Update Order</button>
                                        <!-- <button class="btn btn-primary mr-1" type="button" name="submit1" id="show_courier"onclick="calculateraterefresh()">Get Courier</button> -->
                                    </div>

                                    <!-- courier section start -->
                                    <div class="row courier_rowcss" id="ws" style="display:none;">
                                        <div class="card-body">
                                            <div class="table-responsive" id="rate_calcule_amountsdiv"
                                                class="showpincodecss">
                                                <div class="rate_cal_shadow_css">
                                                    <div class="row p-3">
                                                        <div class="col-md-6">
                                                            <strong>Pickup Pincode: </strong><span id="pikcuppinno"> <span>
                                                                    <br>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Destination Pincode : </strong><span id="destinpinno">
                                                                <span> <br>
                                                        </div>
                                                    </div>
                                                    <div id="b2c_calculate_list">B2C estimate couries loading...</div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary mr-1" type="submit" name="add_courier"
                                                    id="add_courier1">Add Courier</button>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary mr-1" type="button" name="placeorder"
                                                    id="place_orderr" style="display:none;">Place Order</button>
                                            </div>
                                        </div>
                                        <!-- Volumetric Weight Calculator -->
                                        <script type="text/javascript">
                                            function VolumetricWeightCal(datachange, cateis) {
                                                var vlength = $("#vlength").val();
                                                var vlengthlen = vlength.length;
                                                if (vlengthlen == 0) {
                                                    vlength = 1;
                                                }

                                                var vbreadth = $("#vbreadth").val();
                                                var vbreadthlen = vbreadth.length;
                                                if (vbreadthlen == 0) {
                                                    vbreadth = 1;
                                                }

                                                var vheight = $("#vheight").val();
                                                var vheightlen = vheight.length;
                                                if (vheightlen == 0) {
                                                    vheight = 1;
                                                }

                                                var valumetricweight = vlength * vbreadth * vheight / 5000;
                                                valumetricweightshow = valumetricweight + " KG";
                                                $("#VolumetricWeight").val(valumetricweight);
                                                $("#VolumetricWeightshow").val(valumetricweightshow);

                                                freightWeight();
                                                // calculateraterefresh();
                                            }

                                            // Freight Weight Calculation
                                            function freightWeight() {

                                                var actualweight = $("#actualweight").val();
                                                var VolumetricWeight = $("#VolumetricWeight").val();
                                                // alert(actualweight);
                                                var Weightpick = actualweight;

                                                if (VolumetricWeight > actualweight) {
                                                    var Weightpick = VolumetricWeight;
                                                }

                                                Weightpickshow = Weightpick + " KG";
                                                $("#FreightWeightare").val(Weightpick);
                                                $("#FreightWeightshow").val(Weightpickshow);

                                                calculateraterefresh();
                                            }

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
                                                    success: function(data) {
                                                        // data = isJson(data) ? JSON.parse(data) : data;

                                                        $("#b2c_calculate_list").html(data.html);
                                                        $("#rate_calcule_amountsdiv").css({
                                                            'display': 'block'
                                                        });
                                                    },
                                                    error: function(data) {
                                                        console.log('Error:', data);
                                                    }
                                                });
                                            }
                                        </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            if ($('#paymentmode').val() == 'COD') {
                $('#cod_hide').show();
            } else {
                $('#cod_hide').hide();
            }
            $("#show_courier").click(function() {
                $("#ws").toggle();
            });
        });
        $(function() {
            $('#paymentmode').change(function() {
                if ($('#paymentmode').val() == 'COD') {
                    $('#cod_hide').show();
                    $('#confirmpassword').attr('required', true);
                } else {
                    $('#cod_hide').hide();
                    $('#confirmpassword').attr('required', false);
                }
            });
        });

        $(document).on('submit', '#update_data', function(e) {
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: "{{ route('user.update-order-store') }}",
                data: $(this).serialize(),

                success: function(response) {

                    if (response.status == 'success') {

                        //alert(response.message);
                        //$('#add_courier1', current).attr('disabled', 'disabled');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('user.upload-order') }}";
                            }
                        });;

                        //window.location.reload();
                        //  toastr.success(response.message).delay(1000).fadeOut(1000);

                    } else if (response.status == 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                        toastr.error(response.message).delay(1000).fadeOut(1000);
                    } else if (response.status == 'exceptionError') {
                        CommonManager.forcelogout();
                    }
                },
            })


        });


        function showallordershere(param) {

            if (param == null) {
                alert('null');
            } else {
                // alert('Calling');
                $.ajax({
                    type: "GET",
                    url: "{{ route('user.get-pickupaddress') }}",
                    data: {
                        param: param
                    },
                    success: function(response) {

                        $("#All_Records").html(response.html);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        };
    </script>
@endsection
