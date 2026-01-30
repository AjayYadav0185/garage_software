@extends('user.dashboard.layout.master')
@section('user-contant')


<style>
    /* Style the status dropdown inside the DataTable */
    table#rosTable .status-dropdown {
        width: 120px;
        /* Set a fixed width for consistency */
        padding: 5px 10px;
        /* Add some padding */
        font-size: 14px;
        /* Adjust font size */
        border-radius: 4px;
        /* Rounded corners */
        border: 1px solid #ddd;
        /* Light gray border */
        background-color: #fff;
        /* White background */
        cursor: pointer;
        appearance: none;
        /* Remove default styling on some browsers (like Safari) */
        text-align: center;
        /* Center the text inside the dropdown */
    }

    /* Add hover and focus effects */
    table#rosTable .status-dropdown:hover,
    table#rosTable .status-dropdown:focus {
        border-color: #007bff;
        /* Blue border on hover/focus */
        outline: none;
        /* Remove default focus outline */
    }

    /* Color the options based on the status */
    table#rosTable .status-dropdown option {
        color: #333;
        /* Default text color */
    }

    table#rosTable .status-dropdown option[value="Pending"] {
        color: #e74c3c;
        /* Red for Pending */
    }

    table#rosTable .status-dropdown option[value="Completed"] {
        color: #2ecc71;
        /* Green for Completed */
    }

    table#rosTable .status-dropdown option[value="In Progress"] {
        color: #f39c12;
        /* Yellow for In Progress */
    }

    /* Styling for the table cells to make the dropdowns align well */
    table#rosTable td {
        text-align: center;
        /* Center align table cells */
    }

    /* Optional: Style the select box when it's in focus */
    table#rosTable .status-dropdown:focus {
        border-color: #3498db;
        /* Blue color when focused */
    }

    /* Add a border and background color to make the selected status stand out */
    table#rosTable .status-dropdown option:checked {
        background-color: #3498db;
        /* Blue background for selected option */
        color: white;
        /* White text color for selected option */
    }

    #statusFilter {
        border-radius: 5px;
        padding: 4px 8px;
        border: 1px solid #ced4da;
        background-color: #f8f9fa;
        font-size: 0.875rem;
    }

    #statusFilter:focus {
        outline: none;
        border-color: #495057;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }
</style>
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>All Insurance ROs</h4>
                <button class="btn btn-primary" id="addRoBtn">Add Insurance RO</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="rosTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>JobCard Type</th> -->
                                <th>Insurance Co</th>
                                <th>Vehicle</th>
                                <!-- <th>Reg. No.</th> -->
                                <!-- <th>Chassis No</th> -->
                                <th>Total Amount</th>
                                <th>Bill Split</th>
                                <th>Payment Status</th>
                                <th>Payment Mark</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Split Billing Modal -->
