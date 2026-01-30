@extends('user.dashboard.layout.master')
@section('user-contant')

<!-- Modal -->
<div class="modal fade" id="roModal" tabindex="-1" aria-labelledby="roModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-sm">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Insurance RO</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">

                <!-- Progress Steps -->
                <div class="progress-steps mb-4 d-flex justify-content-between align-items-center">
                    <div class="step" data-step="1">
                        <div class="step-circle active">1</div>
                        <div class="step-label">Vehicle</div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-circle">2</div>
                        <div class="step-label">Policy</div>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-circle">3</div>
                        <div class="step-label">Insurance</div>
                    </div>
                    <div class="step" data-step="4">
                        <div class="step-circle">4</div>
                        <div class="step-label">Review</div>
                    </div>
                </div>

                <!-- Multi-Step Form -->
                <form id="insuranceRoForm" method="POST" action="{{ route('insurance-ro.store') }}">
                    @csrf
                    <input type="hidden" name="g_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="c_id" value="{{ $new_cid ?? '' }}">
                    <input type="hidden" name="v_id" value="{{ $new_vid ?? '' }}">
                    <input type="hidden" name="uid" value="{{ $new_uid ?? '' }}">
                    <input type="hidden" name="invoice_no" value="{{ $invoice_no ?? '' }}">

                    <!-- Step 1: Vehicle Info -->
                    <div class="step-content active card p-3 mb-3" id="step1">
                        <h5 class="card-title mb-3">Step 1: Vehicle Information</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Registration No</label>
                                <input type="text" name="vehicle_registration" class="form-control" placeholder="Enter registration number" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Car Brand</label>
                                <select name="vehicle_carbrand" class="form-control" required>
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand }}">{{ $brand }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Car Model</label>
                                <select name="vehicle_carmodel" class="form-control" required>
                                    <option value="">Select Model</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-3">
                                <label class="form-label">Fuel Type</label>
                                <select name="vehicle_fueltype" class="form-control" required>
                                    <option value="">Select Fuel</option>
                                    <option value="petrol">Petrol</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="electric">Electric</option>
                                    <option value="hybrid">Hybrid</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Chassis Number</label>
                                <input type="text" name="vehicle_chassis_no" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Engine Number</label>
                                <input type="text" name="vehicle_engine_no" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Odometer Reading</label>
                                <input type="number" name="vehicle_odometer" class="form-control" required>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Policy -->
                    <div class="step-content card p-3 mb-3" id="step2">
                        <h5 class="card-title mb-3">Step 2: Policy Details</h5>
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

                        <div class="mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="prevStep(1)"><i class="bi bi-arrow-left"></i> Previous</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 3: Insurance -->
                    <div class="step-content card p-3 mb-3" id="step3">
                        <h5 class="card-title mb-3">Step 3: Insurance Information</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Insurance Company Name</label>
                                <input type="text" name="insurance_company_name" class="form-control" placeholder="Search Insurance Company..." required>
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
                            <button type="button" class="btn btn-secondary" onclick="prevStep(2)"><i class="bi bi-arrow-left"></i> Previous</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(4)">Next <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 4: Review -->
                    <div class="step-content card p-3 mb-3" id="step4">
                        <h5 class="card-title mb-3">Step 4: Review & Submit</h5>
                        <p class="text-muted">Please review all information before submitting.</p>

                        <div class="mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="prevStep(3)"><i class="bi bi-arrow-left"></i> Previous</button>
                            <button type="submit" class="btn btn-success">Submit Insurance RO <i class="bi bi-check2-circle"></i></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Step Navigation Script -->
<script>
    let currentStep = 1;
    const totalSteps = 4;

    function nextStep(step) {
        showStep(step);
    }

    function prevStep(step) {
        showStep(step);
    }

    function showStep(step) {
        for(let i=1; i<=totalSteps; i++) {
            const el = document.getElementById('step' + i);
            const circle = document.querySelector(`.step[data-step="${i}"] .step-circle`);
            if(i === step) el.classList.add('active');
            else el.classList.remove('active');

            // Update circle checkmarks
            if(i < step) {
                circle.classList.add('completed');
                circle.innerHTML = '<i class="bi bi-check-lg"></i>';
            } else {
                circle.classList.remove('completed');
                circle.innerHTML = i;
            }
        }
        currentStep = step;
    }

    // Initialize
    showStep(1);
</script>

<style>
.step-content { display: none; transition: all 0.3s ease; }
.step-content.active { display: block; }
.card { border-radius: 8px; border: 1px solid #e3e3e3; }
.progress-steps .step { text-align: center; flex: 1; position: relative; }
.progress-steps .step-circle {
    width: 40px; height: 40px; border-radius: 50%; background: #dee2e6; display: flex;
    align-items: center; justify-content: center; margin: 0 auto; font-weight: bold; color: #495057;
}
.progress-steps .step-circle.completed { background: #28a745; color: #fff; }
.progress-steps .step-label { margin-top: 5px; font-size: 0.85rem; color: #495057; }
.progress-steps .step:not(:last-child)::after {
    content: ''; position: absolute; top: 20px; right: -50%; width: 100%; height: 3px; background: #dee2e6; z-index: -1;
}
.progress-steps .step.completed:not(:last-child)::after { background: #28a745; }
</style>

@endsection
