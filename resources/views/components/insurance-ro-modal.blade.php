<div class="modal fade" id="insuranceRoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="insuranceRoForm">
            @csrf

            <input type="hidden" id="insurance_ro_id">
            <input type="hidden" id="formMethod" value="POST">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insuranceRoModalTitle">
                        Add Insurance RO
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Vehicle</label>
                            <select name="vehicle_id" class="form-control" required>
                                <option value="">Select Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">
                                        {{ $vehicle->registration_no }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Insurance Company</label>
                            <select name="insurance_company_id" class="form-control" required>
                                <option value="">Select Company</option>
                                @foreach($insuranceCompanies as $company)
                                    <option value="{{ $company->id }}">
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>RO Date</label>
                            <input type="date" name="ro_date" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Total Amount</label>
                            <input type="number" step="0.01" name="total_amount" class="form-control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Remarks</label>
                            <textarea name="remarks" class="form-control" rows="3"></textarea>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
