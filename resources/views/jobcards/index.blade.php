@extends('user.dashboard.layout.master')

@section('user-contant')

@php

@endphp
<style>
    .preview-img {
        width: 160px;
        height: 120px;
        object-fit: cover;
        border: 2px solid #ccc;
        border-radius: 6px;
        margin-top: 10px;
        transition: 0.2s ease;
    }

    .preview-img:hover {
        transform: scale(1.05);
        border-color: #0d6efd;
    }

    .modal-xl {
        max-width: 90% !important;
    }

    .card-header h4 {
        margin: 0;
    }

    /* ================= Form Inputs ================= */
    .form-select,
    .form-control {
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        padding: 5px 7px;
        /* more padding inside the input */
        font-size: 1rem;
        /* slightly larger font */
    }

    .form-select:focus,
    .form-control:focus {
        /* box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); */
        border-color: #0d6efd;
    }

    /* ================= Form Groups ================= */
    .expense-block .row.g-3 {
        margin-bottom: 1.5rem;
        /* more space between rows */
    }

    .expense-block label {
        display: block;
        /* label on top */
        font-weight: 500;
        margin-bottom: 0.5rem;
        /* space between label and input */
        font-size: 0.95rem;
        color: #495057;
    }

    .expense-block .form-control,
    .expense-block .form-select {
        width: 100%;
        /* full width */
    }

    /* ================= Buttons ================= */
    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }

    /* ================= Image Preview ================= */
    .preview-img {
        display: block;
        width: 180px;
        height: 130px;
        object-fit: cover;
        border: 2px solid #ccc;
        border-radius: 6px;
        margin-top: 0.5rem;
    }
</style>

<style>
    /* Style the status dropdown inside the DataTable */
    table#jobCardTable .status-dropdown {
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
    table#jobCardTable .status-dropdown:hover,
    table#jobCardTable .status-dropdown:focus {
        border-color: #007bff;
        /* Blue border on hover/focus */
        outline: none;
        /* Remove default focus outline */
    }

    /* Color the options based on the status */
    table#jobCardTable .status-dropdown option {
        color: #333;
        /* Default text color */
    }

    table#jobCardTable .status-dropdown option[value="Pending"] {
        color: #e74c3c;
        /* Red for Pending */
    }

    table#jobCardTable .status-dropdown option[value="Completed"] {
        color: #2ecc71;
        /* Green for Completed */
    }

    table#jobCardTable .status-dropdown option[value="In Progress"] {
        color: #f39c12;
        /* Yellow for In Progress */
    }

    /* Styling for the table cells to make the dropdowns align well */
    table#jobCardTable td {
        text-align: center;
        /* Center align table cells */
    }

    /* Optional: Style the select box when it's in focus */
    table#jobCardTable .status-dropdown:focus {
        border-color: #3498db;
        /* Blue color when focused */
    }

    /* Add a border and background color to make the selected status stand out */
    table#jobCardTable .status-dropdown option:checked {
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

<style>
    .section-title {
        font-weight: 600;
        font-size: 15px;
        padding: 6px 0;
        /* border-bottom: 2px solid #0d6efd; */
        margin-bottom: 10px;
        /* color: #0d6efd; */
    }
</style>

<style>
    .modal-xl {
        max-width: 98% !important;
    }

    .preview-img {
        width: 140px;
        height: 110px;
        object-fit: cover;
        border: 2px solid #ccc;
        margin-top: 10px;
    }

    .section-title {
        font-weight: 600;
        margin-top: 20px;
        margin-bottom: 10px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
    }
</style>


