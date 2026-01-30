@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h4>Insurance Companies</h4>
                <button class="btn btn-primary" id="addInsuranceBtn">Add Insurance</button>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="insuranceTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Tax No</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </section>
</div>

{{-- MODAL --}}
<div class="modal fade" id="insuranceModal">
    <div class="modal-dialog">
        <form id="insuranceForm">
            @csrf
            <input type="hidden" id="insurance_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalTitle">Add Insurance</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-2" name="insurence_company_name" placeholder="Company Name" required>
                    <input class="form-control mb-2" name="insurence_company_number" placeholder="Contact Number">
                    <input class="form-control mb-2" name="insurence_email_address" placeholder="Email">
                    <input class="form-control mb-2" name="insurence_tax_number" placeholder="Tax Number">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {

        /* ================= ROUTES ================= */
        const routes = {
            ajax: "{{ route('insurence.ajax') }}",
            store: "{{ route('insurence.store') }}",
            edit: "{{ route('insurence.edit', ':id') }}",
            update: "{{ route('insurence.update', ':id') }}",
            destroy: "{{ route('insurence.destroy', ':id') }}"
        };

        /* ================= DATATABLE ================= */
        let table = $('#insuranceTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: routes.ajax,
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'insurence_company_name'
                },
                {
                    data: 'insurence_company_number'
                },
                {
                    data: 'insurence_email_address'
                },
                {
                    data: 'insurence_tax_number'
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        /* ================= ADD ================= */
        $('#addInsuranceBtn').on('click', function() {
            $('#insuranceForm')[0].reset();
            $('#insurance_id').val('');
            $('#modalTitle').text('Add Insurance');
            $('#insuranceModal').modal('show');
        });

        /* ================= STORE / UPDATE ================= */
        $('#insuranceForm').on('submit', function(e) {
            e.preventDefault();

            let id = $('#insurance_id').val();
            let url = id ? routes.update.replace(':id', id) : routes.store;
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                success: function(res) {
                    $('#insuranceModal').modal('hide');
                    table.ajax.reload(null, false);

                    Swal.fire({
                        icon: 'success',
                        title: res.success,
                        timer: 1500,
                        showConfirmButton: false
                    });
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

        /* ================= EDIT ================= */
        $(document).on('click', '.edit-insurence', function() {
            let id = $(this).data('id');
            let url = routes.edit.replace(':id', id);

            $.get(url, function(data) {
                $('#insurance_id').val(data.id);
                $('[name=insurence_company_name]').val(data.insurence_company_name);
                $('[name=insurence_company_number]').val(data.insurence_company_number);
                $('[name=insurence_email_address]').val(data.insurence_email_address);
                $('[name=insurence_tax_number]').val(data.insurence_tax_number);

                $('#modalTitle').text('Edit Insurance');
                $('#insuranceModal').modal('show');
            });
        });

        /* ================= DELETE ================= */
        $(document).on('click', '.delete-insurence', function() {
            let id = $(this).data('id');
            let url = routes.destroy.replace(':id', id);

            Swal.fire({
                title: 'Delete this record?',
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
@endsection