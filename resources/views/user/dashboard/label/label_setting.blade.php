@extends('user.dashboard.layout.master')
@section('user-contant')
    <style>
        .hover:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateZ(-5px);
            transition: all 0.3s ease-in-out;
        }

        .card-body::-webkit-scrollbar {
            display: none;
        }

        .card-body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* .card .card-header {
                                                                                                                                                                                        background-color: grey;
                                                                                                                                                                                        padding: 40px;
                                                                                                                                                                                        border-bottom: 1px solid #ecf3fa;
                                                                                                                                                                                        border-top-left-radius: 15px;
                                                                                                                                                                                        border-top-right-radius: 15px;
                                                                                                                                                                                        position: relative;
                                                                                                                                                                                    } */

        .card .card-header {
            background-color: rgb(143, 143, 143);
            border-bottom: 1px solid #ecf3fa;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            position: relative;
            color: white;
        }
    </style>


    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card-header supreme-container" style="display: block;">
                        <div class="row">
                            <div class="col-sm-10">
                                <ul class="nav nav-pills" id="myTab3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                            type="button" role="tab" aria-controls="home" aria-selected="true">Global Label
                                            setting
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                            type="button" role="tab" aria-controls="profile" aria-selected="false">Label
                                            setting</a>
                                    </li>
                                </ul>
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
                    <div class="card bg-light d-flex">
                        <br>
                        <div class="tab-content " id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="row px-2 overflow-visible">

                                    <div class="col-lg-6 col-md-6 col-sm-6  m-b-30 box-shadow">
                                        <div class="card box w-100 hover bg-light">
                                            <div class="card-body rounded overflow-auto"
                                                style="background: #f1f5f9; max-height: 1100px;">

                                                {{-- accept-charset="utf-8" --}}
                                                <form method="POST" action="" class="createform"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="csrf_test_name"
                                                        value="d40149604185e2828a6881e6caf3a86c">
                                                    <div class="card-body">
                                                        <div class="show-logo watsapp-form border-secondary border-bottom border-bottom-dashed"
                                                            style="border-bottom: none !important;">
                                                            {{-- class="show-logo watsapp-form py-3 border-secondary
                                                            border-bottom border-bottom-dashed" --}}

                                                            <h5 class="card-header bg-primary">Common Setting
                                                            </h5>
                                                            <div class="ml-3">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        name="show_logo" id="ShowLogo" value="1">
                                                                    <label class="custom-control-label fw-500 mb-0"
                                                                        for="ShowLogo">Show Logo on
                                                                        Label</label>
                                                                    <div class="mb-2 small text-dark">(Select
                                                                        the box to upload your brand’s logo to
                                                                        display on labels. Or, you may select
                                                                        “Use Channel Logo” to show on labels)
                                                                    </div>
                                                                </div>
                                                                <div class="box-show d-none mt-3">
                                                                    <div class="row">
                                                                        <div class="col-sm-10">
                                                                            <div class="form-row">
                                                                                <div class="form-group col-sm-7">
                                                                                    <label
                                                                                        class="form-label d-block fw-400">
                                                                                        Upload Logo
                                                                                        <small>(Desktop) No file
                                                                                            chosen</small>
                                                                                    </label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                            name="custom_logo_url" class=""
                                                                                            id="inputGroupFile02"
                                                                                            accept="image/png, image/jpg, image/jpeg">
                                                                                        <label class=" rounded-pill"
                                                                                            for="inputGroupFile02">Choose
                                                                                            file...</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="custom-control custom-checkbox mt-3">
                                                                                        <input type="checkbox"
                                                                                            name="show_channel_logo"
                                                                                            class="custom-control-input"
                                                                                            id="SelectLogo" value="1">
                                                                                        <label
                                                                                            class="custom-control-label fw-400"
                                                                                            for="SelectLogo">Use
                                                                                            Channel Logo</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="form-group col-sm-4 offset-sm-1 mb-0">
                                                                                    <div class="img-show my-3">
                                                                                        <img src="{{ asset('assets/icon/logo.png') }}"
                                                                                            id="blah" width="80"
                                                                                            class="img-fluid">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ml-3">
                                                                <div class="show-logo watsapp-form pt-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="show_support_email"
                                                                            class="custom-control-input" id="ShowSupport"
                                                                            value="1">
                                                                        <label class="custom-control-label fw-500"
                                                                            for="ShowSupport">Show Support
                                                                            Email/Mobile No</label>
                                                                        <div class="mb-2 small text-dark">
                                                                            (Select the box to showcase support
                                                                            contact info on labels)</div>
                                                                    </div>
                                                                    <div class="box-ShowSupport d-none mt-3">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-row">
                                                                                    <div class="form-group col-sm-6">
                                                                                        <label class="fw-400">Enter
                                                                                            Email Id</label>
                                                                                        <input type="text"
                                                                                            id="support_email"
                                                                                            name="support_email"
                                                                                            onchange="updatewarehousedetail()"
                                                                                            class="form-control rounded-pill fw-400"
                                                                                            value="" placeholder="">
                                                                                    </div>
                                                                                    <div class="form-group col-sm-6">
                                                                                        <label class="fw-400">Enter
                                                                                            Mobile No</label>
                                                                                        <input type="text" maxlength="10"
                                                                                            onchange="updatewarehousedetail()"
                                                                                            id="support_mobile"
                                                                                            name="support_mobile"
                                                                                            class="form-control rounded-pill fw-400"
                                                                                            value="" placeholder="">
                                                                                    </div>
                                                                                    {{-- <div
                                                                                        class="form-group col-sm-12 mb-0">
                                                                                        <div
                                                                                            class="custom-control custom-checkbox">
                                                                                            <input type="checkbox"
                                                                                                name="warehouse_support_email_mobile"
                                                                                                class="custom-control-input"
                                                                                                id="WarehouseSupport"
                                                                                                value="1">
                                                                                            <label
                                                                                                class="custom-control-label fw-400"
                                                                                                for="WarehouseSupport">Use
                                                                                                Warehouse Support
                                                                                                Email/Mobile</label>
                                                                                            <div
                                                                                                class="mb-2 small text-dark">
                                                                                                (Select the box to showcase
                                                                                                warehouse support contact
                                                                                                info fetched from warehouse
                                                                                                settings)</div>
                                                                                        </div>
                                                                                    </div> --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="hide_customer_mobile"
                                                                            class="custom-control-input" id="CustomerMob"
                                                                            value="1">
                                                                        <label class="custom-control-label fw-400"
                                                                            for="CustomerMob">Hide
                                                                            Customer Mobile Number</label>
                                                                        <div class="mb-2 small text-dark">(Select the
                                                                            box to hide the customer's mobile numbers on
                                                                            labels)</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="card-body">
                                                        <div
                                                            class="show-logo watsapp-form pt-3 border-secondary border-bottom border-bottom-dashed">
                                                            <h5 class="card-header bg-primary">Warehouse Setting</h5>
                                                            <div class="mb-2 small text-dark">(Select the box
                                                                to hide confidential warehouse details on
                                                                labels)</div>
                                                            <div class="ml-3">
                                                                <div class="form-row">
                                                                    <div class="form-group col-sm-6">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                name="hide_warehouse_address"
                                                                                class="custom-control-input"
                                                                                id="PickupAddress" value="1">
                                                                            <label class="custom-control-label fw-500"
                                                                                for="PickupAddress">Hide Pickup
                                                                                Address</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                name="hide_warehouse_mobile"
                                                                                class="custom-control-input"
                                                                                id="PickupMobile" value="1">
                                                                            <label class="custom-control-label fw-500"
                                                                                for="PickupMobile">Hide Pickup
                                                                                Mobile Number</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-sm-6">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" name="hide_rto_address"
                                                                                class="custom-control-input" id="RTOAddress"
                                                                                value="1">
                                                                            <label class="custom-control-label fw-500"
                                                                                for="RTOAddress">Hide RTO
                                                                                Address</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" name="hide_rto_mobile"
                                                                                class="custom-control-input" id="RTOMobile"
                                                                                value="1">
                                                                            <label class="custom-control-label fw-500"
                                                                                for="RTOMobile">Hide RTO Mobile
                                                                                Number</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-sm-6">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" name="hide_gst_no"
                                                                                class="custom-control-input" id="GSTNumber"
                                                                                value="1">
                                                                            <label class="custom-control-label fw-500"
                                                                                for="GSTNumber">Hide GST
                                                                                Number</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-sm-6">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" name="hide_contact_name"
                                                                                class="custom-control-input"
                                                                                id="ContactName" value="1">
                                                                            <label class="custom-control-label fw-500"
                                                                                for="ContactName">Hide Pickup
                                                                                Contact Name</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-sm-6">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                name="hide_rto_contact_name"
                                                                                class="custom-control-input"
                                                                                id="RtoContactName" value="1">
                                                                            <label class="custom-control-label fw-500"
                                                                                for="RtoContactName">Hide RTO
                                                                                Contact Name</label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="show-logo watsapp-form pt-3">
                                                            {{-- <h5 class="fw-500 mb-0">Hide Product Details</h5> --}}
                                                            <h5 class=" card-header bg-primary fw-500 mb-0">
                                                                Hide Product Details</h5>

                                                            <div class="mb-2 small text-dark">(Select the box
                                                                to hide product details on labels)</div>
                                                            <div class="ml-3">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-row">
                                                                            <div class="form-group col-sm-6">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" name="hide_sku"
                                                                                        class="custom-control-input"
                                                                                        id="HideSKU" value="1">
                                                                                    <label
                                                                                        class="custom-control-label fw-400"
                                                                                        for="HideSKU">Hide
                                                                                        Product</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        name="hide_item_name"
                                                                                        class="custom-control-input"
                                                                                        id="HidePRO" value="1">
                                                                                    <label
                                                                                        class="custom-control-label fw-400"
                                                                                        for="HidePRO">Hide
                                                                                        Value</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" name="hide_qty"
                                                                                        class="custom-control-input"
                                                                                        id="HideQTY" value="1">
                                                                                    <label
                                                                                        class="custom-control-label fw-400"
                                                                                        for="HideQTY">Hide
                                                                                        QTY</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-6">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        name="hide_item_amount"
                                                                                        class="custom-control-input"
                                                                                        id="HideAmount" value="1">
                                                                                    <label
                                                                                        class="custom-control-label fw-400"
                                                                                        for="HideAmount">Hide
                                                                                        Weight</label>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group col-sm-6">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        name="hide_discount"
                                                                                        class="custom-control-input"
                                                                                        id="HideDiscount" value="1">
                                                                                    <label
                                                                                        class="custom-control-label fw-400"
                                                                                        for="HideDiscount">Hide
                                                                                        Dimension </label>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ml-3">
                                                                <div class="show-logo watsapp-form pb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="hide_order_amount"
                                                                            class="custom-control-input" id="HideOrder"
                                                                            value="1">
                                                                        <label class="custom-control-label fw-500"
                                                                            for="HideOrder">Hide Order
                                                                            Amount/Collectable Amount</label>
                                                                        <div class="mb-2 small text-dark">
                                                                            (Select the box to hide the order
                                                                            (COD/Prepaid) value on labels)</div>
                                                                    </div>
                                                                    <div class="box-HideOrder d-none mt-3 mb-2">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-row">
                                                                                    <div class="form-group col-sm-4 mb-0">
                                                                                        <div
                                                                                            class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="radio"
                                                                                                name="order_amount_cod"
                                                                                                class="custom-control-input"
                                                                                                id="HideCod" value="1">
                                                                                            <label
                                                                                                class="custom-control-label fw-400"
                                                                                                for="HideCod">Cod</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group col-sm-4 mb-0">
                                                                                        <div
                                                                                            class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="radio"
                                                                                                name="order_amount_cod"
                                                                                                class="custom-control-input"
                                                                                                id="HidePrepaid" value="2">
                                                                                            <label
                                                                                                class="custom-control-label fw-400"
                                                                                                for="HidePrepaid">Prepaid</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ml-3">
                                                                <div class="form-row">
                                                                    {{-- <div class="form-group col-sm-8">
                                                                        <label class="fw-500 mb-0">Trim SKU Upto
                                                                        </label>
                                                                        <div class="mb-2 small text-dark">(Trim the SKU
                                                                            number if it exceeds the provided number of
                                                                            characters)</div>
                                                                        <input type="number" name="sku_char_limit"
                                                                            class="form-control rounded-pill fw-400 sku_number"
                                                                            value="" placeholder="" onkeyup="skutrim(this)"
                                                                            fdprocessedid="4965kr">
                                                                    </div>
                                                                    <div class="form-group col-sm-8">
                                                                        <label class="fw-500 mb-0">Trim Product Name
                                                                            Upto </label>
                                                                        <div class="mb-2 small text-dark">(Trim the
                                                                            product name if it exceeds the provided
                                                                            number of characters)</div>
                                                                        <input type="number" name="item_name_char_limit"
                                                                            class="form-control rounded-pill fw-400 product_qty"
                                                                            value="" placeholder=""
                                                                            onkeyup="producttrim(this)"
                                                                            fdprocessedid="rsgtm">
                                                                    </div>
                                                                    <div class="form-group col-sm-8">
                                                                        <label class="fw-500 mb-0">Show Number of Line
                                                                            Items</label>
                                                                        <div class="mb-2 small text-dark">(Hide the
                                                                            number of line items up to the provided
                                                                            number)</div>
                                                                        <input type="number" name="no_of_line_items"
                                                                            class="form-control rounded-pill fw-400"
                                                                            value="" placeholder="" onkeyup="numberLine()"
                                                                            fdprocessedid="u345nl">
                                                                    </div> --}}
                                                                    <div class="form-group col-sm-12">
                                                                        <button
                                                                            class="btn btn-dark btn-custom rounded-pill mt-2 px-4"
                                                                            fdprocessedid="uf3fka" id="addrecord">Save
                                                                            Setting</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                {{-- aks --}}

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-sm-6 m-b-30 box-shadow position-relative">
                                        <div class="card-body bg-white border border-dark position-relative">
                                            <div>
                                                <table width="100%" class="table table-bordered position-relative">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2" class="py-2 px-3">
                                                                <table width="100%" cellpadding="0" cellspacing="0"
                                                                    class="table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="text-left" colspan="20">
                                                                                <span class="box-show hidden">
                                                                                    <img src="{{ asset('assets/icon/logo.png') }}"
                                                                                        width="110"
                                                                                        class="channelimage hidden">
                                                                                </span>
                                                                            </td>

                                                                            <td width="50%">
                                                                                {{-- <p class="mb-0">
                                                                                    <strong>Customer name : </strong>Mr.
                                                                                    Akash Kumar
                                                                                    <br> <strong>Address : </strong> 403,
                                                                                    4th Floor, TOWER-B, MILLENNIUM PLAZA,
                                                                                    Sushant Lok Phase I, Sector 27,
                                                                                    Gurugram, Haryana
                                                                                    <br>
                                                                                    <strong>Pincode : </strong> 122001
                                                                                    <br>
                                                                                    <span
                                                                                        class="customer-mob position-sticky"><strong>Mobile
                                                                                            : </strong> 9870992118</span>
                                                                                </p> --}}
                                                                                <p class="mb-0">
                                                                                    <strong>Customer name :</strong> Mr.
                                                                                    Jone
                                                                                    <br> <strong>Address:</strong>
                                                                                    <span>H No 123, XYZ Apartment Sector 10,
                                                                                        Gurgaon
                                                                                        <br> <strong>Pincode : </strong>
                                                                                        122001
                                                                                        <br> <span class="customer-mob">
                                                                                            <strong> Mobile No
                                                                                                :</strong>1234567890
                                                                                        </span>
                                                                                        <br>
                                                                                    </span>
                                                                                </p>
                                                                            </td>
                                                     
                                                                            <td class="">
                                                                                {{-- <p id="HidePrepaid">Prepaid</p> --}}
                                                                                <p class="hide-cod">COD</p>
                                                                                <hr>
                                                                                <p>Amount : 1999</p>
                                                                            </td>
                                                            
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="py-2 px-3">
                                                                <table width="100%" cellpadding="0" cellspacing="0"
                                                                    class="table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="text-center col-8">
                                                                                <span>AWB - 9185553</span>
                                                                                <br>
                                                                                <img src="{{ asset('assets/icon/9185553.png') }}"
                                                                                    width="180" class=""
                                                                                    style="margin-top: -15px;">
                                                                            </td>

                                                                            <td>
                                                                                <p class="mb-0">
                                                                                    <span class="d-block">Shadowfax
                                                                                        Surface 0.5 Kg</span>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="pb-2 px-3">
                                                                <table width="100%" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="50%" class="text-center">
                                                                                <p class="mb-0"><span class="d-block">
                                                                                        Order ID :</span></p>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <p class="mb-0"><span class="d-block">Date:
                                                                                        16-07-2024</span></p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2 px-3">
                                                                <table width="100%" class="text-center" id="price-table">
                                                                    <thead>
                                                                        {{-- sku-col-hide --}}
                                                                        <tr class="header-th">
                                                                            <th class="p-1 border-bottom border-right fw-600 sku-col-hide"
                                                                                data-id="sku-col-hide">Product
                                                                            </th>
                                                                            <th class="p-1 border-bottom border-right fw-600 qty-col-hide"
                                                                                data-id="qty-col-hide ">
                                                                                Quantity</th>
                                                                            <th class="p-1 border-bottom border-right fw-600 product-col-hide"
                                                                                data-id="product-col-hide">
                                                                                Value</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="p-1 border-bottom border-right sku-col-hide"
                                                                                data-text="MOB-M-202-LAV">
                                                                                Battery</td>
                                                                            <td class="p-1 border-bottom border-right product-col-hide"
                                                                                data-text="Mobile">1</td>
                                                                            <td
                                                                                class="p-1 border-bottom border-right qty-col-hide">
                                                                                <span class="hide-qty">1000</span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table width="100%" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr class="total-show-line">
                                                                            <td width="50%" class="text-center subtotal">
                                                                                <p class="mb-0"><span class="d-block">Weight
                                                                                        (kg): 2 KG</span></p>
                                                                            </td>
                                                                            <td class="text-center dimensionhide">
                                                                                <p class="mb-0"><span
                                                                                        class="d-block ">Dimension
                                                                                        (cm): 1*1*1</span></p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2 px-3">
                                                                <table width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="mb-0">
                                                                                    <strong
                                                                                        class="d-block pickup-address"><b>Seller
                                                                                            Name :</b> New Warehosue
                                                                                        APP</strong>
                                                                                    <span
                                                                                        class="d-block fw-500 pickup-address mt-2">
                                                                                        <span
                                                                                            class="fw-400 hide-contact-name d-block">
                                                                                            <b>Pickup Details
                                                                                                :</b></span></span>
                                                                                    <span class="d-block fw-400"><label
                                                                                            class="hide-pickup-address mb-0">Address
                                                                                            :
                                                                                        </label></span>
                                                                                    <span
                                                                                        class="fw-400 hide-pickup-address">Pincode:
                                                                                    </span> <br>

                                                                                    <span class="fw-400 hide-pickup-mob">
                                                                                        Contact Number :

                                                                                    </span> <br>
                                                                                    <span class="fw-400 hide-gst-number">
                                                                                        GST: </span>
                                                                                </p>
                                                                                <br>
                                                                                <p class="mb-0">
                                                                                    {{-- <strong
                                                                                        class="d-block return-address"></strong>
                                                                                    --}}
                                                                                    <strong class="d-block return-address">
                                                                                        If Undelivered Please Return To :
                                                                                    </strong>
                                                                                    <span
                                                                                        class="d-block fw-500 return-address">
                                                                                        <span
                                                                                            class="fw-400 hide-rto-contact-name d-block">
                                                                                            Return Warehouse Name :
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="d-block fw-400">
                                                                                        <label
                                                                                            class="hide-rto-pickup-address mb-0">
                                                                                            Address :
                                                                                        </label>
                                                                                    </span>
                                                                                    <span class="d-block fw-400">
                                                                                        <label
                                                                                            class="hide-rto-pickup-address mb-0">
                                                                                            Pincode:
                                                                                        </label>
                                                                                    </span>
                                                                                    <span
                                                                                        class="fw-400 hide-rto-pickup-mob">Mobile
                                                                                        No:</span>
                                                                                </p>
                                                                                <br>
                                                                                <p class="mb-0 show-support hidden">
                                                                                    <strong class="d-block">For
                                                                                        any query please
                                                                                        contact:</strong>
                                                                                    <span class="fw-400">Mobile:
                                                                                        999999999, </span>
                                                                                    <span class="fw-400">Email:
                                                                                        Hello@rappidx.com</span>
                                                                                </p>
                                                                                <p class="mb-0 dynamic-support hidden">
                                                                                    <strong class="d-block">For
                                                                                        any query please
                                                                                        contact:</strong>
                                                                                    <span
                                                                                        class="fw-400 d-none dynamic-mobile"></span>
                                                                                    <span
                                                                                        class="fw-400 d-none dynamic-email"></span>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2 px-3">
                                                                <table width="100%" class="border-top border-dark">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="text-right">
                                                                                <p class="my-2">
                                                                                    <strong>Powered By
                                                                                        Rappidx</strong>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="tab-content rounded-right rounded-bottom p-md-4 p-2" id="myTabContent1">
                                    <div class="tab-pane fade show active sms-notify sms-notify" id="Setting_Label">
                                        <div class="contain-fluid">
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12">
                                                    <div class="label-set">
                                                        <div class="card my-2" style="background: #f1f5f9;">
                                                            <div class="card-body">
                                                                <!-- <form method="post" action="https://ship.nimbuspost.com/setting/v/label_setting"> -->
                                                                <form action="" method="POST" id="pagecreateform">
                                                                    <input type="hidden" name="csrf_test_name"
                                                                        value="ead3f4ef5910a39cae08cb31dc6eb4ff">
                                                                    <div class="row">
                                                                        <div class="col-sm-3 border-right">
                                                                            <div class="card shadow-none"
                                                                                style="background: #f1f5f9;">
                                                                                <div class="card-header border-bottom">
                                                                                    <div
                                                                                        class="custom-control custom-radio">
                                                                                        <input type="radio"
                                                                                            id="customRadio1"
                                                                                            name="label_format"
                                                                                            class="custom-control-input"
                                                                                            value="1">
                                                                                        <label
                                                                                            class="custom-control-label fw-500"
                                                                                            for="customRadio1">Standard
                                                                                            Desktop Printers -
                                                                                            Size A4 (8"X11")
                                                                                            <small
                                                                                                class="d-block fw-500">(Four
                                                                                                Label Printed on
                                                                                                one
                                                                                                Sheet)</small></label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="a4-size d-flex justify-content-center mt-4">
                                                                                        <img src="{{ asset('assets/icon/size-a4.png') }}"
                                                                                            width="200">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3 border-right">
                                                                            <div class="card shadow-none"
                                                                                style="background: #f1f5f9;">
                                                                                <div class="card-header border-bottom">
                                                                                    <div
                                                                                        class="custom-control custom-radio">
                                                                                        <input type="radio" required=""
                                                                                            id="customRadio2"
                                                                                            name="label_format"
                                                                                            class="custom-control-input"
                                                                                            value="2">
                                                                                        <label
                                                                                            class="custom-control-label fw-500"
                                                                                            for="customRadio2">Thermal
                                                                                            Label Printers -
                                                                                            Size (4"X6") <small
                                                                                                class="d-block fw-500">(Single
                                                                                                Label on one
                                                                                                Sheet)</small></label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="a4-size d-flex justify-content-center mt-4">
                                                                                        <img src="{{ asset('assets/icon/lhermal-label.png') }}"
                                                                                            width="200">
                                                                                        {{-- lhermal-label --}}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3 border-right">
                                                                            <div class="card shadow-none"
                                                                                style="background: #f1f5f9;">
                                                                                <div class="card-header border-bottom">
                                                                                    <div
                                                                                        class="custom-control custom-radio">
                                                                                        <input type="radio" required=""
                                                                                            id="customRadio2"
                                                                                            name="label_format"
                                                                                            class="custom-control-input"
                                                                                            value="3">
                                                                                        <label
                                                                                            class="custom-control-label fw-500"
                                                                                            for="customRadio2">Thermal
                                                                                            Label Printers -
                                                                                            Size (4"X5") <small
                                                                                                class="d-block fw-500">(Single
                                                                                                Label on one
                                                                                                Sheet)</small></label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="a4-size d-flex justify-content-center mt-4">
                                                                                        <img src="{{ asset('assets/icon/lhermal-label.png') }}"
                                                                                            width="200">
                                                                                        {{-- lhermal-label --}}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3 border-right">
                                                                            <div class="card shadow-none"
                                                                                style="background: #f1f5f9;">
                                                                                <div class="card-header border-bottom">
                                                                                    <div
                                                                                        class="custom-control custom-radio">
                                                                                        <input type="radio" required=""
                                                                                            id="customRadio2"
                                                                                            name="label_format"
                                                                                            class="custom-control-input"
                                                                                            value="4">
                                                                                        <label
                                                                                            class="custom-control-label fw-500"
                                                                                            for="customRadio2">Thermal
                                                                                            Label Printers -
                                                                                            Size (3"X4") <small
                                                                                                class="d-block fw-500">(Single
                                                                                                Label on one
                                                                                                Sheet)</small></label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="a4-size d-flex justify-content-center mt-4">
                                                                                        <img src="{{ asset('assets/icon/lhermal-label.png') }}"
                                                                                            width="200">
                                                                                        {{-- lhermal-label --}}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-20">
                                                                        <div class="col-sm-12 text-center">
                                                                            <button type="submit"
                                                                                class="btn btn-dark btn-custom rounded-pill mt-2 px-4"
                                                                                fdprocessedid="3e2n6j"
                                                                                id="pagesave">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
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
                    </div>
                </div>
            </div>
        </section>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        iclsntegrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    <script>
        $(document).on('click', '#pagesave', function (e) {
            e.preventDefault();

            var formdata = $('#pagecreateform').serialize();
            console.log(formdata);

            $.ajax({
                type: "POST",
                url: "{{ route('user.label_filter') }}",
                data: formdata,
                success: function (response) {
                    //     console.log(response);

                    if (response.status == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Success',
                            timer: 3000,
                            showConfirmButton: false
                        }).then(function () {
                            window.location.href = " ";
                        });
                    } else {
                        //alert(response.data);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed!',
                        });
                    }

                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

        });

        $(document).on('click', '#addrecord', function (e) {
            e.preventDefault();

            var formdata = new FormData($('.createform')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('user.label_filter') }}",
                contentType: false,
                processData: false,
                data: formdata,
                success: function (response) {
                    //     console.log(response);

                    if (response.status == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Success',
                            timer: 3000,
                            showConfirmButton: false
                        }).then(function () {
                            window.location.href = " ";
                        });
                    } else {
                        //alert(response.data);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed!',
                        });
                    }

                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });


        defaultUrl = "{{ asset('assets/icon/logo.png') }}"
        $(document).ready(function () {
            $('#inputGroupFile02').change(function () {
                var url = window.URL.createObjectURL(this.files[0]);
                $('#blah').attr('src', url);
                defaultUrl = url;
                if (!$("input[name='show_channel_logo']").is(':checked')) {
                    $('.box-show img').attr('src', url);
                }
            });
        });

        $("input[type='file']").on("change", function () {
            if (this.files[0].size > 5000000) {
                alert("Please upload file less than 5MB. Thanks!!");
                $(this).val('');
            }
        });

        productsku = 0;
        $(document).ready(function () {

            if ($('input[name="show_logo"]').is(':checked')) {
                $('.box-show').removeClass('d-none');
                $('.channelimage').removeClass('d-none');
            } else {
                // $('.box-show').addClass('d-none');
                // $('.channelimage').addClass('d-none');
            }

            if ($('input[name="show_support_email"]').is(':checked')) {
                $('.dynamic-support').removeClass('d-none');
                $('.box-ShowSupport').removeClass('d-none');
            } else {
                $('.box-ShowSupport').addClass('d-none');
                $('.dynamic-support ,.show-support').addClass('d-none');
            }

            // if ($('input[name="hide_customer_mobile"]').is(':checked')) {
            //     $('.dynamic-support').removeClass('d-none');
            //     $('.box-ShowSupport').removeClass('d-none');
            // } else {
            //     $('.box-ShowSupport').addClass('d-none');
            //     $('.dynamic-support ,.show-support').addClass('d-none');
            // }


            if ($('input[name="hide_order_amount"]').is(':checked')) {
                $('.box-HideOrder').removeClass('d-none');
            } else {      
                $('.box-HideOrder').addClass('d-none');
                $('.hide-cod').removeClass('d-none');
            
            }

            if ($('input[name="hide_sku"]').is(':checked')) {
                productsku++;
                $('.sku-col-hide').addClass('d-none');
                if (productsku == 2) {
                    $('.product-sku-col-hide').addClass('d-none');
                }
            }

            if ($('input[name="hide_item_name"]').is(':checked')) {
                productsku++;
                $('.product-col-hide').addClass('d-none');
                if (productsku == 2) {
                    $('.product-sku-col-hide').addClass('d-none');
                }
            }
            if ($('input[name="warehouse_support_email_mobile"]').is(':checked')) {
                $('.show-support').removeClass('d-none');
                $('.dynamic-support').addClass('d-none');
            }
            if ($('#HideOrder').is(':checked')) {
                $('.box-HideOrder').removeClass('d-none');
            } else {
                $('#HideCod').prop("checked", false);
                $('#HidePrepaid').prop("checked", false);
                $('.box-HideOrder').addClass('d-none');
                $('.hide-cod').removeClass('d-none');
            }

            if ($('#HideQTY').is(":checked")) {
                $('.qty-col-hide').addClass('d-none');
            } else {
                $('.qty-col-hide').removeClass('d-none');
            }

            if ($('#HideAmount').is(":checked")) {
                $('.amount-col-hide').addClass('d-none');
                $('.subtotal').addClass('d-none');
            } else {
                $('.amount-col-hide').removeClass('d-none');
                $('.subtotal').removeClass('d-none');
            }

            if ($('#PickupAddress').is(":checked")) {
                $('.hide-pickup-address').addClass('d-none');
            } else {
                $('.hide-pickup-address').removeClass('d-none');
            }

            if ($('#RTOAddress').is(":checked")) {
                $('.hide-rto-pickup-address').addClass('d-none');
            } else {
                $('.hide-rto-pickup-address').removeClass('d-none');
            }
            if ($('#PickupMobile').is(":checked")) {
                $('.hide-pickup-mob').addClass('d-none');
            } else {
                $('.hide-pickup-mob').removeClass('d-none');
            }
            if ($('#RTOMobile').is(":checked")) {
                $('.hide-rto-pickup-mob').addClass('d-none');
            } else {
                $('.hide-rto-pickup-mob').removeClass('d-none');
            }
            if ($('#HideCod').is(":checked")) {
                $('.hide-cod').addClass('d-none');
            } else {
                $('.hide-cod').removeClass('d-none');
            }
            if ($('#CustomerMob').is(":checked")) {
                $('.customer-mob').addClass('d-none');
            } else {
                $('.customer-mob').removeClass('d-none');
            }
            // if()
            if ($('#GSTNumber').is(":checked")) {
                $('.hide-gst-number').addClass('d-none');
            } else {
                $('.hide-gst-number').removeClass('d-none');
            }
            if ($('#SelectLogo').is(":checked")) {
                $('.channelimage').attr('src', '{{ asset('assets/icon/logo.png') }}');
            } else {
                $('.channelimage').attr('src', defaultUrl);
            }
            if ($('#ContactName').is(":checked")) {
                $('.hide-contact-name').addClass('d-none');
            } else {
                $('.hide-contact-name').removeClass('d-none');
            }
            if ($('#RtoContactName').is(":checked")) {
                $('.hide-rto-contact-name').addClass('d-none');
            } else {
                $('.hide-rto-contact-name').removeClass('d-none');
            }

            if ($('#HideDiscount').is(":checked")) {
                $('.dimensionhide').addClass('d-none');
            } else {
                $('.dimensionhide').removeClass('d-none');
            }
            updatewarehousedetail();
            manageColumn();
            numberLine();
            skutrim();
            producttrim();
            warehousesetting();
        });
    </script>
    <script>
        $('#ShowLogo').change(function () {
            if ($(this).is(":checked")) {
                $('.box-show').removeClass('d-none');
                $('.channelimage').removeClass('d-none');
            } else {
                $('#SelectLogo').prop("checked", false);
                $('.channelimage').addClass('d-none');
            }
        });
        $('#ShowSupport').change(function () {
            if ($(this).is(":checked")) {
                $('.dynamic-support').removeClass('d-none');
                $('.box-ShowSupport').removeClass('d-none');
            } else {
                $('#WarehouseSupport').prop("checked", false);
                $('.box-ShowSupport').addClass('d-none');
                $('.dynamic-support ,.show-support').addClass('d-none');
            }
        });
        $('#WarehouseSupport').change(function () {
            if ($(this).is(":checked")) {
                $('.show-support').removeClass('d-none');
                $('.dynamic-support').addClass('d-none');
                updatewarehousedetail();
            } else {
                $('.show-support').addClass('d-none');
                $('.dynamic-support').removeClass('d-none');
            }
        });

        function updatewarehousedetail() {
            email = $('#support_email').val();
            mobile = $('#support_mobile').val();
            $('.dynamic-mobile').addClass('d-none');
            $('.dynamic-email').addClass('d-none');

            if (email.length > 0) {
                $('.dynamic-email').removeClass('d-none');
                $('.dynamic-email').text(`Email: ${email}`);

            }

            if (mobile.length > 0) {
                $('.dynamic-mobile').removeClass('d-none');
                $('.dynamic-mobile').text(`Mobile: ${mobile} ,`);
            }

        }

        $('#HideOrder').change(function () {
            if ($(this).is(":checked")) {
                $('.box-HideOrder').removeClass('d-none');
            } else {
                $('#HideCod').prop("checked", false);
                $('#HidePrepaid').prop("checked", false);
                $('.box-HideOrder').addClass('d-none');
                $('.hide-cod').removeClass('d-none');
            }
        });

        $('#HideSKU').change(function () {
            if ($(this).is(":checked")) {
                productsku++;
                $('.sku-col-hide').addClass('d-none');
                if (productsku == 2) {
                    $('.product-sku-col-hide').addClass('d-none');
                }
            } else {
                productsku--;
                $('.sku-col-hide').removeClass('d-none');
                if (productsku) {
                    $('.product-sku-col-hide').removeClass('d-none');
                }
            }
            manageColumn();
        });

        $('#HidePRO').change(function () {
            if ($(this).is(":checked")) {
                productsku++;
                $('.product-col-hide').addClass('d-none');
                if (productsku == 2) {
                    $('.product-sku-col-hide').addClass('d-none');
                }
            } else {
                productsku--;
                $('.product-col-hide').removeClass('d-none');
                if (productsku) {
                    $('.product-sku-col-hide').removeClass('d-none');
                }
            }
            manageColumn();
        });
        $('#HideQTY').change(function () {
            if ($(this).is(":checked")) {
                $('.qty-col-hide').addClass('d-none');
            } else {
                $('.qty-col-hide').removeClass('d-none');
            }
            manageColumn();
        });
        // akash
        $('#HideAmount').change(function () {
            if ($(this).is(":checked")) {
                $('.amount-col-hide').addClass('d-none');
                $('.subtotal').addClass('d-none');
            } else {
                $('.amount-col-hide').removeClass('d-none');
                $('.subtotal').removeClass('d-none');
            }
            manageColumn();
        });

        $('#PickupAddress').change(function () {
            if ($(this).is(":checked")) {
                $('.hide-pickup-address').addClass('d-none');
            } else {
                $('.hide-pickup-address').removeClass('d-none');
            }
            warehousesetting();
        });
        $('#RTOAddress').change(function () {
            if ($(this).is(":checked")) {
                $('.hide-rto-pickup-address').addClass('d-none');
            } else {
                $('.hide-rto-pickup-address').removeClass('d-none');
            }
            warehousesetting();
        });
        $('#PickupMobile').change(function () {
            if ($(this).is(":checked")) {
                $('.hide-pickup-mob').addClass('d-none');
            } else {
                $('.hide-pickup-mob').removeClass('d-none');
            }
            warehousesetting();
        });
        $('#RTOMobile').change(function () {
            if ($(this).is(":checked")) {
                $('.hide-rto-pickup-mob').addClass('d-none');
            } else {
                $('.hide-rto-pickup-mob').removeClass('d-none');
            }
            warehousesetting();
        });
        $('#HideCod').change(function () {
            if ($(this).is(":checked")) {
                $('.hide-cod').addClass('d-none');
            } else {
                $('.hide-cod').removeClass('d-none');
            }
        });
        $('#CustomerMob').change(function () {
            if ($(this).is(":checked")) {
                $('.customer-mob').addClass('d-none');
            } else {
                $('.customer-mob').removeClass('d-none');
            }
        });
        $('#GSTNumber').change(function () {
            if ($(this).is(":checked")) {
                $('.hide-gst-number').addClass('d-none');
            } else {
                $('.hide-gst-number').removeClass('d-none');
            }
            warehousesetting();
        });

        $('#ContactName').change(function () {
            if ($(this).is(":checked")) {
                $('.hide-contact-name').addClass('d-none');
            } else {
                $('.hide-contact-name').removeClass('d-none');
            }
            warehousesetting();
        });

        $('#RtoContactName').change(function () {
            if ($(this).is(":checked")) {
                $('.hide-rto-contact-name').addClass('d-none');
            } else {
                $('.hide-rto-contact-name').removeClass('d-none');
            }
            warehousesetting();
        });

        $('#SelectLogo').change(function () {
            if ($(this).is(":checked")) {
                $('.channelimage').attr('src', '{{ asset('assets/icon/logo.png') }}');
            } else {
                $('.channelimage').attr('src', defaultUrl);
            }
        });

        $('#HideDiscount').change(function () {
            if ($(this).is(":checked")) {
                $('.dimensionhide').addClass('d-none');
            } else {
                $('.dimensionhide').removeClass('d-none');
            }
            manageColumn();
        });

        function manageColumn() {
            col = $('#price-table').find('tr').children('th.d-none').length;
            value = parseInt($('input[name="no_of_line_items"]').val());
            if (value > 0)
                $('.show-line').removeClass('d-none');
            if (col > 2) {
                $('#price-table').find('tr').children('th').each(function (element, item) {
                    if (!$(item).hasClass('d-none')) {
                        id = $(item).attr('data-id');
                        $('.' + id).attr('colspan', '2');
                        if (productsku != 0) {
                            $('.product-sku-col-hide').attr('colspan', '2');
                        }
                    }
                });
            } else {
                $('.sku-col-hide').attr('colspan', '1');
                $('.product-col-hide').attr('colspan', '1');
                $('.qty-col-hide').attr('colspan', '1');
                $('.amount-col-hide').attr('colspan', '1');
                $('.subtotal').attr('colspan', (4 - col - 1));
                $('.product-sku-col-hide').attr('colspan', (2 - productsku));
            }
            if (col == 4 || value > 4) {
                $('.show-line').addClass('d-none');
            }

        }

        function skutrim() {
            value = $('input[name="sku_char_limit"]').val();
            $('#price-table').find('tr').each(function (element, item) {
                if (!($(item).hasClass('header-th') || $(item).hasClass('show-line'))) {
                    if (parseInt(value) > 0) {
                        str = $(item).find('.sku-col-hide').attr('data-text');
                        str = wordWrap(str, value);
                        $(item).find('.sku-col-hide').html(str);
                    } else {
                        str = $(item).find('.sku-col-hide').attr('data-text');
                        str = wordWrap(str, 500);
                        $(item).find('.sku-col-hide').html(str);
                    }
                }
            });
        }

        function producttrim() {
            value = $('input[name="item_name_char_limit"]').val();
            $('#price-table').find('tr').each(function (element, item) {
                if (!($(item).hasClass('header-th') || $(item).hasClass('show-line'))) {
                    if (parseInt(value) > 0) {
                        str = $(item).find('.product-col-hide').attr('data-text');
                        str = wordWrap(str, value);
                        $(item).find('.product-col-hide').html(str);
                    } else {
                        str = $(item).find('.product-col-hide').attr('data-text');
                        str = wordWrap(str, 500);
                        $(item).find('.product-col-hide').html(str);
                    }
                }
            });
        }

        function numberLine() {
            value = parseInt($('input[name="no_of_line_items"]').val());
            if (value < 1) {
                $('#price-table').find('tr').each(function (element, item) {
                    if (!($(item).hasClass('header-th') || $(item).hasClass('show-line') || $(item).hasClass(
                        'total-show-line'))) {
                        $(item).removeClass('d-none');
                    }
                });
                $('.show-line').addClass('d-none');
                $('.show-line').find('.qty-col-hide').text('0');
                $('.show-line').find('.amount-col-hide').text('{{currency_symbol()}}0');
                return 0;
            }
            tqty = 0;
            tamt = 0;
            totalit = 0;
            total = 0;
            $('#price-table').find('tr').each(function (element, item) {
                if (!($(item).hasClass('header-th') || $(item).hasClass('show-line') || $(item).hasClass(
                    'total-show-line'))) {
                    totalit++;
                    qty = parseInt($(item).find('.hide-qty').text());
                    amt = parseInt($(item).find('.hide-amount').text());
                    if (value > 0) {
                        $(item).removeClass('d-none');
                    }
                    if (totalit > value) {
                        total++;
                        $(item).addClass('d-none');
                        if (!Number.isNaN(qty))
                            tqty += qty;
                        if (!Number.isNaN(amt))
                            tamt += amt;
                    }
                }
            });
            if (tqty != 0) {
                $('.show-line').removeClass('d-none');
                $('.show-line').find('.qty-col-hide').text(tqty);
                $('.show-line').find('.total-hide-product').text(total);
                $('.show-line').find('.amount-col-hide').text('{{currency_symbol()}}' + tamt);
            } else {
                $('.show-line').addClass('d-none');
                $('.show-line').find('.qty-col-hide').text('0');
                $('.show-line').find('.amount-col-hide').text('{{currency_symbol()}}0');
            }

        }

        function wordWrap(str, maxWidth) {
            if (str == undefined || (str.length) == 0)
                return str;
            if ((str.length) > maxWidth) {
                return ((str.substr(0, maxWidth)) + '...');
            } else {
                return str;
            }
        }

        function warehousesetting() {

            if (($('#PickupAddress').is(":checked") == true) && ($('#PickupMobile').is(":checked") == true) && ($(
                '#GSTNumber').is(":checked") == true)) {
                $('.pickup-address').addClass('d-none');
                $('.pickup-address').removeClass('d-block');
            } else {
                $('.pickup-address').removeClass('d-none');
                $('.pickup-address').addClass('d-block');

            }
            if ($('#RTOAddress').is(":checked") && $('#RTOMobile').is(":checked")) {
                $('.return-address').addClass('d-none');
                $('.return-address').removeClass('d-block');
            } else {
                $('.return-address').removeClass('d-none');
                $('.return-address').addClass('d-block');
            }

            if ($('#ContactName').is(":checked")) {
                $('.hide-contact-name').addClass('d-none');
                $('.hide-contact-name').removeClass('d-block');
            } else {
                $('.hide-contact-name').removeClass('d-none');
                $('.hide-contact-name').addClass('d-block');
            }

            if ($('#RtoContactName').is(":checked")) {
                $('.hide-rto-contact-name').addClass('d-none');
                $('.hide-rto-contact-name').removeClass('d-block');
            } else {
                $('.hide-rto-contact-name').removeClass('d-none');
                $('.hide-rto-contact-name').addClass('d-block');
            }
        }
    </script>
@endsection