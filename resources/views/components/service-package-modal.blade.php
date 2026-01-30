<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Modal for Add/Edit Package -->
<div class="modal fade" id="packageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="packageForm">
            @csrf
            <input type="hidden" name="id" id="package_id">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="packageModalTitle">Add Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Package Name <span class="text-danger">*</span></label>
                            <input type="text" name="package" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Package Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="packageprice" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3" hidden>
                        <div class="col-md-6">
                            <label class="form-label">Discount Price</label>
                            <input type="number" value="0" step="0.01" name="discountprice" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stock</label>
                            <input type="number" value="0" name="stock" class="form-control" min="0" value="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Package Description</label>
                        <textarea name="package_desc" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3" hidden>
                        <label class="form-label">HSN Code</label>
                        <input type="text" name="hsncode" class="form-control">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">VAT %</label>
                            <input type="number" step="0.01" name="cgst_percentage" class="form-control" value="5.00">
                        </div>
                        <!-- <div class="col-md-4">
                            <label class="form-label">SGST %</label>
                            <input type="number" step="0.01" name="sgst_percentage" class="form-control" value="0.00">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">IGST %</label>
                            <input type="number" step="0.01" name="igst_percentage" class="form-control" value="0.00">
                        </div> -->
                    </div>

                    <div class="mb-3" hidden>
                        <label class="form-label">Select Inventory Items</label>
                        <div class="row" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                            @foreach($inventory as $item)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="items[]" value="{{ $item['id'] }}" id="item_{{ $item['id'] }}">
                                    <label class="form-check-label" for="item_{{ $item['id'] }}">
                                        {{ $item['part_name'] }} - Stock: {{ $item['stock'] }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-muted">Select items that belong to this package.</small>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="savePackageBtn">
                        <i class="fas fa-save"></i> Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
    $(function() {
        var table = $('#packageTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("servicepackage.ajax") }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'package',
                    name: 'package'
                },
                {
                    data: 'package_desc',
                    name: 'package_desc'
                },
                {
                    data: 'packageprice',
                    name: 'packageprice'
                },
                {
                    data: 'cgst_percentage',
                    name: 'cgst_percentage'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Open Add Package modal
        $('#addPackageBtn').click(function() {
            $('#packageForm')[0].reset();
            $('#package_id').val('');
            $('#packageModalTitle').text('Add Package');
            $('#packageModal').modal('show');
        });



        // ================= DELETE PACKAGE =================
        $(document).on('click', '.delete-package', function() {
            var id = $(this).data('id');
            var url = "{{ route('servicepackage.destroy', ':id') }}".replace(':id', id);

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST', // Laravel expects POST + _method=DELETE
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(res) {
                            table.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: res.success,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(xhr) {
                            Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong', 'error');
                        }
                    });
                }
            });
        });

        $('#packageForm').submit(function(e) {
            e.preventDefault();
            var id = $('#package_id').val();

            var url = id ?
                "{{ route('servicepackage.update', ':id') }}".replace(':id', id) :
                "{{ route('servicepackage.store') }}";

            var form = $(this)[0];
            var formData = new FormData(form);

            // If updating, set _method=PUT
            if (id) {
                formData.append('_method', 'PUT');
            }

            $.ajax({
                url: url,
                type: 'POST', // always POST
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('#packageModal').modal('hide');
                    table.ajax.reload(null, false);

                    // Pass PHP variable to JS safely
                    let reloadPage = @json($reload); // true or false

                    if (reloadPage) {
                        // Wait a moment so the user sees the Swal
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                    
                    Swal.fire({
                        icon: 'success',
                        title: res.success,
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors || {};
                    let message = '';
                    for (let key in errors) {
                        message += errors[key].join('\n') + '\n';
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: message || xhr.responseJSON?.message || 'Something went wrong!'
                    });
                }
            });
        });

    });
</script>