<div id="splitBillingModal" class="sb-modal">
    <div class="sb-modal-content">

        <div class="sb-modal-header">
            <h4>Split Billing Details</h4>
            <span class="sb-close" id="closeModal">&times;</span>
        </div>

        <div class="sb-modal-body">

            <!-- Hidden Fields -->
            <input type="hidden" id="sb_uid">
            <input type="hidden" id="inc_id">
            <input type="hidden" id="cust_id">

            <!-- Liability Section -->
            <div class="sb-row">
                <div class="sb-col">
                    <label>Approved Percentage (%)</label>
                    <input type="number" id="liability_percentage" class="sb-input" value="0" min="0" max="100">
                    <small id="liabilitypercentageerror" class="sb-error">
                        Please enter valid percentage
                    </small>
                </div>

                <div class="sb-col">
                    <label>Approved Amount (AED)</label>
                    <input type="number" id="liability_amount" class="sb-input" value="0" min="0">
                    <small id="liabilityamounterror" class="sb-error">
                        Please enter valid amount
                    </small>
                </div>
            </div>

            <!-- Customer Section -->
            <h5 class="sb-section-title">Customer Details</h5>

            <div class="sb-row">
                <div class="sb-col">
                    <label>Name</label>
                    <input type="text" id="cust_name" class="sb-input">
                </div>

                <div class="sb-col">
                    <label>Contact</label>
                    <input type="text" id="cust_contact" class="sb-input">
                </div>
            </div>

            <div class="sb-row">
                <div class="sb-col">
                    <label>WhatsApp</label>
                    <input type="text" id="cust_whatsapp" class="sb-input">
                </div>

                <div class="sb-col">
                    <label>Email</label>
                    <input type="email" id="cust_email" class="sb-input">
                </div>
            </div>

            <div class="sb-row">
                <div class="sb-col">
                    <label>Address</label>
                    <input type="text" id="cust_address" class="sb-input">
                </div>

                <div class="sb-col">
                    <label>Tax No</label>
                    <input type="text" id="cust_tax" class="sb-input">
                </div>
            </div>

        </div>

        <div class="sb-modal-footer">
            <button id="saveSplitBilling" class="sb-btn sb-btn-success">Save</button>
            <button id="closeModalBtn" class="sb-btn sb-btn-danger">Cancel</button>
        </div>

    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="roModal" tabindex="-1" aria-labelledby="roModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-sm">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Insurance RO</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">

                <!-- Progress Steps (Sticky) -->
                <div class="progress-steps-wrapper sticky-top bg-white py-3" style="z-index:1050;">
                    <div class="progress-steps mb-4 d-flex justify-content-between align-items-center position-relative">
                        <div class="progress-line position-absolute top-50 start-0 end-0" style="height: 4px; background:#dee2e6; transform: translateY(-50%); z-index:0;"></div>
                        @php
                        $steps = [
                        1 => 'Vehicle Details',
                        2 => 'Customer & Job',
                        3 => 'Parts & Services',
                        4 => 'Review & Submit'
                        ];
                        @endphp
                        @foreach($steps as $stepNum => $stepName)
                        <div class="step" data-step="{{ $stepNum }}">
                            <div class="step-circle @if($stepNum==1) active @endif">{{ $stepNum }}</div>
                            <div class="step-label">{{ $stepName }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Multi-Step Form -->
                <form id="insuranceRoForm" method="POST" action="{{ route('insurance-ro.store') }}">
                    @csrf


                    <input type="hidden" name="ro_id" id="ro_id">
                    <input type="hidden" name="inventory" id="inventoryJson">
                    <input type="hidden" name="services" id="servicesJson">
                    <!-- Step 1: Vehicle Information -->
                    <div class="step-content active card p-3 mb-3" id="step1">
                        <h5 class="card-title mb-3"><i class="bi bi-car-front"></i> Vehicle Information</h5>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Search Vehicle (Plate / Chassis)</label>
                            <input type="text" id="vehicleSearch" name="vehicleSearch" class="form-control" placeholder="Type plate number or chassis...">
                            <div id="vehicleSearchResult" class="list-group position-absolute w-50"></div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label>Emirate</label>
                                <select class="form-control" name="vehicle_emirate" required>
                                    <option value="">Select Emirate</option>
                                    @foreach(['Abu Dhabi','Dubai','Sharjah','Ajman','Umm Al Quwain','Ras Al Khaimah','Fujairah'] as $emirate)
                                    <option value="{{ $emirate }}">{{ $emirate }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Registration No</label>
                                <input type="hidden" name="vehicleId">
                                <input type="text" class="form-control" name="vehicle_registration" placeholder="Enter registration number" required>
                            </div>
                            <div class="col-md-4">
                                <label>Number Plate Code</label>
                                <input type="text" class="form-control" name="vehicle_number_plate_code" placeholder="Full Number Plate Code" required>
                            </div>
                            <div class="col-md-4">
                                <label>Number Plate Color</label>
                                <select class="form-control" name="vehicle_number_plate_color" required>
                                    <option value="">Select Color</option>
                                    @foreach(App\Enums\NumberPlateColor::cases() as $color)
                                    <option value="{{ $color->value }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Car Body Color</label>
                                <input type="text" class="form-control" name="vehicle_car_body_color" placeholder="Car Body Color" required>
                            </div>
                            <div class="col-md-4">
                                <label>Manufacturing Year</label>
                                <select class="form-control" name="vehicle_manfacturing_year" id="vehicle_manfacturing_year" required>
                                    <option value="">Select Year</option>
                                    @for($year = date('Y'); $year >= 1995; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Car Brand</label>
                                <select name="vehicle_carbrand" id="brand" class="form-control" required>
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Car Model</label>
                                <select name="vehicle_carmodel" id="model" class="form-control" required>
                                    <option value="">Select Model</option>
                                    @foreach($models as $model)
                                    <option value="{{ $model->name }}">{{ $model->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Fuel Type</label>
                                <select name="vehicle_fueltype" class="form-control" required>
                                    <option value="">Select Fuel</option>
                                    @foreach(App\Enums\FuelType::cases() as $fuel)
                                    <option value="{{ $fuel->value }}">{{ $fuel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Chassis Number</label>
                                <input type="text" class="form-control" name="vehicle_chassis_no" placeholder="Enter chassis number" required>
                            </div>
                            <div class="col-md-4">
                                <label>Engine Number</label>
                                <input type="text" class="form-control" name="vehicle_engine_no" placeholder="Enter engine number" required>
                            </div>
                            <div class="col-md-4">
                                <label>Brake System</label>
                                <select name="vehicle_braking" class="form-control" required>
                                    <option value="">Select Braking</option>
                                    @foreach(App\Enums\BrakeSystem::cases() as $brake)
                                    <option value="{{ $brake->value }}">{{ $brake->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Transmission</label>
                                <select name="vehicle_transmission" class="form-control" required>
                                    <option value="">Select Transmission</option>
                                    @foreach(App\Enums\Transmission::cases() as $trans)
                                    <option value="{{ $trans->value }}">{{ $trans->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Odometer Reading</label>
                                <input type="number" class="form-control" name="vehicle_odometer" placeholder="Current reading" required>
                            </div>
                            <div class="col-md-4">
                                <label>Fuel Meter</label>
                                <select name="vehicle_fuelmeter" class="form-control" required>
                                    <option value="">Select one</option>
                                    @foreach(['0-10','10-30','30-60','60-80','80-100'] as $range)
                                    <option value="{{ $range }}">{{ $range }}%</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Policy & Insurance -->
                    <div class="step-content card p-3 mb-3" id="step2">
                        <h5 class="card-title mb-3">Step 2: Insurance Information</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Policy No</label>
                                <input type="text" name="policy_no" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Claim No</label>
                                <input type="text" name="claim_no" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">LPO No</label>
                                <input type="text" name="lpo_no" class="form-control">
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Insurance Company Name</label>

                                <input type="hidden" name="insuranceId">
                                <input type="text" id="insuranceSearch" name="insurance_company_name" class="form-control"
                                    placeholder="Search Insurance Company..." autocomplete="off">

                                <div id="insuranceResult" class="list-group position-absolute w-50"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tax Number</label>
                                <input type="text" name="insurance_tax_number" class="form-control">
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="insurance_company_contact" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="insurance_email_address" class="form-control">
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Driver Name</label>
                                <input type="text" name="insurence_driver_name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Driver Mobile Number</label>
                                <input type="text" name="insurence_driver_mobile_number" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="form-label">Voice of Customer</label>
                                <textarea name="voice_of_customer_insurencen" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="prevStep(1)"><i class="bi bi-arrow-left"></i> Previous</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 3: Inventory & Services -->
                    <div class="step-content card p-4 mb-3" id="step3">
                        <h5 class="card-title mb-3">Step 3: Inventory & Service Packages</h5>

                        <!-- Inventory -->
                        <div class="mb-4">
                            <h6>Inventory Parts</h6>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label>Select Inventory</label>
                                    <select id="inventorySelect" class="form-control select2">
                                        <option value="">-- Select Inventory Part --</option>
                                        @foreach($inventory as $item)
                                        <option value="{{ $item['id'] }}"
                                            data-name="{{ $item['Product'] }}"
                                            data-partno="{{ $item['PartNumber'] }}"
                                            data-hsn="{{ $item['HsnCode'] }}"
                                            data-mrp="{{ $item['SalePrice'] }}"
                                            data-cost="{{ $item['CostPrice'] }}"
                                            data-stock="{{ $item['Stock'] }}"
                                            data-unit="{{ $item['UnitType'] }}"
                                            data-cgst="{{ $item['cgst_percentage'] }}"
                                            data-sgst="{{ $item['sgst_percentage'] }}"
                                            data-igst="{{ $item['igst_percentage'] }}">
                                            {{ $item['Product'] }} (Stock: {{ $item['Stock'] }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" id="addInventoryBtn" class="btn btn-success btn-block">
                                        <i class="fas fa-plus"></i> Add Part
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" id="dynamicInventoryTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Part Name</th>
                                            <th>MRP</th>
                                            <th>Part Number</th>
                                            <th>HSN Code</th>
                                            <th>Quantity</th>
                                            <th>TAX(%)</th>
                                            <th>Discount & Type</th>
                                            <th>Total Cost</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <button type="button" id="addInventoryRow" class="btn btn-dark btn-sm mt-1">
                                <i class="fas fa-plus"></i> Add Row
                            </button>
                        </div>

                        <!-- Services -->
                        <div class="mb-4">
                            <h6>Service Packages</h6>
                            <div class="row mb-2">

                                <div class="col-md-4">
                                    <label>Select Package</label>
                                    <select id="packageSelect" class="form-control select2">
                                        <option value="">-- Select Service Package --</option>
                                        @foreach($packages as $item)
                                        <option value="{{ $item->id }}"
                                            data-package="{{ $item->package }}"
                                            data-packageprice="{{ $item->packageprice }}"
                                            data-discount="{{ $item->discountprice ?? 0 }}"
                                            data-hsn="{{ $item->hsncode ?? '' }}"
                                            data-cgst="{{ $item->cgst_percentage }}"
                                            data-sgst="{{ $item->sgst_percentage }}"
                                            data-igst="{{ $item->igst_percentage }}"
                                            data-items='@json($item->items)'>
                                            {{ $item->package }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" id="addPackageBtn" class="btn btn-info btn-block">
                                        <i class="fas fa-plus"></i> Add Service
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" id="dynamicServiceTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Service Name</th>
                                            <th>Price</th>
                                            <th>TAX(%)</th>
                                            <th>Discount & Type</th>
                                            <th>Total Cost</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <button type="button" id="addServiceRow" class="btn btn-dark btn-sm mt-1">
                                <i class="fas fa-plus"></i> Add Row
                            </button>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="prevStep(2)"><i class="bi bi-arrow-left"></i> Previous</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(4)">Next <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 4: Review & Submit -->
                    <div class="step-content card p-4 mb-3" id="step4">
                        <h5 class="card-title mb-3">Step 4: Review & Submit</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Service Due Date</label>
                                <input type="date" class="form-control" name="service_due_date">
                            </div>

                            <!-- Delivery Due Date -->
                            <div class="col-md-4">
                                <label class="form-label">Delivery Due Date</label>
                                <input type="date" class="form-control" name="delivery_due_date">
                            </div>

                            <!-- Assigned Mechanic -->
                            <div class="col-md-4">
                                <label class="form-label">Assigned Mechanic</label>
                                <select class="form-control" name="assigned_mechanic">
                                    <option value="">Select mechanic</option>
                                    <option value="1">Suresh</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Customer Feedback</label>
                                <textarea name="voice_of_customer" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label>Instructions for Mechanic</label>
                                <textarea name="instruction_for_mechanic" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label>Remarks (optional)</label>
                                <textarea name="remark" class="form-control" rows="2"></textarea>
                            </div>
                        </div>

                        <p class="text-muted mt-3">Please review all information carefully before submission.</p>


                        <div class="mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="prevStep(3)"><i class="bi bi-arrow-left"></i> Previous</button>
                            <button type="submit" class="btn btn-success">Submit RO <i class="bi bi-check2-circle"></i></button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    /* Modal Overlay */
    .sb-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
    }

    /* Modal Box */
    .sb-modal-content {
        background: #fff;
        width: 700px;
        max-width: 95%;
        margin: 50px auto;
        border-radius: 8px;
        overflow: hidden;
        animation: sbFadeIn 0.3s ease;
    }

    /* Header */
    .sb-modal-header {
        padding: 15px 20px;
        background: #2c3e50;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sb-close {
        font-size: 22px;
        cursor: pointer;
    }

    /* Body */
    .sb-modal-body {
        padding: 20px;
    }

    .sb-section-title {
        margin: 20px 0 10px;
        font-weight: 600;
        color: #333;
    }

    /* Rows & Columns */
    .sb-row {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
    }

    .sb-col {
        flex: 1;
    }

    /* Inputs */
    .sb-input {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    /* Errors */
    .sb-error {
        color: red;
        font-size: 12px;
        display: none;
    }

    /* Footer */
    .sb-modal-footer {
        padding: 15px 20px;
        background: #f4f4f4;
        text-align: right;
    }

    /* Buttons */
    .sb-btn {
        padding: 8px 18px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .sb-btn-success {
        background: #28a745;
        color: #fff;
    }

    .sb-btn-danger {
        background: #dc3545;
        color: #fff;
    }

    /* Animation */
    @keyframes sbFadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 600px) {
        .sb-row {
            flex-direction: column;
        }
    }

    .step-content {
        display: none;
        transition: all 0.3s;
    }

    .step-content.active {
        display: block;
    }

    .card {
        border-radius: 10px;
        border: 1px solid #e3e3e3;
    }

    .progress-steps .step {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .progress-steps .step-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #dee2e6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #495057;
        margin: 0 auto;
        z-index: 2;
        position: relative;
    }

    .progress-steps .step-circle.active {
        background: #0d6efd;
        color: #fff;
    }

    .progress-steps .step-circle.completed {
        /* background: #28a745; */
        /* color: #fff; */
    }

    .progress-steps .step-label {
        margin-top: 5px;
        font-size: 0.85rem;
        color: #495057;
    }

    .progress-steps .step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 4px;
        background: #dee2e6;
        z-index: 1;
        transform: translateY(-50%);
    }

    .progress-steps .step.completed:not(:last-child)::after {
        /* background: #28a745; */
    }
</style>

<script>
    $(document).ready(function() {

        /* -------------------------------
           1️⃣ VEHICLE SEARCH
        ------------------------------- */
        $('#vehicleSearch').on('keyup', function() {
            let query = $(this).val();
            if (query.length < 2) {
                $('#vehicleSearchResult').hide();
                return;
            }

            $.ajax({
                url: "{{ route('vehicle.search') }}",
                type: "GET",
                data: {
                    q: query
                },
                success: function(data) {
                    let html = '';
                    data.forEach(vehicle => {
                        html += `
                    <a href="#" class="list-group-item list-group-item-action vehicle-item"
                        data-vehicle='${JSON.stringify(vehicle)}'>
                        ${vehicle.registration} ( ${vehicle.chassis_no} )
                    </a>`;
                    });
                    $('#vehicleSearchResult').html(html).show();
                }
            });
        });

        $(document).on('click', '.vehicle-item', function(e) {
            e.preventDefault();
            let v = $(this).data('vehicle');

            // Fill Vehicle Info
            $('input[name="vehicleId"]').val(v.v_id);
            $('select[name="vehicle_emirate"]').val(v.vehicle_emirate);
            $('input[name="vehicle_registration"]').val(v.registration);
            $('input[name="vehicle_number_plate_code"]').val(v.number_plate_code);
            $('select[name="vehicle_number_plate_color"]').val(v.number_plate_color);
            $('input[name="vehicle_car_body_color"]').val(v.car_body_color);
            $('select[name="vehicle_manfacturing_year"]').val(v.manufacturing_year);
            $('select[name="vehicle_carbrand"]').val(v.carbrand).trigger('change');

            setTimeout(() => {
                $('select[name="vehicle_carmodel"]').val(v.carmodel).trigger('change');
            }, 500);

            $('select[name="vehicle_fueltype"]').val(v.fueltype);
            $('input[name="vehicle_chassis_no"]').val(v.chassis_no);
            $('input[name="vehicle_engine_no"]').val(v.engine_no);
            $('select[name="vehicle_braking"]').val(v.braking);
            $('select[name="vehicle_transmission"]').val(v.transmission);
            $('input[name="vehicle_odometer"]').val(v.odo_meter_reading);
            $('select[name="vehicle_fuelmeter"]').val(v.fuel_meter);

            $('#vehicleSearchResult').hide();
        });

    });
</script>

<script>
    $(document).ready(function() {

        /* -------------------------------
           2️⃣ INSURANCE SEARCH
        ------------------------------- */
        $('#insuranceSearch').on('keyup', function() {
            let query = $(this).val();
            if (query.length < 2) {
                $('#insuranceResult').hide();
                return;
            }

            $.ajax({
                url: "{{ route('insurance.search') }}",
                type: "GET",
                data: {
                    q: query
                },
                success: function(data) {
                    let html = '';
                    data.forEach(ins => {
                        html += `
                    <a href="#" class="list-group-item list-group-item-action insurance-item"
                        data-insurance='${JSON.stringify(ins)}'>
                        ${ins.insurence_company_name} (Tax: ${ins.insurence_tax_number})
                    </a>`;
                    });
                    $('#insuranceResult').html(html).show();
                }
            });
        });

        $(document).on('click', '.insurance-item', function(e) {
            e.preventDefault();
            let ins = $(this).data('insurance');

            // Fill Insurance Info & Disable fields
            $('input[name="insuranceId"]').val(ins.id);
            $('input[name="insurance_company_name"]').val(ins.insurence_company_name);
            $('input[name="insurance_tax_number"]').val(ins.insurence_tax_number);
            $('input[name="insurance_company_contact"]').val(ins.insurence_company_number || ins.whatsapp_number);
            $('input[name="insurance_email_address"]').val(ins.insurence_email_address);
            $('input[name="insurence_driver_name"]').val(ins.insurence_driver_name);
            $('input[name="insurence_driver_mobile_number"]').val(ins.insurence_driver_mobile_number);
            $('textarea[name="voice_of_customer_insurencen"]').val(ins.voice_of_customer_insurencen);

            $('#insuranceResult').hide();
        });

        // Hide dropdown when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest('#insuranceSearch, #insuranceResult').length) {
                $('#insuranceResult').hide();
            }
            if (!$(e.target).closest('#vehicleSearch, #vehicleSearchResult').length) {
                $('#vehicleSearchResult').hide();
            }
        });

    });
</script>

<script>
    $('#insuranceRoForm').on('submit', function(e) {
        e.preventDefault();

        /* ===============================
           COLLECT SERVICES
        =============================== */
        let services = [];
        $('#dynamicServiceTable tbody tr').each(function() {
            let name = $(this).find('input[name="service_name[]"]').val();
            let price = parseFloat($(this).find('input[name="service_mrp[]"]').val()) || 0;
            let cgst = parseFloat($(this).find('input[name="service_cgst[]"]').val()) || 0;
            let sgst = parseFloat($(this).find('input[name="service_sgst[]"]').val()) || 0;
            let igst = parseFloat($(this).find('input[name="service_igst[]"]').val()) || 0;
            let discount = parseFloat($(this).find('input[name="service_discount[]"]').val()) || 0;
            let finalDiscount = parseFloat($(this).find('input[name="service_final_discount[]"]').val()) || 0;
            let total = parseFloat($(this).find('input[name="service_total[]"]').val()) || 0;

            if (name) {
                services.push({
                    name,
                    price,
                    cgst,
                    sgst,
                    igst,
                    discount,
                    finalDiscount,
                    total
                });
            }
        });

        /* ===============================
           COLLECT INVENTORY
        =============================== */
        let inventory = [];
        $('#dynamicInventoryTable tbody tr').each(function() {
            let name = $(this).find('input[name="inventory_name[]"]').val();
            let mrp = parseFloat($(this).find('input[name="inventory_mrp[]"]').val()) || 0;
            let partNo = $(this).find('input[name="inventory_part_no[]"]').val();
            let hsn = $(this).find('input[name="inventory_hsn_code[]"]').val();
            let qty = parseFloat($(this).find('input[name="inventory_quantity[]"]').val()) || 1;
            let cgst = parseFloat($(this).find('input[name="inventory_cgst[]"]').val()) || 0;
            let sgst = parseFloat($(this).find('input[name="inventory_sgst[]"]').val()) || 0;
            let igst = parseFloat($(this).find('input[name="inventory_igst[]"]').val()) || 0;
            let discount = parseFloat($(this).find('input[name="inventory_discount[]"]').val()) || 0;
            let finalDiscount = parseFloat($(this).find('input[name="inventory_final_discount[]"]').val()) || 0;
            let total = parseFloat($(this).find('input[name="inventory_total[]"]').val()) || 0;

            if (name) {
                inventory.push({
                    name,
                    mrp,
                    partNo,
                    hsn,
                    qty,
                    cgst,
                    sgst,
                    igst,
                    discount,
                    finalDiscount,
                    total
                });
            }
        });

        /* ===============================
           PREPARE FORM DATA
        =============================== */
        let formData = new FormData(this);
        formData.set('services', JSON.stringify(services));
        formData.set('inventory', JSON.stringify(inventory));

        /* ===============================
           AJAX SUBMIT
        =============================== */
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            // beforeSend() {
            //     Swal.fire({
            //         title: 'Saving...',
            //         allowOutsideClick: false,
            //         didOpen: () => Swal.showLoading()
            //     });
            // },
            success(res) {
                $('#roModal').modal('hide');

                location.reload();

                $('#insuranceRoForm')[0].reset();
                $('#dynamicInventoryTable tbody').empty();
                $('#dynamicServiceTable tbody').empty();

                if (response.success) {
                    Swal.fire('Payment Recorded', '', 'success');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }

                // Optional: reload datatable
                if (window.rosTable) {
                    table.ajax.reload();
                }

                // Optional: close modal

            },
            error(xhr) {
                let msg = 'Something went wrong';
                if (xhr.responseJSON?.errors) {
                    msg = Object.values(xhr.responseJSON.errors).map(e => e[0]).join('\n');
                }
                Swal.fire('Error', msg, 'error');
            }
        });
    });
</script>



<!-- Scripts -->
<script>
    function nextStep(step) {
        document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
        document.getElementById('step' + step).classList.add('active');
        updateStepProgress(step);
    }

    function prevStep(step) {
        nextStep(step);
    }

    function updateStepProgress(currentStep) {
        document.querySelectorAll('.progress-steps .step-circle').forEach((circle, i) => {
            if (i + 1 < currentStep) {
                circle.classList.add('completed');
                circle.classList.remove('active');
            } else if (i + 1 === currentStep) {
                circle.classList.add('active');
                circle.classList.remove('completed');
            } else {
                circle.classList.remove('active', 'completed');
            }
        });
    }
</script>


<script>
    function collectInventory() {
        let inventory = [];

        document.querySelectorAll('#dynamicInventoryTable tbody tr').forEach((row) => {
            inventory.push({
                name: row.querySelector('[name*="[name]"]')?.value || '',
                mrp: row.querySelector('[name*="[mrp]"]')?.value || 0,
                part_no: row.querySelector('[name*="[part_no]"]')?.value || '',
                hsn: row.querySelector('[name*="[hsn]"]')?.value || '',
                qty: row.querySelector('[name*="[qty]"]')?.value || 0,
                cgst: row.querySelector('[name*="[cgst]"]')?.value || 0,
                sgst: row.querySelector('[name*="[sgst]"]')?.value || 0,
                igst: row.querySelector('[name*="[igst]"]')?.value || 0,
                discount: row.querySelector('[name*="[discount]"]')?.value || 0,
                total: row.querySelector('[name*="[total]"]')?.value || 0,
            });
        });

        document.getElementById('inventoryJson').value = JSON.stringify(inventory);
    }
</script>

<script>
    function collectServices() {
        let services = [];

        document.querySelectorAll('#dynamicServiceTable tbody tr').forEach((row) => {
            services.push({
                name: row.querySelector('[name*="[name]"]')?.value || '',
                price: row.querySelector('[name*="[price]"]')?.value || 0,
                cgst: row.querySelector('[name*="[cgst]"]')?.value || 0,
                sgst: row.querySelector('[name*="[sgst]"]')?.value || 0,
                igst: row.querySelector('[name*="[igst]"]')?.value || 0,
                discount: row.querySelector('[name*="[discount]"]')?.value || 0,
                total: row.querySelector('[name*="[total]"]')?.value || 0,
            });
        });

        document.getElementById('servicesJson').value = JSON.stringify(services);
    }
</script>

<script>
    document.getElementById('insuranceRoForm').addEventListener('submit', function() {
        collectInventory();
        collectServices();
    });
</script>


<x-inventory-modal title="Add Inventory" />
<x-service-package-modal title="Add Service Package" />
<x-service-modal title="Add Service" />


<script>
    $(document).ready(function() {
        let serviceRowUID = 0;
        let inventoryRowUID = 0;

        // Unified function to add a row to a table (service or inventory)
        function addRow(table, data) {

            let id = "discountType_" + Date.now() + "_" + (table === 'service' ? serviceRowUID++ : inventoryRowUID++);
            let isFixed = data.isFixed || false;


            let row = `
            <tr>
                <td><input type="text" name="${table}_name[]" class="form-control" value="${data.name || ''}" ></td>
                <td><input type="number" name="${table}_mrp[]" class="form-control price" value="${data.mrp}" ></td>

                ${table === 'inventory' ? `
                <td><input type="text" name="${table}_part_no[]" class="form-control part_no" value="${data.partNo || ''}"></td>
                <td><input type="text" name="${table}_hsn_code[]" class="form-control hsn_code" value="${data.hsn || ''}"></td>
                <td><input type="number" name="${table}_quantity[]" class="form-control qty" value="${data.qty || 1}"></td>
                ` : ''}

                <td><input type="number" name="${table}_cgst[]" class="form-control cgst" value="${data.cgst || 0}"></td>
                <td hidden ><input type="number" name="${table}_sgst[]" class="form-control sgst" value="${data.sgst || 0}"></td>
                <td hidden ><input type="number" name="${table}_igst[]" class="form-control igst" value="${data.igst || 0}"></td>
                <td>
                    <div class="input-group">
                        <input type="number" name="${table}_discount[]" class="form-control discount" value="${data.discount || 0}" onchange="calculateTotal($(this))">
                        <div class="input-group-text p-1">
                            <input type="checkbox" class="discountType" id="${id}" ${isFixed ? 'checked' : ''}>
                            <label class="ms-1 mb-0" for="${id}">${isFixed ? '$' : '%'}</label>
                        </div>
                    </div>
                    <input type="hidden" name="${table}_final_discount[]" class="finalDiscount" value="0">
                </td>
                <td><input type="number" name="${table}_total[]" class="form-control total" value="${data.total || 0}" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash"></i></button></td>
            </tr>`;

            if (table === 'service') {
                $("#dynamicServiceTable tbody").append(row);
            } else {
                $("#dynamicInventoryTable tbody").append(row);
            }
        }

        // Calculate total
        window.calculateTotal = function(tr) {
            console.log('calculateTotal');

            let price = parseFloat(tr.find('.price').val()) || 0;
            let discount = parseFloat(tr.find('.discount').val()) || 0;
            let isFixed = tr.find('.discountType').prop('checked');
            let total = isFixed ? price - discount : price - (price * discount / 100);
            total = Math.max(total, 0);
            tr.find('.total').val(total.toFixed(2));
            tr.find('.finalDiscount').val((price - total).toFixed(2));
        }


        // Recalculate total when discount value changes
        $(document).on('change', '.discount', function() {
            let tr = $(this).closest('tr');
            calculateTotal(tr);
        });
        // Toggle discount type
        $(document).on('change', '.discountType', function() {
            let tr = $(this).closest('tr');
            let label = $(this).siblings('label').length ? $(this).siblings('label') : $(this).next('label');
            label.text($(this).prop('checked') ? '$' : '%');
            calculateTotal(tr);
        });

        // Remove row
        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
        });

        // Add Service Row manually
        $('#addServiceRow').click(function() {
            addRow('service', {});
        });

        // Add Inventory Row manually
        $('#addInventoryRow').click(function() {
            addRow('inventory', {});
        });


        $('#packageSelect').on('change', function() {
            let o = $(this).find(':selected');
            if (!o.val()) return;

            // Read package info
            let packageName = o.data('package');
            let packagePrice = parseFloat(o.data('packageprice') || 0);
            let discount = parseFloat(o.data('discount') || 0);

            let hsn = o.data('hsn');
            let cgst = parseFloat(o.data('cgst') || 0);
            let sgst = parseFloat(o.data('sgst') || 0);
            let igst = parseFloat(o.data('igst') || 0);


            // Tax calculation
            let taxableAmount = packagePrice - discount;
            let taxPercent = cgst + sgst + igst;
            let taxAmount = (taxableAmount * taxPercent) / 100;

            let total = taxableAmount + taxAmount;



            // Parse items JSON
            let items = [];
            try {
                items = JSON.parse(o.attr('data-items'));
            } catch (e) {
                console.error("Failed to parse package items JSON:", e);
            }

            // Call your addRow function or any logic
            addRow('service', {
                name: packageName,
                mrp: packagePrice,
                discount: discount,
                total: total,
                hsn: hsn,
                cgst: cgst,
                sgst: sgst,
                igst: igst,
                items: items
            });

            // Reset the select
            $(this).val('').trigger('change');
        });


        // Handle package selection
        $('#inventorySelect').on('change', function() {
            let o = $(this).find(':selected');
            if (!o.val()) return;

            let mrp = parseFloat(o.data('mrp') || 0);
            let discount = parseFloat(o.data('discount') || 0);
            let total = mrp - discount;

            addRow('inventory', {
                name: o.data('name'),
                mrp: mrp,
                discount: discount,
                total: total,
                partNo: o.data('partno'),
                hsn: o.data('hsn'),
                cgst: o.data('cgst'),
                sgst: o.data('sgst'),
                igst: o.data('igst')
            });

            $(this).val('');
        });

        // });

        // $(document).ready(function() {

        let customers = @json($customers);
        let vehicles = @json($vehicles);
        let packages = @json($packages);

        // -------------------------------
        // JOB TYPE → INSURANCE SHOW/HIDE
        // -------------------------------
        $('#jobType').change(function() {
            if ($(this).val() === 'Accident') {
                $('#insuranceSection').show();
            } else {
                $('#insuranceSection').hide();
            }
        });




        /* ================= ROUTES ================= */
        const roRoutes = {
            store: "{{ route('insurance-ro.store') }}",
            edit: "{{ route('insurance-ro.edit', ':id') }}",
            update: "{{ route('insurance-ro.update', ':id') }}",
            destroy: "{{ route('insurance-ro.destroy', ':id') }}"
        };

        /* ================= DELETE RO ================= */
        $(document).on('click', '.delete-ro', function() {
            let id = $(this).data('id');
            let url = roRoutes.destroy.replace(':id', id);

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this RO?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            Swal.fire('Deleted!', res.message || 'RO deleted.', 'success');
                            table.ajax.reload(null, false);
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong!', 'error');
                        }
                    });
                }
            });
        });

        /* ================= ADD / UPDATE RO ================= */
        $('#roForm').on('submit', function(e) {
            e.preventDefault();

            let id = $('#ro_id').val();
            let url = id ? roRoutes.update.replace(':id', id) : roRoutes.store;
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function() {
                    $('#roModal').modal('hide');
                    table.ajax.reload(null, false);
                },
                error: function(xhr) {
                    Swal.fire(
                        'Error',
                        xhr.responseJSON?.error || 'Something went wrong',
                        'error'
                    );
                }
            });
        });

        /* ================= EDIT RO ================= */
        $(document).on('click', '.edit-ro', function() {
            let id = $(this).data('id');
            let url = roRoutes.edit.replace(':id', id);

            $.get(url, function(res) {

                $('#insuranceRoForm')[0].reset();
                $('#dynamicServiceTable tbody').empty();
                $('#dynamicInventoryTable tbody').empty();

                $('#ro_id').val(id);
                $('#roModalTitle').text('Edit Insurance RO');

                /* ---------- BASIC FIELDS ---------- */
                const set = (name, val) =>
                    $('#insuranceRoForm [name="' + name + '"]').val(val);

                set('service_due_date', res.service_due_date);
                set('delivery_due_date', res.delivery_due_date);
                set('assigned_mechanic', res.assigned_mechanic);
                set('voice_of_customer', res.voice_of_customer);
                set('instruction_for_mechanic', res.instruction_for_mechanic);
                set('remark', res.remark);

                /* ---------- CUSTOMER ---------- */
                if (res.customer) {
                    set('cust_id', res.customer.id);
                    set('custName', res.customer.cus_name);
                    set('custContact', res.customer.cus_mob);
                    set('custEmail', res.customer.cus_email);
                    set('custAddress', res.customer.c_add);
                    set('custGST', res.customer.c_gst);
                }

                if (res.vehicle) {
                    const v = res.vehicle; // shorthand

                    // Select the vehicle in main dropdown
                    $('#vehicleSelect').val(v.v_id).trigger('change');

                    // Fill Vehicle Info fields
                    $('input[name="vehicleId"]').val(v.v_id);
                    $('select[name="vehicle_emirate"]').val(v.vehicle_emirate);
                    $('input[name="vehicle_registration"]').val(v.registration);
                    $('input[name="vehicle_number_plate_code"]').val(v.number_plate_code);
                    $('select[name="vehicle_number_plate_color"]').val(v.number_plate_color);
                    $('input[name="vehicle_car_body_color"]').val(v.car_body_color);
                    $('select[name="vehicle_manfacturing_year"]').val(v.manufacturing_year);
                    $('select[name="vehicle_carbrand"]').val(v.carbrand).trigger('change');

                    // Wait for car models to populate after brand change
                    setTimeout(() => {
                        $('select[name="vehicle_carmodel"]').val(v.carmodel).trigger('change');
                    }, 500);

                    $('select[name="vehicle_fueltype"]').val(v.fueltype);
                    $('input[name="vehicle_chassis_no"]').val(v.chassis_no);
                    $('input[name="vehicle_engine_no"]').val(v.engine_no);
                    $('select[name="vehicle_braking"]').val(v.braking);
                    $('select[name="vehicle_transmission"]').val(v.transmission);
                    $('input[name="vehicle_odometer"]').val(v.odo_meter_reading);
                    $('select[name="vehicle_fuelmeter"]').val(v.fuel_meter);
                }

                /* ---------- INSURANCE ---------- */
                if (res.insurance_company) {
                    set('insuranceId', res.insurance_company.id);
                    set('insurance_company_name', res.insurance_company.insurence_company_name);
                    set('insurance_tax_number', res.insurance_company.insurence_tax_number);
                    set('insurance_company_contact', res.insurance_company.insurence_company_number);
                    set('insurance_email_address', res.insurance_company.insurence_email_address);
                    set('insurence_driver_name', res.driver_name);
                    set('insurence_driver_mobile_number', res.driver_mobile_number);
                }

                /* ---------- SERVICES ---------- */
                JSON.parse(res.service || '[]').forEach(s => {
                    addRow('service', s);
                });

                /* ---------- INVENTORY ---------- */
                JSON.parse(res.inventory || '[]').forEach(p => {
                    addRow('inventory', p);
                });

                $('#roModal').modal('show');
            }).fail(function() {
                Swal.fire('Error', 'Unable to fetch RO data', 'error');
            });
        });




        // -------------------------------
        // CUSTOMER SELECT → AUTO FILL DATA
        // -------------------------------
        $('#customerSelect').on('change', function() {
            let cust = $(this).find(':selected');
            $('#custName').val(cust.data('name'));
            $('#custContact').val(cust.data('contact'));
            $('#custEmail').val(cust.data('email'));
            $('#custAddress').val(cust.data('address'));
            $('#custGST').val(cust.data('gst'));

            let cid = cust.val();

            $("#vehicleSelect option").hide();
            $("#vehicleSelect option[value='']").show();
            $("#vehicleSelect option").each(function() {
                if ($(this).data('customer') == cid) $(this).show();
            });

            $("#vehicleSelect").val("").trigger('change');
        });

        // -------------------------------
        // VEHICLE SELECT → AUTO FILL DATA
        // -------------------------------
        $('#vehicleSelect').on('change', function() {
            let v = $(this).find(':selected');
            $('#vehBrand').val(v.data('brand'));
            $('#vehModel').val(v.data('model'));
            $('#m_id').val(v.data('m_id'));
            $('#vehReg').val(v.data('reg'));
            $('#vehFuel').val(v.data('fuel'));
            $('#vehChassis').val(v.data('chassis'));
            $('#vehOdo').val(v.data('odo'));
            $('#vehTrans').val(v.data('transmission'));
        });



        $('#jobCardForm').submit(function(e) {
            e.preventDefault();

            // Collect dynamic services
            let services = [];
            $('#dynamicServiceTable tbody tr').each(function() {
                let service_name = $(this).find('input[name="service_name[]"]').val();
                let mrp = parseFloat($(this).find('input[name="service_mrp[]"]').val()) || 0;
                let discount = parseFloat($(this).find('input[name="service_discount[]"]').val()) || 0;
                let total = parseFloat($(this).find('input[name="service_total[]"]').val()) || 0;
                let finalDiscount = parseFloat($(this).find('input[name="service_final_discount[]"]').val()) || 0;

                if (service_name) {
                    services.push({
                        service_name,
                        mrp,
                        discount,
                        total,
                        finalDiscount
                    });
                }
            });

            // Collect dynamic inventory
            let inventory = [];
            $('#dynamicInventoryTable tbody tr').each(function() {
                let name = $(this).find('input[name="inventory_name[]"]').val();
                let mrp = parseFloat($(this).find('input[name="inventory_mrp[]"]').val()) || 0;
                let partNo = $(this).find('input[name="inventory_part_no[]"]').val();
                let hsn = $(this).find('input[name="inventory_hsn_code[]"]').val();
                let qty = parseFloat($(this).find('input[name="inventory_quantity[]"]').val()) || 0;
                let cgst = parseFloat($(this).find('input[name="inventory_cgst[]"]').val()) || 0;
                let sgst = parseFloat($(this).find('input[name="inventory_sgst[]"]').val()) || 0;
                let igst = parseFloat($(this).find('input[name="inventory_igst[]"]').val()) || 0;
                let discount = parseFloat($(this).find('input[name="inventory_discount[]"]').val()) || 0;
                let finalDiscount = parseFloat($(this).find('input[name="inventory_final_discount[]"]').val()) || 0;
                let total = parseFloat($(this).find('input[name="inventory_total[]"]').val()) || 0;

                if (name) {
                    inventory.push({
                        name,
                        mrp,
                        partNo,
                        hsn,
                        qty,
                        cgst,
                        sgst,
                        igst,
                        discount,
                        finalDiscount,
                        total
                    });
                }
            });

            // Prepare FormData
            let formData = new FormData(this);
            formData.append('services', JSON.stringify(services));
            formData.append('inventory', JSON.stringify(inventory));

            let id = $(this).data('id'); // For edit
            let url = id ? `/jobcards/${id}` : "{{ route('jobcards.store') }}";
            let type = id ? 'POST' : 'POST'; // Use method spoofing in controller if needed

            // Submit via AJAX
            $.ajax({
                url: url,
                type: type,
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire('Saved!', '', 'success');
                    $('#jobCardModal').modal('hide');
                    jobCardTable.ajax.reload();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let msg = '';
                    $.each(errors, function(k, v) {
                        msg += v[0] + '\n';
                    });
                    Swal.fire('Error!', msg, 'error');
                }
            });
        });

        // -------------------------------
        // SEND EMAIL with SweetAlert (SWAL)
        // -------------------------------



        $(document).on('click', '.send-email', function() {
            const id = $(this).data('id');

            // Use Laravel route helper
            const url = "{{ route('jobcards.send-email', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Email Sent',
                        text: 'Your email has been sent successfully!',
                        confirmButtonText: 'OK'
                    });
                },
                error() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to send email. Please try again!',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });




        // Handle the Mark Payment button click
        $(document).on('click', '.mark-payment', function() {


            var jobCardId = $(this).data('id');
            var invoice = $(this).data('invoice');
            var dueAmount = $(this).data('dueamount');

            // Set the data in the modal
            $('#jobCardId').val(jobCardId);
            $('#paymentAmount').val(dueAmount); // Default to the due amount
            $('#paymentMethod').val('Cash'); // Default payment method

            // Show the modal
            $('#markPaymentModal').modal('show');
        });

        // Handle the payment form submission
        $('#paymentForm').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            var formData = $(this).serialize(); // Get form data

            $.ajax({
                url: $(this).attr('action'), // Get the form action URL
                type: 'POST',
                data: formData, // Send form data
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Payment Recorded', '', 'success');
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                }
            });
        });
    });
