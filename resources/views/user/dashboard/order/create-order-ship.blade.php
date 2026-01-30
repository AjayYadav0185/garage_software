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

        .form-group {
            margin-bottom: 1rem;
        }
    </style>
    <style>
        .input-error {
            border: 1px solid red !important;

        }
    </style>

    <div class="modal fade" id="exampleModalComing" tabindex="-1" role="dialog" aria-labelledby="exampleModalcenteredTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLongTitle">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <h5 class="modal-title" id="exampleModalLongTitle">Coming Soon.....</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="closecommingmodel">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="loader"></div>

    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header  ">
                                <h4 class="float-left">Create Order - </h4>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                </div>
                                <div class="col-sm-2 text-center">
                                    <a href="{{ route('user.upload-order') }}" class="btn btn-primary mr-1 go_forbtn "
                                        style="color:white;" data-toggle="tooltip" data-placement="top" title="Go Back"
                                        type="submit"><i class="fa-sharp fa fa-arrow-left"></i></a>
                                </div>
                            </div>
                            <form action="" method="POST" id="reset_alldata">
                                @csrf
                                <div class="card-body">
                                    <div class="card-header">
                                        <h4>Shipping Information</h4>
                                    </div>
                                    <input type="hidden" name="edit_id" id="" value="">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card ">
                                                <div class="row">
                                                    <!--<div class="col-md-1"></div>-->
                                                    <div class="col-md-5">
                                                        <div class="card-header">
                                                            <h4>Pickup Information</h4>
                                                        </div>
                                                        <div class="form-group pt-1" id="AddPassport"
                                                            style="display: display">
                                                            <select class="form-control ml-3"  name="pickupAddresses"
                                                                onchange="showallordershere(this.value)" required=""
                                                                id="select_box_id" onblur="oripindetails(this.value)">
                                                                <option value=""><b>Select Pickup Address</b></option>
                                                              @foreach ($pickupAddresses as $pickupAddress)
            <option value="{{ $pickupAddress->id }}"
                {{ $pickupAddress->mark_default == 1 ? 'selected' : '' }}>
                {{ $pickupAddress->name }} ({{ $pickupAddress->id }})
            </option>
        @endforeach
                                                            </select>
                                                        </div>
                                                        <div id="middleDetails">
                                                            <!--uncheck the defult for more address-->
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 pt-3">
                                                        <div id="All_Records">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="row my-2">
                                        {{-- customer informaton start --}}
                                        <div class="col-md-12">
                                            <div class="">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Customer Infomation</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="inputName">Order Number<span
                                                                        class="text-danger">*</span></label>
                                                                <?php
    $orderidcreate = 'RPDX00' . rand(1, 99) . mt_rand(1, 2147385600);
                                                                                    ?>
                                                                <input type="text" id="val-usernameqwe" name="orderno"
                                                                    class="form-control" placeholder="Enter Order Id"
                                                                    value="<?= $orderidcreate ?? '' ?> " required
                                                                    onKeyPress="if(this.value.length==30) return false;">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="inputName">Customer Name <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="val-username" name="name"
                                                                    class="form-control" placeholder="Enter Full Name"
                                                                    required="" value=""
                                                                    onKeyPress="if(this.value.length==30) return false;">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="inputEmail4">Mobile<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="input-group mb-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">+91</div>
                                                                    </div>
                                                                    <input type="number" id="password" name="mobile"
                                                                        maxlength="10" class="form-control contactvalid"
                                                                        placeholder="Enter  Mobile" required="" value=""
                                                                        onKeyPress="if(this.value.length==10) return false;">
                                                                </div>
                                                            </div>
                                                            <!-- <div class="form-row">
                                                                                                                  <div class=" col-md-4">
                                                                                                                  <label for="inputEmail4">Mobile<span class="text-danger">*</span></label>
                                                                                                                  <div class="input-group mb-2">
                                                                                                                  <div class="input-group-prepend">
                                                                                                                   <div class="input-group-text">+91</div>
                                                                                                                  </div>
                                                                                                                  <input type="number" id="password" name="mobile" maxlength="10"
                                                                                                                   class="form-control contactvalid" placeholder="Enter  Mobile" required="" value="" onKeyPress="if(this.value.length==10) return false;">
                                                                                                                  </div>
                                                                                                                  </div> -->

                                                            <div class="form-group col-md-4">
                                                                <label for="inputEmail4">Alternate Mobile</label>
                                                                <div class="input-group mb-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">+91</div>
                                                                    </div>
                                                                    <input type="number" id="password"
                                                                        name="customer_alt_mobile"
                                                                        class="form-control contactvalid"
                                                                        placeholder="Enter 10 dig Mobile Number " value=""
                                                                        onKeyPress="if(this.value.length==10) return false;">
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputAddress">Email</label>
                                                                    <input type="email" id="email" name="email"
                                                                        class="form-control"
                                                                        placeholder="Enter email address" value=""
                                                                        onKeyPress="if(this.value.length==30) return false;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="inputEmail4">Pincode<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="destinationpincode" name="pin"
                                                                    class="form-control" placeholder="Enter Pincode"
                                                                    required="" onblur="despindetails(this.value)"
                                                                    maxlength="6" minlength="6" value="" required
                                                                    onKeyPress="if(this.value.length==6) return false;">
                                                                <input type="hidden" name="destinationpin-city"
                                                                    id="destinationpin-city">
                                                                <input type="hidden" name="destinationpin-state"
                                                                    id="destinationpin-state">
                                                                <input type="hidden" name="destinationpin-country"
                                                                    id="destinationpin-country">
                                                                <input type="hidden" id="zonebtwn1" name="zone" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">

                                                            <!-- <div class="form-group col-md-4">
                                                                                                                  <label for="inputEmail4">Pincode<span class="text-danger">*</span></label>
                                                                                                                  <input type="text" id="destinationpincode" name="pin"
                                                                                                                  class="form-control" placeholder="Enter Customer Pincode" required="" onblur="despindetails(this.value)" maxlength="6" minlength="6" value="" required onKeyPress="if(this.value.length==6) return false;">
                                                                                                                  <input type="hidden" name="destinationpin-city"
                                                                                                                  id="destinationpin-city">
                                                                                                                  <input type="hidden" name="destinationpin-state"
                                                                                                                  id="destinationpin-state">
                                                                                                                  <input type="hidden" name="destinationpin-country"
                                                                                                                  id="destinationpin-country">
                                                                                                                  <input type="hidden" id="zonebtwn1" name="zone" value="">
                                                                                                                  </div>  -->

                                                            <div class="form-group col-md-3">
                                                                <label for="inputCity">City<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="customer-city" name="city"
                                                                    class="form-control" placeholder="City" required=""
                                                                    readonly value="">
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <label for="inputState">State<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="customer-state" name="state"
                                                                    class="form-control" placeholder="State" required=""
                                                                    readonly value="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputAddress">Address1<small
                                                                        class="text-danger">*(Maximum 60
                                                                        character allowed here)</small></label>
                                                                <input type="text" id="Address1" name="address"
                                                                    class="form-control" maxlength="60"
                                                                    placeholder="Enter Customer Address" required=""
                                                                    value=""
                                                                    onKeyPress="if(this.value.length==60) return false;">
                                                            </div>
                                                        </div>

                                                        <!-- <div class="form-group col-md-6">
                                                                                                                  <label for="inputAddress">Address1<small class="text-danger">*(Maximum 60 character allowed here)</small></label>
                                                                                                                  <input type="text" id="email" name="address"
                                                                                                                  class="form-control" maxlength="60" placeholder="Enter Customer Address"
                                                                                                                  required=""  value="" onKeyPress="if(this.value.length==60) return false;">
                                                                                                                  </div> -->
                                                        <div class="form-row gap-3">
                                                            <div class="form-group col-md-4">
                                                                <label for="inputAddress">Address2*(Maximum 60
                                                                    character allowed here)</small></label>
                                                                <input type="text" id="address_sec" name="address_sec"
                                                                    class="form-control" maxlength="60"
                                                                    placeholder="Enter Customer Address" value=""
                                                                    onKeyPress="if(this.value.length==60) return false;">
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="inputLandmark">Landmark</label>
                                                                <input type="text" id="landmarks" name="landmarks"
                                                                    class="form-control"
                                                                    placeholder="Enter Buyer Address's Landmark" value=""
                                                                    onKeyPress="if(this.value.length==60) return false;">
                                                            </div>
                                                        </div>

                                                        <!-- <div class="form-group col-md-4">
                                                                                                                  <label for="inputAddress">Landmark</label>
                                                                                                                  <input type="text" id="email" name="landmarks" class="form-control"
                                                                                                                  placeholder="Enter Customer Landmark" value="" onKeyPress="if(this.value.length==60) return false;">
                                                                                                                  </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- customer informaton end --}}

                                        {{-- Product Information Start --}}

                                        <div class="col-md-12">
                                            <div class="">
                                                <div class="card">

                                                    <div class="card-header">
                                                        <h4>Product Information</h4>
                                                    </div>
                                                    <div class="card-body">

                                                        <div id="product-form-container">
                                                            <!-- Initial Form -->
                                                            <div class="form-row product-form">
                                                                <div class="form-group col-md-4">
                                                                    <label for="itemname">Product Name<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="itemname" class="form-control"
                                                                        placeholder="Enter your product" required=""
                                                                        onkeypress="if(this.value.length==30) return false;">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="quantity">Quantity<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="number" name="quantity"
                                                                        class="form-control"
                                                                        placeholder="Min 1 qty required" min="1" required=""
                                                                        onkeypress="if(this.value.length==10) return false;">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="sku">SKU</label>
                                                                    <input type="text" name="sku" class="form-control"
                                                                        placeholder="SKU"
                                                                        onkeypress="if(this.value.length==10) return false;">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="product_category">Product Category</label>
                                                                    <select id="" name="product_category"
                                                                        class="form-control">
                                                                        <option value="">Select</option>

                                                                        @foreach ($prodcutCategory as $key => $item)
                                                                            <option value="{{ $item->name }}">
                                                                                {{ $item->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    {{-- <input type="text" name="product_category"
                                                                        class="form-control" placeholder="Product Category"
                                                                        onkeypress="if(this.value.length==30) return false;">
                                                                    --}}
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="invoicevalue">Product Value<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="invoicevalue"
                                                                        class="form-control" placeholder="0.00" required=""
                                                                        onkeypress="if(this.value.length==15) return false;">
                                                                </div>
                                                                <hr class="my-3">

                                                                <div class="form-group col-md-4">
                                                                    <label class="form-label">Payment Mode<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-group">
                                                                        <select id="paymentmode" name="ordertype"
                                                                            class="form-control  select2" style="width:100%"
                                                                            required="">
                                                                            <option value="">Select Order Type
                                                                            </option>
                                                                            <option value="COD" name="COD">COD
                                                                            </option>
                                                                            <option value="prepaid" name="Prepaid"
                                                                                id="hide">Prepaid</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <!-- <div class="d-flex justify-content-end">
                                                                                                                  {{-- <button type="button" id="add-more-btn" class="btn btn-primary btn-sm">Add More</button> --}}
                                                                                                                  <button type="button" id="opencomingmodel" class="btn btn-primary btn-sm">Add More</button>
                                                                                                                  </div> -->

                                                            {{--
                                                        </div> --}}


                                                        <div class="form-row">
                                                            <!-- <div class=" col-md-4">
                                                                                                                  <label class="form-label">Service Type</label>
                                                                                                                  <div class="form-group">
                                                                                                                  <input type="" id="service_type" name="service_type"
                                                                                                                  class="form-control" placeholder="Service Type"
                                                                                                                  value="" onKeyPress="if(this.value.length==30) return false;">
                                                                                                                  </div> -->
                                                        </div>

                                                        <input type="hidden" name="distancebtwn" id="distancebtwn">
                                                        <input type="hidden" name="distancebtwnkm" id="distancebtwnkm">
                                                        <input type="hidden" name="distancebtwntype" id="distancebtwntype">
                                                        <!-- <div class=" col-md-4">
                                                                                                                  <label class="form-label">Payment Mode<span class="text-danger">*</span></label>
                                                                                                                  <div class="form-group">
                                                                                                                  <select id="paymentmode" name="ordertype"
                                                                                                                   class="form-control select2" style="width:100%"
                                                                                                                   required="">
                                                                                                                   <option value="">Select Order Type </option>
                                                                                                                   <option value="COD" name="COD" >COD</option>
                                                                                                                   <option value="prepaid" name="Prepaid" id="hide" >Prepaid</option>
                                                                                                                  </select>
                                                                                                                  </div>

                                                                                                                  </div> -->

                                                        {{-- <div class=" col-md-4 cod_hide">
                                                            <label for="inputEmail4">COD Amount(in Rupees)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="confirmpassword" name="codamount"
                                                                class="form-control" placeholder="COD Amount *" value="">
                                                        </div> --}}

                                                        <div class="form-group md-4 " id="cod_hide"
                                                            style="width: 50%; max-width: 375px; padding: 10px; font-size: 14px;">
                                                            <div class="form-group">
                                                                <label for="inputEmail4">COD Amount(in Rupees)<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="confirmpassword" name="codamount"
                                                                    class="form-control"
                                                                    placeholder="enter the amount to collect from buyer"
                                                                    value="">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        {{-- <button type="button" id="add-more-btn"
                                                            class="btn btn-primary btn-sm">Add
                                                            More</button> --}}
                                                        <button type="button" id="opencomingmodel"
                                                            class="btn btn-primary btn-sm">Add
                                                            More</button>
                                                    </div>


                                                </div>

                                            </div>
                                        </div>


                                    </div>


                                    <style>
                                        .card .card-header {
                                            border-bottom: 1px solid #ffffff;

                                        }
                                    </style>
                                    <div class="col-md-12">
                                        <div class="">
                                            <div class="card">
                                                <div class="card-header border border-white"
                                                    style="border-color: #ffffff !important">
                                                    <h4>Packet Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="inputState">Box Length(cm)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="lenghtcm" name="lenght"
                                                                class="form-control contactvalid" placeholder="Length"
                                                                required=""
                                                                onkeyup="VolumetricWeightCal(this.value,'length')"
                                                                onKeyPress="if(this.value.length==10) return false;"
                                                                value="">
                                                        </div>
                                                        <div class="form-group ">
                                                            <input type="hidden" id="select21" name="itemextracare"
                                                                value="No">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="inputCity">Box Breadth(cm)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="breadthcm" name="widht"
                                                                class="form-control contactvalid" placeholder="Bredth"
                                                                required=""
                                                                onkeyup="VolumetricWeightCal(this.value,'breadth')" value=""
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="inputState">Box Height(cm)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="heightcm" name="height"
                                                                class="form-control contactvalid" placeholder="Height"
                                                                required=""
                                                                onkeyup="VolumetricWeightCal(this.value,'height')" value=""
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="inputEmail4">Physical Weight(KG)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="actualweight"
                                                                class="form-control floatclass" placeholder="0.00"
                                                                id="actualweight" onkeyup="freightWeight()" required=""
                                                                value=""
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="inputName">Volumetric Weight(KG)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="VolumetricWeightshow"
                                                                id="VolumetricWeightshow" class="form-control"
                                                                placeholder="0.00" title="Volumetric Weight" readonly
                                                                value="">
                                                            <input type="hidden" name="VolumetricWeight"
                                                                id="VolumetricWeight">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="inputName">Chargeable Weight(KG)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="ChargeableWeight"
                                                                id="FreightWeightshow" class="form-control"
                                                                placeholder="0.00" title="Chargeable Weight" readonly
                                                                value="" onkeyup="precheckcalculaterate()">
                                                            <input type="hidden" name="FreightWeightare"
                                                                id="FreightWeightare">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right" style="margin-right: -41px;">
                                    <button class="btn btn-primary mr-1" type="button" name="submit1" id="show_courier"
                                        onclick="calculateraterefresh()">Get Courier</button>
                                </div>

                                <!-- courier section start -->
                                <div class="row courier_rowcss" id="ws" style="display:none;">
                                    <div class="col-md-12">
                                        <div class="">
                                            <div class="card-body">
                                                <div class="table-responsive" id="rate_calcule_amountsdiv"
                                                    class="showpincodecss">
                                                    <div class="rate_cal_shadow_css">
                                                        <div class="row p-3">
                                                            <div class="col-md-4" style="color: blue;text-align:left;">
                                                                <strong>Pickup Pincode: <span id="pikcuppinno"
                                                                        style="color: black;">
                                                                        <span></strong> <br>
                                                            </div>
                                                            <div class="col-md-4" style="color: blue;text-align:center;">
                                                                <strong>Weight: <span id="chargingweight"
                                                                        style="color: black;">
                                                                        <span></strong> <br>
                                                            </div>
                                                            <div class="col-md-4" style="color: blue;text-align:right;">
                                                                <strong>Destination Pincode : <span id="destinpinno"
                                                                        style="color: black;">
                                                                        <span> </strong><br>
                                                            </div>
                                                        </div>
                                                        <div id="b2c_calculate_list">B2C estimate couries loading...
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-right">
                                                    <button class="btn btn-primary mr-1" type="submit" name="add_courier"
                                                        id="add_courier1">Add
                                                        Courier</button>
                                                </div>
                                                <div class="card-footer text-right">
                                                    <button class="btn btn-primary mr-1" type="button" name="placeorder"
                                                        id="place_orderr" style="display:none;">Ship Order</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <script>
                                    $(document).ready(function () {

                                        $('#opencomingmodel').on('click', function () {

                                            // alert('Hello');

                                            $('#exampleModalComing').modal('show');

                                        });

                                        $('#closecommingmodel').on('click', function () {

                                            $('#exampleModalComing').modal('hide');

                                        });

                                    });
                                </script>

                                <script>
                                    document.getElementById('add-more-btn').addEventListener('click', function () {
                                        const container = document.getElementById('product-form-container');
                                        const formTemplate = `
                          <div class="form-row product-form">
                           <div class="form-group col-md-12">
                          <label for="itemname">Product Name<span class="text-danger">*</span></label>
                          <input type="text"  class="form-control" placeholder="Order/Item Name *" 
                           onkeypress="if(this.value.length==30) return false;">
                           </div>
                           <div class="form-group col-md-3">
                          <label for="quantity">Quantity<span class="text-danger">*</span></label>
                          <input type="number"  class="form-control" placeholder="No Of Quantity *" min="1" 
                           onkeypress="if(this.value.length==10) return false;">
                           </div>
                           <div class="form-group col-md-3">
                          <label for="sku">SKU</label>
                          <input type="text" class="form-control" placeholder="SKU" onkeypress="if(this.value.length==10) return false;">
                           </div>
                           <div class="form-group col-md-3">
                          <label for="product_category">Product Category</label>
                          <input type="text"  class="form-control" placeholder="Product Category"
                           onkeypress="if(this.value.length==30) return false;">
                           </div>
                           <div class="form-group col-md-3">
                          <label for="invoicevalue">Product Value<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" placeholder="Product Value"
                           onkeypress="if(this.value.length==15) return false;">
                           </div>
                           <hr class="my-3">
                          </div>
                           `;
                                        container.insertAdjacentHTML('beforeend', formTemplate);
                                    });
                                </script>



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
                                        let valid = true;
                                         const pickupAddress = document.querySelector('select[name="pickupAddresses"]');
                                        const orderNoInput = document.getElementById('val-usernameqwe');
                                        const nameInput = document.getElementById('val-username');
                                        const mobileInput = document.querySelector('input[name="mobile"]');
                                        const altMobileInput = document.querySelector('input[name="customer_alt_mobile"]');
                                        const emailInput = document.getElementById('email');
                                        const pincodeInput = document.getElementById('destinationpincode');
                                        const addressInput = document.getElementById('Address1');
                                        const itemname = document.querySelector('input[name="itemname"]');
                                        const quantity = document.querySelector('input[name="quantity"]');
                                        const invoicevalue = document.querySelector('input[name="invoicevalue"]');
                                        const paymentmode = document.querySelector('select[name="ordertype"]');
                                        const lengthInput = document.getElementById('lenghtcm');
                                        const breadthInput = document.getElementById('breadthcm');
                                        const heightInput = document.getElementById('heightcm');
                                        const weightInput = document.getElementById('actualweight');

                                        document.querySelectorAll('.input-error').forEach(el => {
                                            el.classList.remove('input-error');
                                            if (el.dataset.placeholder) {
                                                el.placeholder = el.dataset.placeholder;
                                                delete el.dataset.placeholder;
                                            }
                                        });

                                        function showError(input, message) {
                                            input.classList.add('input-error');
                                            input.dataset.placeholder = input.placeholder; // Save original
                                            input.value = '';
                                            input.placeholder = message;
                                            valid = false;
                                        }
                                        if (!orderNoInput.value.trim()) showError(orderNoInput, 'Order Number is required.');
                                        if (!nameInput.value.trim()) showError(nameInput, 'Name is required.');

                                       if (!pickupAddress.value.trim()) {
                                            pickupAddress.classList.add('input-error');
                                            valid = false;
                                        } else {
                                            pickupAddress.classList.remove('input-error');
                                        }

                                        
                                        const mobile = mobileInput.value.trim();
                                        if (!mobile || !/^\d{10}$/.test(mobile)) {
                                            showError(mobileInput, 'Valid 10-digit mobile number required.');
                                        }

                                        const altMobile = altMobileInput.value.trim();
                                        if (altMobile && !/^\d{10}$/.test(altMobile)) {
                                            showError(altMobileInput, 'Alternate Mobile must be 10 digits.');
                                        }

                                        const email = emailInput.value.trim();
                                        if (email && !/^\S+@\S+\.\S+$/.test(email)) {
                                            showError(emailInput, 'Enter a valid email address.');
                                        }

                                        const pincode = pincodeInput.value.trim();
                                        if (!pincode || !/^\d{6}$/.test(pincode)) {
                                            showError(pincodeInput, 'Valid 6-digit pincode required.');
                                        }
                                        if (!addressInput.value.trim()) {
                                            showError(addressInput, 'Address is required.');
                                        } else if (addressInput.value.length > 60) {
                                            showError(addressInput, 'Address cannot exceed 60 characters.');
                                        }

                                        if (!itemname.value.trim()) {
                                            showError(itemname, 'Product Name is required');
                                        }

                                        if (!quantity.value.trim() || parseInt(quantity.value) < 1) {
                                            showError(quantity, 'Quantity must be at least 1');
                                        }

                                        if (!invoicevalue.value.trim()) {
                                            showError(invoicevalue, 'Product Value is required');
                                        }

                                        if (!paymentmode.value.trim()) {
                                            paymentmode.classList.add('input-error');
                                            valid = false;
                                        } else {
                                            paymentmode.classList.remove('input-error');
                                        }


                                        if (!lengthInput.value.trim() || isNaN(lengthInput.value) || Number(lengthInput.value) <= 0) {
                                            showError(lengthInput, 'Enter valid Length');
                                        }

                                        if (!breadthInput.value.trim() || isNaN(breadthInput.value) || Number(breadthInput.value) <= 0) {
                                            showError(breadthInput, 'Enter valid Width');
                                        }

                                        if (!heightInput.value.trim() || isNaN(heightInput.value) || Number(heightInput.value) <= 0) {
                                            showError(heightInput, 'Enter valid Height');
                                        }
                                        const val = weightInput.value.trim();
                                        if (!val || isNaN(val) || Number(val) <= 0) {
                                            weightInput.classList.add('input-error');
                                            weightInput.value = '';
                                            weightInput.placeholder = 'Enter valid weight (kg)';
                                            return false;
                                        }


                                        if (!valid) {
                                            $("#show_courier").click(function () {
                                                $("#ws").toggle();
                                            });
                                        } else {
                                            $('#ws').show();

                                        }

                                        if (!valid) return;


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
                                                param: zone,
                                                paymode: paymode,
                                                prodamt: prodamt,
                                                codamt: codamt,
                                                freightWeightare: freightWeightare,
                                                order_type: order_type,
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

                                    $(document).ready(function () {
                                        $('#val-usernameqwe, #val-username, input[name="mobile"], input[name="customer_alt_mobile"], #email, #destinationpincode, #Address1, input[name="itemname"], input[name="quantity"], input[name="invoicevalue"], select[name="ordertype"], #lenghtcm, #breadthcm, #heightcm, #actualweight')
                                            .on('input change blur', function () {
                                                $('#ws').hide();
                                                // checklaneandamt();
                                            });
                                    });
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function () {
            if ($('#paymentmode').val() == 'COD') {
                $('#cod_hide').show();
            } else {
                $('#cod_hide').hide();
            }

        });
        $(function () {
            $('#paymentmode').change(function () {
                if ($('#paymentmode').val() == 'COD') {
                    $('#cod_hide').show();
                    $('#confirmpassword').attr('required', true);
                } else {
                    $('#cod_hide').hide();
                    $('#confirmpassword').attr('required', false);
                }
            });
        });
        $(document).on('submit', '#reset_alldata', function (e) {
            e.preventDefault();
            var sdsg = $('.qwerty:checked').val();
            var Formdata = $(this).serialize()
            $.ajax({
                method: "POST",
                url: "singleorderdata_store",
                data: $(this).serialize(),
                sdsg: sdsg,
                success: function (response) {
                    if (response.status == 'success') {
                        // akash
                        //  alert(response.message);
                        //$('#add_courier1').css('display' , 'none');
                        //$('#add_courier1', current).attr('disabled', 'disabled');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            customClass: {
                                popup: 'small-swal-popup',
                            }
                        });
                        toastr.success(response.message).delay(1000).fadeOut(1000);
                        // $("#add_courier1").click(function () {
                        $("#add_courier1").hide();
                        $("#place_orderr").show();
                        // })
                    } else if (response.status == 'error') {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                            customClass: {
                                popup: 'small-swal-popup',
                            }
                        });
                        $("#place_orderr").hide();
                        toastr.error(response.message).delay(1000).fadeOut(1000);
                    } else if (response.status == 'exceptionError') {
                        // alert('c');
                        CommonManager.forcelogout();
                    }
                },
            })


        });
        $(document).on("change", ".qwerty", function () {
            $("#add_courier1").show();
        });


        function showallordershere(param) {

            if (param == null) {
                alert('null');
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ route('user.get-pickupaddress') }}",
                    data: {
                        param: param
                    },
                    success: function (response) {

                        $("#All_Records").html(response.html);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        };
    </script>
    <script>
        // $("#add_courier1").click(function () {
        // $("#place_orderr").show();
        // })
    </script>
    <script>
        $('body').on('click', '#place_orderr', function () {
            var myCheckboxes = [];
            // var axaxa = $('.qwerty:checked').val();
            var carrom = $('#val-usernameqwe').val();
            var myCheckboxes = new Array();
            myCheckboxes.push(carrom);
            Swal.fire({
                title: "Please wait...",
                html: "Order shipping is in progress.",
                customClass: {
                    popup: 'small-swal-popup',
                }
            })
            Swal.showLoading();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "place-order",
                data: {
                    myCheckboxes: myCheckboxes,
                    status: 1
                },
                success: function (response) {

                    if (response.success) {

                        Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: response.status,

                            customClass: {
                                popup: 'small-swal-popup',
                            }

                        }).then(function () {
                            window.location.href = '{{ route('user.shipment') }}';
                        });

                    } else {


                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.msg,
                            customClass: {
                                popup: 'small-swal-popup',
                            }
                        }).then(function () {
                            window.location.reload();
                        });

                    }

                }
            })
        });
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


    <script>


@endsection