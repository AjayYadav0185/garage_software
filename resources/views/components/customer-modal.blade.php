{{-- Add / Edit Modal --}}
<div class="modal fade" id="customerModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="customerForm">
            @csrf
            <input type="hidden" id="customer_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="customerModalTitle">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="cus_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="cus_mob" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="cus_email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Tax Number</label>
                        <input type="text" name="c_gst" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="c_add" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">
                        Save
                    </button>
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">
                        Close
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {

        /* ===================== ROUTES ===================== */
        const routes = {
            ajax: "{{ route('customers.ajax') }}",
            store: "{{ route('customers.store') }}",
            edit: "{{ route('customers.edit', ':id') }}",
            update: "{{ route('customers.update', ':id') }}",
            destroy: "{{ route('customers.destroy', ':id') }}"
        };

        /* ===================== DATATABLE ===================== */
        let table = $('#customerTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: routes.ajax,
            columns: [{
                    data: 'id'
                },
                {
                    data: 'cus_name'
                },
                {
                    data: 'cus_mob'
                },
                {
                    data: 'cus_email'
                },
                {
                    data: 'c_gst'
                },
                {
                    data: 'c_add'
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        /* ===================== ADD ===================== */
        $('#addCustomerBtn').on('click', function() {
            $('#customerForm')[0].reset();
            $('#customer_id').val('');
            $('#customerModalTitle').text('Add Customer');
            $('#customerModal').modal('show');
        });

        /* ===================== STORE / UPDATE ===================== */
        $('#customerForm').on('submit', function(e) {
            e.preventDefault();

            let id = $('#customer_id').val();
            let url = id ? routes.update.replace(':id', id) : routes.store;
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                success: function(res) {
                    $('#customerModal').modal('hide');
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
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: xhr.responseJSON?.message ?? 'Something went wrong'
                    });
                }
            });
        });

        /* ===================== EDIT ===================== */
        $(document).on('click', '.edit-customer', function() {
            let id = $(this).data('id');
            let url = routes.edit.replace(':id', id);

            $.get(url, function(data) {
                $('#customer_id').val(data.id);
                $('[name=cus_name]').val(data.cus_name);
                $('[name=cus_mob]').val(data.cus_mob);
                $('[name=cus_email]').val(data.cus_email);
                $('[name=c_gst]').val(data.c_gst);
                $('[name=c_add]').val(data.c_add);

                $('#customerModalTitle').text('Edit Customer');
                $('#customerModal').modal('show');
            });
        });

        /* ===================== DELETE ===================== */
        $(document).on('click', '.delete-customer', function() {
            let id = $(this).data('id');
            let url = routes.destroy.replace(':id', id);

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            table.ajax.reload(null, false);

                            Swal.fire({
                                icon: 'success',
                                title: res.success,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        });

    });
</script>