</script>

<script>
    let currentStep = 1;
    const totalSteps = 4;

    function showStep(step) {
        for (let i = 1; i <= totalSteps; i++) {
            const el = document.getElementById('step' + i);
            const circle = document.querySelector(`.step[data-step="${i}"] .step-circle`);
            if (i === step) el.classList.add('active');
            else el.classList.remove('active');

            // update circles
            if (i < step) {
                circle.classList.add('completed');
                circle.innerHTML = i;
            } else if (i === step) {
                circle.classList.add('active');
                circle.classList.remove('completed');
                circle.innerHTML = i;
            } else {
                circle.classList.remove('completed', 'active');
                circle.innerHTML = i;
            }
        }
        currentStep = step;
    }

    function nextStep(step) {
        showStep(step);
    }

    function prevStep(step) {
        showStep(step);
    }

    showStep(1); // default
</script>


<script>
    $(function() {

        // ===================== DATATABLE =====================
        var table = $('#rosTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("insurance-ro.ajax") }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },

                // {
                //     data: 'job_card_type',
                //     name: 'job_card_type'
                // },

                {
                    data: 'insurance',
                    name: 'insurance'
                },

                {
                    data: 'registration',
                    name: 'registration'
                },

                // {
                //     data: 'reg_no',
                //     name: 'vehicle.registration'
                // },

                // {
                //     data: 'chassis',
                //     name: 'vehicle.chassis_no'
                // },

                {
                    data: 'total_amount',
                    name: 'totalPrice'
                },

                {
                    data: 'split_amount',
                    name: 'split_amount',
                    orderable: false
                },

                // {
                //     data: 'send_approval',
                //     name: 'send_approval',
                //     orderable: false,
                //     searchable: false
                // },

                {
                    data: 'status',
                    name: 'status',
                    orderable: false
                },



                {
                    data: 'payment_mark',
                    name: 'payment_mark',
                    orderable: false
                },


                {
                    data: 'work_status',
                    name: 'work_status',
                    render: function(data, type, row) {
                        // Render status as a dropdown with different colors for each status
                        return `
            <select class="status-dropdown" data-id="${row.id}">
                <option value="1" ${data == '1' ? 'selected' : ''} class="status-self-approve">Self Approve</option>
                <option value="2" ${data == '2' ? 'selected' : ''} class="status-approved">Approved</option>
                <option value="5" ${data == '5' ? 'selected' : ''} class="status-reject">Reject</option>
                <option value="3" ${data == '3' ? 'selected' : ''} class="status-working">Working</option>
                <option value="4" ${data == '4' ? 'selected' : ''} class="status-completed">Completed</option>
            </select>
        `;
                    }
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            dom: 'Bfrtip', // Buttons position
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            initComplete: function() {
                // Add event listener for status dropdown changes
                $('#rosTable').on('change', '.status-dropdown', function() {
                    var jobCardId = $(this).data('id');
                    var newStatus = $(this).val();


                    // Send the updated status to the server via AJAX
                    $.ajax({
                        url: "{{ route('jobcards.updateStatus') }}", // Replace with your route to handle status update
                        method: 'POST',
                        data: {
                            id: jobCardId,
                            status: newStatus,
                            _token: '{{ csrf_token() }}' // Include CSRF token for security
                        },
                        success: function(response) {
                            if (response.success) {
                                // SweetAlert success message
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Status Updated!',
                                    text: 'The job card status has been updated successfully.',
                                    confirmButtonText: 'OK'
                                });
                                location.reload(); // Reload the page to reflect changes
                            } else {
                                // SweetAlert error message
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Update Failed!',
                                    text: 'There was an issue updating the job card status.',
                                    confirmButtonText: 'Try Again'
                                });
                            }
                        },
                        error: function() {
                            // SweetAlert error message for AJAX failure
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: 'An error occurred while updating the status. Please try again later.',
                                confirmButtonText: 'Close'
                            });
                        }
                    });

                });
            }
        });

        // ===================== ADD RO =====================
        $('#addRoBtn').click(function() {
            // $('#roForm')[0].reset();
            $('#ro_id').val('');
            $('#roModalTitle').text('Add Insurance RO');
            $('#roModal').modal('show');
        });



    });
