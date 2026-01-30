<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal for Add/Edit Service -->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="serviceForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="service_id">
            <input type="hidden" name="id" id="service_id">
            <input type="hidden" name="id" id="service_id">
            <input type="hidden" name="id" id="service_id">
            <input type="hidden" name="id" id="service_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalTitle">Add Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <!-- Service Code -->
                            <!-- <div class="form-group col-md-6">
                                <label>Service Code <span class="text-danger">*</span></label>
                                <input type="text" name="service_code" class="form-control" required>
                            </div> -->

                            <!-- Service Name -->
                            <div class="form-group col-md-6">
                                <label>Service Name <span class="text-danger">*</span></label>
                                <input type="text" name="service_name" class="form-control" required>
                            </div>

                            <!-- Service Price -->
                            <div class="form-group col-md-6">
                                <label>Service Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="service_price" class="form-control" required>
                            </div>

                            <!-- Duration -->
                            <!-- <div class="form-group col-md-6">
                                <label>Duration (in minutes) <span class="text-danger">*</span></label>
                                <input type="number" name="service_duration" class="form-control" required>
                            </div> -->

                            <div class="form-group col-md-4">
                                <label>VAT %</label>
                                <input type="number" step="0.01" name="cgst_percentage" class="form-control">
                            </div>

                            <div class="form-group col-md-4" hidden>
                                <label>CGST %</label>
                                <input type="number" step="0.01" name="cgst_percentage" class="form-control">
                            </div>

                            <div class="form-group col-md-4" hidden>
                                <label>SGST %</label>
                                <input type="number" step="0.01" name="sgst_percentage" class="form-control">
                            </div>

                            <div class="form-group col-md-4" hidden>
                                <label>IGST %</label>
                                <input type="number" step="0.01" name="igst_percentage" class="form-control">
                            </div>

                            <!-- Description -->
                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea name="service_description" class="form-control" rows="4"></textarea>
                            </div>

                            <!-- Status -->
                            <div class="form-group col-md-6">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="service_status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="saveServiceBtn">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(function() {

        // Open Add Service Modal
        $('#addServiceBtn').click(function() {
            $('#serviceForm')[0].reset();
            $('#service_id').val('');
            $('#serviceModalTitle').text('Add Service');
            $('#serviceModal').modal('show');
        });

        // Save Service (AJAX Submit)
        $('#serviceForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: $(this).data('url'), // set via JS when opening modal
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire('Success', 'Service saved successfully', 'success');
                    $('#serviceModal').modal('hide');
                    // Pass PHP variable to JS safely
                    let reloadPage = @json($reload); // true or false

                    if (reloadPage) {
                        // Wait a moment so the user sees the Swal
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                    
                    table.ajax.reload(null, false); // Reload DataTable
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
    });
</script>