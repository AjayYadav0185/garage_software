@extends('layouts.app')

@section('content')

<form id="vehicleForm" method="POST" action="{{ route('jobcards.store') }}" enctype="multipart/form-data">
    @csrf

    <!-- ================= STEP 1 ================= -->
    <div id="step1" class="step-content active">
        <section class="sectionbox">

            <div class="heading-row">
                <h3><span class="material-icons">directions_car</span> Vehicle Information</h3>
                <input type="text" name="vehicle_name" class="form-control" id="vehicleSearch" placeholder="Search Vehicle..." autocomplete="off">
            </div>

            <div id="vehiclelist" class="list-group position-absolute w-100" style="z-index:999;display:none;"></div>

            <input type="hidden" name="g_id" value="{{ $g_id }}">
            <input type="hidden" name="c_id" value="{{ $new_cid }}">
            <input type="hidden" name="v_id" value="{{ $new_vid }}">
            <input type="hidden" name="uid" value="{{ $new_uid }}">
            <input type="hidden" name="messageid" value="0">
            <input type="hidden" name="invoice_no" value="{{ $invoice_no }}">

            <div class="row">

                <div class="col-md-3">
                    <label>Emirate</label>
                    <select name="vehicle_emirate" class="form-control" required>
                        <option value="">Select Emirate</option>
                        @foreach(['Abu Dhabi','Dubai','Sharjah','Ajman','Umm Al Quwain','Ras Al Khaimah','Fujairah'] as $em)
                        <option value="{{ $em }}">{{ $em }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Registration No</label>
                    <input type="text" name="vehicle_registration" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Number Plate Code</label>
                    <input type="text" name="vehicle_number_plate_code" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Number Plate Color</label>
                    <select name="vehicle_number_plate_color" class="form-control" required>
                        <option value="">Select Color</option>
                        @foreach(App\Enums\NumberPlateColor::cases() as $color)
                        <option value="{{ $color->value }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Car Body Color</label>
                    <input type="text" name="vehicle_car_body_color" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Manufacturing Year</label>
                    <select name="vehicle_manfacturing_year" class="form-control" required>
                        <option value="">Select Year</option>
                        @for($y = date('Y'); $y >= 1990; $y--)
                        <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Car Brand</label>
                    <input type="text" name="vehicle_carbrand" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Car Model</label>
                    <input type="text" name="vehicle_carmodel" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Fuel Type</label>
                    <select name="vehicle_fueltype" class="form-control" required>
                        <option value="">Select</option>
                        <option>petrol</option>
                        <option>diesel</option>
                        <option>electric</option>
                        <option>hybrid</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Chassis No</label>
                    <input type="text" name="vehicle_chassis_no" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Engine No</label>
                    <input type="text" name="vehicle_engine_no" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Brake System</label>
                    <select name="vehicle_braking" class="form-control" required>
                        <option value="">Select</option>
                        <option>ABS</option>
                        <option>Non-ABS</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Transmission</label>
                    <select name="vehicle_transmission" class="form-control" required>
                        <option value="">Select</option>
                        <option>Automatic</option>
                        <option>Manual</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Odometer</label>
                    <input type="number" name="vehicle_odometer" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Fuel Meter</label>
                    <select name="vehicle_fuelmeter" class="form-control" required>
                        <option value="">Select</option>
                        <option>0-10</option>
                        <option>10-30</option>
                        <option>30-60</option>
                        <option>60-80</option>
                        <option>80-100</option>
                    </select>
                </div>

            </div>
        </section>

        <div class="form-actions">
            <button type="button" class="btn-next" onclick="nextStep(2)">Next</button>
        </div>
    </div>

    <!-- ================= STEP 2 ================= -->
    <div id="step2" class="step-content">

        <section class="sectionbox">
            <h3>Policy Details</h3>
            <div class="row">
                <div class="col-md-4"><input name="jobcard_policy_no" class="form-control" placeholder="Policy No"></div>
                <div class="col-md-4"><input name="jobcard_claim_no" class="form-control" placeholder="Claim No"></div>
                <div class="col-md-4"><input name="jobcard_lpo_no" class="form-control" placeholder="LPO No"></div>
            </div>
        </section>

        <section class="sectionbox">
            <h3>Job Card Details</h3>
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control" value="{{ $jobcard_increment_no }}" readonly>
                </div>
                <div class="col-md-6">
                    <input class="form-control" value="Accident" readonly>
                </div>
            </div>
        </section>

        <section class="sectionbox">
            <h3>Insurance Information</h3>

            <input type="hidden" name="insurance_company_id" id="insuranceCompanyID">

            <input type="text" name="insurance_company_name" id="insuranceSearch" class="form-control" placeholder="Search Insurance" required>

            <input type="text" name="insurance_tax_number" id="insurance_tax_number" class="form-control" readonly>
            <input type="text" name="insurance_company_contact" id="insurance_company_contact" class="form-control" readonly>
            <input type="text" name="insurance_whatsapp" id="insurance_whatsapp" class="form-control" readonly>
            <input type="email" name="insurance_email_address" id="insurance_email_address" class="form-control" readonly>
            <input type="text" name="insurance_company_emirate" id="insurance_company_emirate" class="form-control" readonly>
            <input type="text" name="insurance_company_address" id="insurance_company_address" class="form-control" readonly>

            <div class="row">
                <div class="col-md-6">
                    <input name="driver_name" class="form-control" placeholder="Driver Name">
                </div>
                <div class="col-md-6">
                    <input name="driver_mobile_number" class="form-control" placeholder="Driver Mobile">
                </div>
            </div>

            <textarea name="voice_of_customer" class="form-control mt-2"></textarea>

        </section>

        <div class="form-actions">
            <button type="button" onclick="prevStep(1)">Previous</button>
            <button type="button" onclick="nextStep(3)">Next</button>
        </div>

    </div>

    <!-- STEP 3 & 4 stay SAME HTML + JS (only remove PHP) -->

    <button type="submit" class="btn-submit">Submit Job Card</button>

</form>

@endsection