</script>


<script>
    $(document).on('click', '.toggle-status', function() {

        let btn = $(this);


        $("#splitBillingModal").show();


        let id = btn.data('id');
        let inc_id = btn.data('inc_id');
        let vehicle_id = btn.data('vehicle_id');
        let max_val_id = btn.data('max_val');


        let currentState = btn.data('state');
        let newState = currentState === 1 ? 0 : 1;

        if (newState === 1) {

            $.ajax({
                url: "{{ route('insurance-ro.check-split') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    vehicle_id: vehicle_id
                },
                dataType: "json",
                success: function(res) {

                    if (res.status === 'SHOW_POPUP') {

                        $("#sb_uid").val(id);
                        $("#inc_id").val(res.inc_id);
                        $("#cust_id").val(res.data.cust_id);

                        $("#liability_percentage").val(res.data.liability_percentage);
                        $("#liability_amount").val(res.data.liability_amount);
                        $("#cust_name").val(res.data.cust_name);
                        $("#cust_contact").val(res.data.cust_contact);
                        $("#cust_whatsapp").val(res.data.cust_whatsapp);
                        $("#cust_email").val(res.data.cust_email);
                        $("#cust_address").val(res.data.cust_address);
                        $("#cust_tax").val(res.data.cust_tax);

                        $("#splitBillingModal").show();

                    } else {
                        updateToggle(btn, id, newState);
                    }
                }
            });

        } else {
            updateToggle(btn, id, newState);
        }
    });

    function updateToggle(btn, id, state) {

        $.ajax({
            url: "{{ route('insurance-ro.toggle-split') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                state: state
            },
            success: function() {
                btn
                    .data('state', state)
                    .toggleClass('btn-success btn-secondary')
                    .text(state === 1 ? 'ON' : 'OFF');
            }
        });
    }
