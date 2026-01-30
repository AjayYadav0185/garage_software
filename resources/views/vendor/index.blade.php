@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Vendors') }}</h4>
                <button class="btn btn-primary" id="addVendorBtn">{{ translate('Add Vendor') }}</button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="vendorTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Contact') }}</th>
                                <th>{{ translate('TAX Number') }}</th>
                                <!-- <th>{{ translate('Image') }}</th> -->
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

{{-- MODAL --}}
<div class="modal fade" id="vendorModal">
    <div class="modal-dialog">
        <form id="vendorForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="vendor_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="vendorModalTitle">{{ translate('Add Vendor') }}</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ translate('Vendor Name') }}</label>
                        <input type="text" name="vender_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>{{ translate('Contact Info') }}</label>
                        <input type="text" name="contact_info" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>{{ translate('Vendor Image') }}</label>
                        <input type="file" name="vendor_image" class="form-control">
                        <img id="previewImage" class="mt-2" style="width:80px; display:none;">
                    </div>

                    <div class="form-group">
                        <label>{{ translate('Description') }}</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>{{ translate('TAX Number') }}</label>
                        <input type="text" name="vendor_gst_number" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="addVendorSubmit" class="btn btn-primary">{{ translate('Save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {

        const routes = {
            ajax: "{{ route('vendors.ajax') }}",
            store: "{{ route('vendors.store') }}",
            edit: "{{ route('vendors.edit', ':id') }}",
            update: "{{ route('vendors.update', ':id') }}",
            destroy: "{{ route('vendors.destroy', ':id') }}"
        };

        // ================= DATATABLE =================
        let table = $('#vendorTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: routes.ajax,
            columns: [{
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: (d, t, r, m) => m.row + 1
                },
                {
                    data: 'vender_name'
                },
                {
                    data: 'contact_info'
                },
                {
                    data: 'vendor_gst_number'
                },
                // {
                //     data: 'vendor_image',
                //     orderable: false,
                //     searchable: false,
                //     render: d => d ? `<img src="/storage/${d}" width="50">` : 'N/A'
                // },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // ================= ADD =================
        $('#addVendorBtn').click(function() {
            $('#vendorForm')[0].reset();
            $('#vendor_id').val('');
            $('#previewImage').hide();
            $('#vendorModalTitle').text('{{ translate("Add Vendor") }}');
            $('#addVendorSubmit').show().text('{{ translate("Save") }}');
            $('#vendorModal').modal('show');

            // Unbind previous submit
            // $('#vendorForm').off('submit').on('submit', addVendor);
            $('#vendorForm').off('submit').on('submit', updateVendor);
        });


        // ================= EDIT =================
        $(document).on('click', '.edit-vendor', function() {
            let id = $(this).data('id');

            $.get(routes.edit.replace(':id', id), function(data) {
                $('#vendorForm')[0].reset();
                $('#vendor_id').val(data.vendor_id);
                $('[name=vender_name]').val(data.vender_name);
                $('[name=contact_info]').val(data.contact_info);
                $('[name=description]').val(data.description);
                $('[name=vendor_gst_number]').val(data.vendor_gst_number);

                if (data.vendor_image) $('#previewImage').attr('src', '/storage/' + data.vendor_image).show();
                else $('#previewImage').hide();

                $('#vendorModalTitle').text('{{ translate("Edit Vendor") }}');
                $('#addVendorSubmit').show().text('{{ translate("Update") }}');
                $('#vendorModal').modal('show');

                // Unbind previous submit
                $('#vendorForm').off('submit').on('submit', updateVendor);
            });
        });

        function updateVendor(e) {
            e.preventDefault();

            let id = $('#vendor_id').val();
            let url = id ? routes.update.replace(':id', id) : routes.store;
            let formData = new FormData(this);

            formData.append('_method', id ? 'PUT' : 'POST');

            $.ajax({
                url: url,
                type: 'POST', // always POST
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('#vendorModal').modal('hide');
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

        // ================= DELETE =================
        $(document).on('click', '.delete-vendor', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: routes.destroy.replace(':id', id),
                        type: 'POST',
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

        // ================= IMAGE PREVIEW =================
        $('[name="vendor_image"]').on('change', function() {
            let reader = new FileReader();
            reader.onload = e => $('#previewImage').attr('src', e.target.result).show();
            reader.readAsDataURL(this.files[0]);
        });

    });
</script>

@endsection