<!-- Modal for Marking Payment -->
<div class="modal fade" id="markPaymentModal" tabindex="-1" role="dialog" aria-labelledby="markPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="markPaymentModalLabel">{{ translate('Mark Payment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="paymentForm" method="POST" action="{{ route('jobcards.markPayment') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="jobCardId" name="job_card_id">
                    <div class="form-group">
                        <label for="paymentAmount">{{ translate('Amount Paid') }}</label>
                        <input type="number" class="form-control" id="paymentAmount" name="payment_amount" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethod">{{ translate('Payment Method') }}</label>
                        <select class="form-control" id="paymentMethod" name="payment_method" required>
                            <option value="Cash">{{ translate('Cash') }}</option>
                            <option value="Credit">{{ translate('Credit') }}</option>
                            <option value="Bank Transfer">{{ translate('Bank Transfer') }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ translate('Save Payment') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- ================== HTML ================== -->
<div class="main-content">
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h4>Job Cards</h4>
                <button class="btn btn-primary" id="addJobCardBtn">{{ translate('Add Job Card') }}</button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="statusFilter" class="form-label me-2">{{ translate('Filter by Status:') }}</label>
                    <select id="statusFilter" class="form-select form-select-sm w-auto d-inline-block">
                        <option value="">{{ translate('All') }}</option>
                        <option value="P">{{ translate('Pending') }}</option>
                        <!-- <option value="In Progress">In Progress</option> -->
                        <option value="C">{{ translate('Completed') }}</option>
                    </select>
                </div>
                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle" id="jobCardTable">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Job Card No') }}</th>
                                <th>{{ translate('Invoice No') }}</th>
                                <th>{{ translate('Customer ') }}</th>
                                <th>{{ translate('Vehicle') }}</th>
                                <th>{{ translate('Status') }}</th>
                                <th>{{ translate('Pay-Status') }}</th>
                                <th>{{ translate('Amount') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                        <!-- Filter row will be inserted by JS -->
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JOB CARD MODAL -->
<div class="modal fade" id="jobCardModal">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form id="jobCardForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-content shadow-lg">

                <!-- MODAL HEADER -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-tools mr-2"></i> {{ translate('Create Job Card') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <!-- MODAL BODY -->
                <div class="modal-body p-4">

                    <!-- SECTION: Job Type -->
                    <div class="section-block mb-4">
                        <h6 class="section-title">{{ translate('Job Type') }}</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label><strong>{{ translate('Job Type') }}</strong></label>
                                <select id="jobType" name="job_card_type" class="form-control select2">
                                    <option value="">{{ translate('Select') }}</option>
                                    <option value="Service">{{ translate('Service') }}</option>
                                    <option value="Accident">{{ translate('Accident') }}</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label><strong>{{ translate('Job Card No') }}</strong></label>
                                <input type="text" name="job_card_no" class="form-control bg-light"
                                    value="{{ $jobcard_no }}" readonly>
                                <input type="hidden" name="uid" class="form-control bg-light"
                                    value="{{ $jobcard_uid }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: Customer -->
                    <div class="section-block mb-4">
                        <div class="section-title mb-0 d-flex justify-content-between align-items-center mb-3">
                            <h6>{{ translate('Customer') }}</h6>
                            <button type="button" class="btn btn-primary" id="addCustomerBtn">
                                {{ translate('Add Customer') }}
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label><strong>{{ translate('Select Customer') }}</strong></label>
                                <select name="c_id" id="customerSelect" class="form-control select2">
                                    <option value="">{{ translate('Select Customer') }}</option>
                                    @foreach($customers as $c)
                                    <option value="{{ $c->c_id }}"
                                        data-name="{{ $c->cus_name }}"
                                        data-contact="{{ $c->cus_mob }}"
                                        data-email="{{ $c->cus_email }}"
                                        data-address="{{ $c->c_add }}"
                                        data-gst="{{ $c->c_gst }}">
                                        {{ $c->cus_name }} ({{ $c->cus_mob }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" id="custName" name="name">

                            <div class="col-md-4 mb-3">
                                <label><strong>{{ translate('Contact') }}</strong></label>
                                <input type="text" id="custContact" name="contact" class="form-control bg-light" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label><strong>{{ translate('Email') }}</strong></label>
                                <input type="text" id="custEmail" name="email" class="form-control bg-light" readonly>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label><strong>{{ translate('Address') }}</strong></label>
                                <textarea id="custAddress" name="address" class="form-control bg-light" rows="2" readonly></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: Vehicle -->
                    <div class="section-block mb-4">
                        <div class="section-title mb-0 d-flex justify-content-between align-items-center mb-3">
                            <h6 class="">{{ translate('Vehicle') }}</h6>
                            <button type="button" class="btn btn-primary" id="addVehicleBtn">
                                {{ translate('Add Vehicle') }}
                            </button>

                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label><strong>{{ translate('Select Vehicle') }}</strong></label>
                                <select id="vehicleSelect" name="v_id" class="form-control select2">
                                    <option value="">{{ translate('Select Vehicle') }}</option>
                                    @foreach($vehicles as $v)
                                    <option value="{{ $v->id }}"
                                        data-customer="{{ $v->c_id }}"
                                        data-brand="{{ $v->carbrand }}"
                                        data-model="{{ $v->carmodel }}"
                                        data-m_id="{{ $v->mechanic_id }}"
                                        data-reg="{{ $v->registration }}"
                                        data-fuel="{{ $v->fueltype }}"
                                        data-chassis="{{ $v->chassis_no }}"
                                        data-odo="{{ $v->odometer }}"
                                        data-transmission="{{ $v->transmission }}">
                                        {{ $v->carbrand }} {{ $v->carmodel }} ({{ $v->registration }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label><strong>{{ translate('Brand') }}</strong></label>
                                <input type="text" id="vehBrand" name="vehBrand" class="form-control bg-light" readonly>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label><strong>{{ translate('Model') }}</strong></label>
                                <input type="text" id="vehModel" name="vehModel" class="form-control bg-light" readonly>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label><strong>{{ translate('Reg No') }}</strong></label>
                                <input type="text" id="vehReg" name="vehReg" class="form-control bg-light" readonly>
                                <input type="hidden" id="m_id" name="m_id" class="form-control bg-light" readonly>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label><strong>{{ translate('Fuel Type') }}</strong></label>
                                <input type="text" id="vehFuel" name="vehFuel" class="form-control bg-light" readonly>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label><strong>{{ translate('Chassis No') }}</strong></label>
                                <input type="text" id="vehChassis" name="vehChassis" class="form-control bg-light" readonly>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label><strong>{{ translate('Transmission') }}</strong></label>
                                <input type="text" id="vehTrans" name="vehTrans" class="form-control bg-light" readonly>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label><strong>{{ translate('Hodometer') }}</strong></label>
                                <input type="text" id="odometer" name="odometer" class="form-control bg-light">
                            </div>
                        </div>

                    </div>

                    <!-- SECTION: Insurance (Auto-Show for Accident) -->
                    <div id="insuranceSection" class="section-block mb-4" style="display:none">
                        <h6 class="section-title">{{ translate('Insurance Details') }}</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3"><label>{{ translate('Company') }}</label><input type="text" name="insurance_company_name" class="form-control"></div>
                            <div class="col-md-4 mb-3"><label>{{ translate('Policy Number') }}</label><input type="text" name="insurance_policy_number" class="form-control"></div>
                            <div class="col-md-4 mb-3"><label>{{ translate('Claim Number') }}</label><input type="text" name="insurance_claim_number" class="form-control"></div>
                            <div class="col-md-4 mb-3"><label>{{ translate('Insurance Code') }}</label><input type="text" name="insurance_code" class="form-control"></div>
                            <div class="col-md-4 mb-3"><label>{{ translate('TAXIN') }}</label><input type="text" name="insurance_gstin" class="form-control"></div>
                            <div class="col-md-4 mb-3"><label>{{ translate('Expiry') }}</label><input type="date" name="insexpiry" class="form-control"></div>
                        </div>
                    </div>


                    <!-- Inventory -->
                    <div class="section-block  mb-4">
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
                                        <th>VAT(%)</th>
                                        <!-- <th>CGST(%)</th>
                                        <th>SGST(%)</th>
                                        <th>IGST(%)</th> -->
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
                    <div class="section-block  mb-4">
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
                                        <th>VAT(%)</th>
                                        <!-- <th>CGST(%)</th>
                                        <th>SGST(%)</th>
                                        <th>IGST(%)</th> -->
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

                    <!-- SECTION: Voice & Remarks -->
                    <div class="section-block mb-2">
                        <h6 class="section-title">{{ translate('Customer & Mechanic Communication') }}</h6>
                        <div class="row">

                            <!-- Voice of Customer -->
                            <div class="col-md-4 mb-3">
                                <label><strong>{{ translate('Voice of Customer') }}</strong></label>
                                <textarea name="voice_of_customer" class="form-control" rows="3"></textarea>
                            </div>

                            <!-- Instruction for Mechanic -->
                            <div class="col-md-4 mb-3">
                                <label><strong>{{ translate('Instruction for Mechanic') }}</strong></label>
                                <textarea name="instruction_for_mechanic" class="form-control" rows="3"></textarea>
                            </div>

                            <!-- Remark (optional) -->
                            <div class="col-md-4 mb-3">
                                <label><strong>{{ translate('Remark') }}</strong> <small>{{ translate('(optional)') }}</small></label>
                                <textarea name="remark" class="form-control" rows="2"></textarea>
                            </div>

                        </div>
                    </div>


                </div>

                <!-- MODAL FOOTER -->
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save mr-1"></i> {{ translate('Save Job Card') }}
                    </button>
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> {{ translate('Close') }}
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<style>
    .section-block {
        padding: 15px;
        border: 1px solid #e3e3e3;
        border-radius: 6px;
        background: #fafafa;
    }

    .section-title {
        font-weight: 600;
        margin-bottom: 12px;
        color: #0056b3;
        border-left: 4px solid #007bff;
        padding-left: 10px;
    }
</style>



<x-vehicle-modal title="Add Vehicle" />
<x-customer-modal title="Add Customer" :reload="true" />
<x-inventory-modal title="Add Inventory" :reload="true" />
<x-service-package-modal title="Add Service Package" :reload="true" />
<x-service-modal title="Add Service" :reload="true" />





<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


<script>
    $(document).ready(function() {

        // -------------------------------
        // Initialize DataTable
        // -------------------------------
        var jobCardTable = $('#jobCardTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('jobcards.list') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'job_card_no',
                    name: 'job_card_no'
                },
                {
                    data: 'invoice_no',
                    name: 'invoice_no'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'carbrand',
                    name: 'carbrand'
                },
                {
                    data: 'work_status',
                    name: 'work_status',
                    render: function(data, type, row) {

                        const isDisabled = data == '4' ? 'disabled' : '';

                        return `
            <select class="status-dropdown"
                    data-id="${row.id}"
                    ${isDisabled}>
                <option value="1" ${data == '1' ? 'selected' : ''} class="status-self-approve">
                    Self Approve
                </option>
                <option value="2" ${data == '2' ? 'selected' : ''} class="status-approved">
                    Approved
                </option>
                <option value="5" ${data == '5' ? 'selected' : ''} class="status-reject">
                    Reject
                </option>
                <option value="3" ${data == '3' ? 'selected' : ''} class="status-working">
                    Working
                </option>
                <option value="4" ${data == '4' ? 'selected' : ''} class="status-completed">
                    Completed
                </option>
            </select>
        `;
                    }
                },
                {
                    data: 'status',
                    name: 'status'
                },

                {
                    data: 'totalPrice',
                    name: 'totalPrice'
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
                $('#jobCardTable').on('change', '.status-dropdown', function() {
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
                                jobCardTable.ajax.reload(); // Reload the table data
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

        // -------------------------------
        // Status Filter Dropdown
        // -------------------------------
        $('#statusFilter').on('change', function() {
            var val = $(this).val();
            jobCardTable.column(5).search(val).draw(); // Status column index = 5
        });


        // Laravel route names for JobCards
        const routes = {
            edit: "{{ route('jobcards.edit', ':id') }}",
            destroy: "{{ route('jobcards.destroy', ':id') }}"
        };

        // -------------------------------
        // EDIT JOB CARD
        // -------------------------------
        $(document).on('click', '.editJobCard', function() {
            let id = $(this).data('id');

            $.ajax({
                url: routes.edit.replace(':id', id), // use route name
                method: 'GET',
                success: function(res) {

                    // Reset form
                    $('#jobCardForm')[0].reset();
                    $('#dynamicServiceTable tbody').empty();
                    $('#dynamicInventoryTable tbody').empty();

                    // mark form as edit mode
                    $('#jobCardForm').data('id', id);

                    // Helper to set field values
                    const set = (name, val) =>
                        $('#jobCardForm [name="' + name + '"]').val(val);

                    /* ---------------------------
                     *  BASIC JOB CARD FIELDS
                     * --------------------------- */
                    set('job_card_no', res.job_card_no);
                    set('job_card_type', res.job_card_type);
                    set('invoice_no', res.invoice_no);
                    set('status', res.status);
                    set('totalPrice', res.totalPrice);
                    set('dueamount', res.dueamount);
                    set('service_discount', res.service_discount);
                    set('part_discount', res.part_discount);
                    set('packageDiscount', res.packageDiscount);
                    set('packageDiscountAmount', res.packageDiscountAmount);
                    set('payment_method', res.payment_method);
                    set('completed_work_date', res.completed_work_date);
                    set('work_status', res.work_status);
                    set('voice_of_customer', res.voice_of_customer);
                    set('instruction_for_mechanic', res.instruction_for_mechanic);
                    set('remark', res.remark);

                    $('#jobCardForm [name="job_card_type"]').trigger('change');

                    /* ---------------------------
                     *  CUSTOMER INFO
                     * --------------------------- */
                    if (res.c_id) {
                        $('#customerSelect').val(res.c_id).trigger('change');
                        $('#custName').val(res.name);
                        $('#custContact').val(res.contact);
                        $('#custEmail').val(res.email);
                        $('#custAddress').val(res.address);
                        $('#custGST').val(res.c_gst);
                    }

                    /* ---------------------------
                     *  VEHICLE INFO
                     * --------------------------- */
                    if (res.v_id) {
                        $('#vehicleSelect').val(res.v_id).trigger('change');
                        $('#vehBrand').val(res.carbrand);
                        $('#vehModel').val(res.carmodel);
                        $('#m_id').val(res.m_id);
                        $('#vehReg').val(res.registration);
                        $('#vehFuel').val(res.fueltype);
                        $('#vehChassis').val(res.chassis_no);
                        $('#vehOdo').val(res.odometer);
                        $('#vehTrans').val(res.transmission);
                    }

                    /* ---------------------------
                     *  INSURANCE INFO
                     * --------------------------- */
                    if (res.job_card_type === 'Accident') {
                        $('#insuranceSection').show();
                        set('insurance_company_name', res.insurance_company_name);
                        set('insurance_policy_number', res.insurance_policy_number);
                        set('insurance_claim_number', res.insurance_claim_number);
                        set('insurance_code', res.insurance_code);
                        set('insurance_gstin', res.insurance_gstin);
                        set('insexpiry', res.insexpiry);
                    } else {
                        $('#insuranceSection').hide();
                    }

                    /* ---------------------------
                     *  DYNAMIC SERVICES
                     * --------------------------- */
                    if (res.services && res.services.length) {
                        res.services.forEach(s => {
                            addRow('service', {
                                name: s.service_name,
                                mrp: s.mrp,
                                discount: s.discount,
                                total: s.total,
                                finalDiscount: s.finalDiscount ?? 0,
                                cgst: s.cgst ?? 0,
                                sgst: s.sgst ?? 0,
                                igst: s.igst ?? 0,
                                isFixed: s.isFixed ?? false
                            });
                        });
                    }

                    /* ---------------------------
                     *  DYNAMIC INVENTORY
                     * --------------------------- */
                    if (res.inventory && res.inventory.length) {
                        res.inventory.forEach(p => {
                            addRow('inventory', {
                                name: p.name,
                                mrp: p.mrp,
                                partNo: p.partNo,
                                hsn: p.hsn,
                                qty: p.qty,
                                cgst: p.cgst,
                                sgst: p.sgst,
                                igst: p.igst,
                                discount: p.discount,
                                finalDiscount: p.finalDiscount ?? 0,
                                total: p.total,
                                isFixed: p.isFixed ?? false
                            });
                        });
                    }

                    $('#jobCardModal').modal('show');
                }
            });
        });

        // -------------------------------
        // DELETE JOB CARD
        // -------------------------------
        $(document).on('click', '.delete-jobcard', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: routes.destroy.replace(':id', id), // use route name
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            Swal.fire('Deleted!', res.message, 'success');
                            jobCardTable.ajax.reload(null, false);
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong!', 'error');
                        }
                    });
                }
            });
        });

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

                <td><input type="number" name="${table}_cgst[]" class="form-control cgst" value="${data.cgst || 0}" readonly ></td>
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

            // Add row
            addRow('service', {
                name: packageName,
                mrp: packagePrice,
                discount: discount,
                taxable: taxableAmount.toFixed(2),
                cgst: cgst,
                sgst: sgst,
                igst: igst,
                tax: taxAmount.toFixed(2),
                total: total.toFixed(2),
                hsn: hsn,
                items: items
            });

            // Reset select
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
                let cgst = parseFloat($(this).find('input[name="service_cgst[]"]').val()) || 0;
                let sgst = parseFloat($(this).find('input[name="service_sgst[]"]').val()) || 0;
                let igst = parseFloat($(this).find('input[name="service_igst[]"]').val()) || 0;
                let discount = parseFloat($(this).find('input[name="service_discount[]"]').val()) || 0;
                let total = parseFloat($(this).find('input[name="service_total[]"]').val()) || 0;
                let finalDiscount = parseFloat($(this).find('input[name="service_final_discount[]"]').val()) || 0;

                if (service_name) {
                    services.push({
                        service_name,
                        mrp,
                        cgst,
                        sgst,
                        igst,
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
            // let formData = new FormData(this);
            // formData.append('services', JSON.stringify(services));
            // formData.append('inventory', JSON.stringify(inventory));

            // Prepare FormData
            let formData = new FormData(this);
            formData.append('services', JSON.stringify(services));
            formData.append('inventory', JSON.stringify(inventory));

            let id = $(this).data('id');

            // Route pattern from Laravel
            let storeUrl = "{{ route('jobcards.store') }}";
            let updateUrl = "{{ route('jobcards.update', ':id') }}";

            let url = id ?
                updateUrl.replace(':id', id) :
                storeUrl;

            // Method spoofing for edit
            if (id) {
                formData.append('_method', 'POST');
            }


            // let id = $(this).data('id'); // For edit
            // let url = id ? `/jobcards/${id}` : "{{ route('jobcards.store') }}";
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
        // OPEN MODAL
        // -------------------------------
        $('#addJobCardBtn').click(function() {
            $('#jobCardForm')[0].reset();
            $('#dynamicInventoryTable tbody').empty();
            $('#jobCardForm').removeData('id');
            $('#jobCardModal').modal('show');
        });



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


@endsection