</script>

<script>
    $('#saveSplitBilling').click(function() {

        let id = $('#sb_uid').val();

        let maxVal = parseFloat($('#max_val_id').val());

        let percentage = parseFloat($('#liability_percentage').val()) || 0;
        let amount = parseFloat($('#liability_amount').val()) || 0;


        $('#liabilitypercentageerror').hide();
        $('#liabilityamounterror').hide();



        $.ajax({
            url: "{{ route('insurance-ro.save-split') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                liability_percentage: percentage,
                liability_amount: amount,
                inc_id: $('#inc_id').val(),
                cust_id: $('#cust_id').val(),
                cust_name: $('#cust_name').val(),
                cust_contact: $('#cust_contact').val(),
                cust_whatsapp: $('#cust_whatsapp').val(),
                cust_email: $('#cust_email').val(),
                cust_address: $('#cust_address').val(),
                cust_tax: $('#cust_tax').val()
            },
            success: function() {
                $('#splitBillingModal').fadeOut();
                location.reload(); // Reload the page to reflect changes
            }
        });

    });

    $('#closeModal').click(function() {

        let id = $('#sb_uid').val();

        $.post("{{ route('insurance-ro.toggle-split') }}", {
            _token: "{{ csrf_token() }}",
            id: id,
            state: 0
        }, function() {
            $('#splitBillingModal').hide();
            location.reload(); // Reload the page to reflect changes


        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const percentageInput = document.getElementById("liability_percentage");
        const amountInput = document.getElementById("liability_amount");

        const percentageCol = percentageInput.closest(".sb-col");
        const amountCol = amountInput.closest(".sb-col");

        percentageInput.addEventListener("input", function() {
            if (this.value !== "") {
                amountCol.style.display = "none";
            } else {
                amountCol.style.display = "block";
            }
        });

        amountInput.addEventListener("input", function() {
            if (this.value !== "") {
                percentageCol.style.display = "none";
            } else {
                percentageCol.style.display = "block";
            }
        });

    });

    $(document).on('change', '.mark-payment', function() {

        let jobcardId = $(this).data('id');
        let incid = $(this).data('incid');
        let paymentType = $(this).data('type'); // customer | insurance
        let paymentMode = $(this).val(); // cash | card | bank transfer

        if (!paymentMode) return;

        $.ajax({
            url: "{{ route('insurance.markPayment') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                jobcard_id: jobcardId,
                incid: incid,
                payment_type: paymentType,
                payment_mode: paymentMode,
                mark_in: 'datatable'
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Payment Marked',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => location.reload());
            },
            error: function() {
                Swal.fire('Error', 'Payment failed', 'error');
            }
        });
    });
</script>



@endsection