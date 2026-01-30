@extends('user.dashboard.layout.master')

@section('user-contant')

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


<!-- ================== Add/Edit Modal ================== -->
<div class="modal fade" id="expenseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="expenseForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="expenseId">
            <input type="hidden" name="type" id="expenseType">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="expenseModalLabel">{{ translate('Manage Expense') }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <!-- Row 1: Type, Date, Amount -->
                    <div class="row mb-12">
                        <div class="col-md-12">
                            <label class="form-label">{{ translate('Type') }}</label>
                            <select class="form-select" id="expense_type_select" name="type" required>
                                <option value="" selected>{{ translate('Select Type')}}</option>
                                <option value="misc">{{ translate('Misc') }}</option>
                                <option value="salary">{{ translate('Salary') }}</option>
                                <option value="spare">{{ translate('Spare') }}</option>
                                <option value="utility">{{ translate('Utility') }}</option>
                                <option value="sublet">{{ translate('Sublet') }}</option>
                            </select>
                        </div>
                    </div>

                    <div id="typeSpecificFields"></div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> {{ translate('Save') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> {{ translate('Close') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ================== Table ================== -->
<div class="main-content">
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>{{ translate('Expenses') }}</h4>
                <button class="btn btn-primary" id="addExpenseBtn"><i class="bi bi-plus-circle"></i> {{ translate('Manage Expense') }}</button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="me-2">{{ translate('Filter by Type') }}:</label>
                    <select id="typeFilter" class="form-select w-auto d-inline-block">
                        <option value="">{{ translate('All') }}</option>
                        <option value="misc">{{ translate('Misc') }}</option>
                        <option value="salary">{{ translate('Salary') }}</option>
                        <option value="spare">{{ translate('Spare') }}</option>
                        <option value="utility">{{ translate('Utility') }}</option>
                        <option value="sublet">{{ translate('Sublet') }}</option>
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" id="expensesTable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Type') }}</th>
                                <th>{{ translate('Date') }}</th>
                                <th>{{ translate('Amount') }}</th>
                                <th>{{ translate('Description') }}</th>
                                <!-- <th>Vendor / Mechanic</th> -->
                                <th>{{ translate('Payment Status') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(function() {

        const routes = {
            ajax: "{{ route('expenses.ajax') }}",
            store: "{{ route('expenses.store') }}",
            edit: "{{ route('expenses.edit', ':id') }}",
            update: "{{ route('expenses.update', ':id') }}",
            destroy: "{{ route('expenses.destroy', ':id') }}",
        };


        var table = $('#expensesTable').DataTable({
            processing: true,
            serverSide: false, // client-side processing
            ajax: routes.ajax,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'payment_status',
                    name: 'payment_status'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#typeFilter').on('change', function() {
            var val = $(this).val();
            table.column(1).search(val).draw(); // Type column is index 1
        });


        // Add Modal
        $('#addExpenseBtn').click(function() {
            $('#expenseForm')[0].reset();
            $('#expenseId').val('');
            $('#existing_image').html('');
            $('#expenseModalLabel').text('Manage Expense');
            $('#expenseModal').modal('show');
        });


        // ================= TYPE BLOCKS =================
        const blocks = {

            misc: `
                        <div class="expense-block">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <input type="hidden" name="g_id[]" value="{{ session('user') ? session('id') : '' }}">
                                    <label class="form-label">{{ translate('Miscellaneous Date') }}</label>
                                    <input type="date" name="misc_date[]" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Amount') }}</label>
                                    <input type="number" name="misc_amount[]" class="form-control" placeholder="0.00" step="0.01" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Payment Status') }}</label>
                                    <select name="misc_payment_type[]" class="form-select" required>
                                        <option value="">{{ translate('Select') }}</option>
                                        <option>{{ translate('Paid') }}</option>
                                        <option>{{ translate('Due') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Upload Image') }}</label>
                                    <input type="file" name="misc_images[]" accept="image/*" class="form-control" onchange="previewImage(event, this)">
                                    <img class="preview-img" style="display:none;">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ translate('Description') }}</label>
                                    <textarea name="misc_desc[]" class="form-control ckeditor" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        `,

            salary: `
                        <div class="expense-block">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <input type="hidden" name="g_id[]" value="{{ session('user') ? session('id') : '' }}">
                                    <label class="form-label">{{ translate('Salary Date') }}</label>
                                    <input type="date" name="salary_date[]" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Mechanic') }}</label>
                                    <select name="mechanic_name[]" class="form-select" required>
                                        <option value="">{{ translate('Select Mechanic') }}</option>
                                        @foreach($mechanics as $mechanic)
                                            <option value="{{ $mechanic->m_name }}">{{ $mechanic->m_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Amount') }}</label>
                                    <input type="number" name="salary_amount[]" class="form-control" placeholder="0.00" step="0.01" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Payment Status') }}</label>
                                    <select name="salary_payment_type[]" class="form-select" required>
                                        <option value="">{{ translate('Select') }}</option>
                                        <option>{{ translate('Paid') }}</option>
                                        <option>{{ translate('Due') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Upload Image') }}</label>
                                    <input type="file" name="salary_images[]" accept="image/*" class="form-control" onchange="previewImage(event, this)">
                                    <img class="preview-img" style="display:none;">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ translate('Description') }}</label>
                                    <textarea name="salary_desc[]" class="form-control ckeditor" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        `,

            sublet: `
                        <div class="expense-block">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <input type="hidden" name="g_id[]" value="{{ session('user') ? session('id') : '' }}">
                                    <label class="form-label">{{ translate('Vendor Name') }}</label>
                                    <select name="sublet_vendor[]" class="form-select" required>
                                        <option value="">{{ translate('Select Vendor') }}</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{ $vendor->vender_name }}">{{ $vendor->vender_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Sublet Date') }}</label>
                                    <input type="date" name="sublet_date[]" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Amount') }}</label>
                                    <input type="number" name="sublet_amount[]" class="form-control" placeholder="0.00" step="0.01" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Payment Status') }}</label>
                                    <select name="sublet_payment_type[]" class="form-select" required>
                                        <option value="">{{ translate('Select') }}</option>
                                        <option>{{ translate('Paid') }}</option>
                                        <option>{{ translate('Due') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Upload Image') }}</label>
                                    <input type="file" name="sublet_images[]" accept="image/*" class="form-control" onchange="previewImage(event, this)">
                                    <img class="preview-img" style="display:none;">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ translate('Description') }}</label>
                                    <textarea name="sublet_desc[]" class="form-control ckeditor" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        `,

            spare: `
                        <div class="expense-block">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <input type="hidden" name="g_id[]" value="{{ session('user') ? session('id') : '' }}">
                                    <label class="form-label">{{ translate('Vendor Name') }}</label>
                                    <select name="vendor_name[]" class="form-select" required>
                                        <option value="">{{ translate('Select Vendor') }}</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{ $vendor->vender_name }}">{{ $vendor->vender_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Expense Date') }}</label>
                                    <input type="date" name="spare_date[]" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Amount') }}</label>
                                    <input type="number" name="spare_amount[]" class="form-control" placeholder="0.00" step="0.01" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Invoice') }}</label>
                                    <input type="number" name="invoice_number[]" class="form-control" placeholder="Invoice Number" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Payment Status') }}</label>
                                    <select name="payment_status_spare[]" class="form-select" required>
                                        <option value="">{{ translate('Select') }}</option>
                                        <option>{{ translate('Paid') }}</option>
                                        <option>{{ translate('Due') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Upload Image') }}</label>
                                    <input type="file" name="spare_image[]" accept="image/*" class="form-control" onchange="previewImage(event, this)">
                                    <img class="preview-img" style="display:none;">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ translate('Description') }}</label>
                                    <textarea name="spare_desc[]" class="form-control ckeditor" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        `,

            utility: `
                        <div class="expense-block">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Utility Type') }}</label>
                                    <select name="utility_type[]" class="form-select" required>
                                        <option value="">{{ translate('Select') }}</option>
                                        <option>{{ translate('Electricity') }}</option>
                                        <option>{{ translate('Water') }}</option>
                                        <option>{{ translate('Internet') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Expense Date') }}</label>
                                    <input type="date" name="utility_date[]" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Amount') }}</label>
                                    <input type="number" name="utility_amount[]" class="form-control" placeholder="0.00" step="0.01" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Payment Status') }}</label>
                                    <select name="utility_payment_type[]" class="form-select" required>
                                        <option value="">{{ translate('Select') }}</option>
                                        <option>{{ translate('Paid') }}</option>
                                        <option>{{ translate('Due') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ translate('Upload Image') }}</label>
                                    <input type="file" name="utility_images[]" accept="image/*" class="form-control" onchange="previewImage(event, this)">
                                    <img class="preview-img" style="display:none;">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ translate('Description') }}</label>
                                    <textarea name="utility_desc[]" class="form-control ckeditor" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        `
        };


        // ================= HANDLE TYPE CHANGE =================
        $('#expense_type_select').on('change', function() {
            const type = $(this).val();
            $('#typeSpecificFields').html(blocks[type] || '');
        });




        // Form submit
        $('#expenseForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var id = $('#expenseId').val();
            let url = routes.store;

            $.ajax({
                url: url,
                method: id ? 'POST' : 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('#expenseModal').modal('hide');
                    table.ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        title: 'Done',
                        // title: res.success,
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                }

            });
        });




        // Delete Expense
        $('#expensesTable').on('click', '.delete-expense', function() {
            let id = $(this).data('id');
            let type = $(this).data('type');

            let url = routes.destroy.replace(':id', id);

            Swal.fire({
                title: 'Are you sure?',
                text: 'This cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete!'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url + '?type=' + type,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(res) {
                            table.ajax.reload();

                            Swal.fire({
                                icon: 'success',
                                title: res.success,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Delete failed',
                                text: 'Something went wrong'
                            });
                        }
                    });
                }
            });
        });


        // ================= HANDLE EDIT =================
        $('#expensesTable').on('click', '.edit-expense', function() {

            const id = $(this).data('id');
            const type = $(this).data('type');
            // Reset form
            $('#expenseForm')[0].reset();
            // $('#typeSpecificFields').html('');
            $('#typeSpecificFields').html(blocks[type] || '');

            // Set type and load block
            $('#expense_type_select').val(type);
            $('#expense_type_select').trigger('change');

            // Hidden fields
            $('#expenseId').val(id);
            $('#expenseType').val(type);

            // Wait until block is injected
            setTimeout(() => {
                let id = $(this).data('id');
                let type = $(this).data('type');
                let url = routes.edit.replace(':id', id);

                $.get(url, {
                    type: type
                }, function(res) {


                    $('#expenseModalLabel').text('Edit Expense');

                    if (type === 'misc') {

                        $('input[name="misc_date[]"]').val(res.date);
                        $('input[name="misc_amount[]"]').val(res.amount);
                        $('textarea[name="misc_desc[]"]').val(res.description);
                        $('select[name="misc_payment_type[]"]').val(res.payment_status_spare);
                    }

                    if (type === 'salary') {
                        $('input[name="salary_date[]"]').val(res.date);
                        $('input[name="salary_amount[]"]').val(res.amount);
                        $('textarea[name="salary_desc[]"]').val(res.description);
                        $('select[name="salary_payment_type[]"]').val(res.payment_status_spare);
                        $('select[name="mechanic_name[]"]').val(res.vendor_name);
                    }

                    if (type === 'utility') {
                        $('input[name="utility_date[]"]').val(res.date);
                        $('input[name="utility_amount[]"]').val(res.amount);
                        $('textarea[name="utility_desc[]"]').val(res.description);
                        $('select[name="utility_payment_type[]"]').val(res.payment_status_spare);
                        $('select[name="utility_type[]"]').val(res.utility_type);
                    }

                    if (type === 'spare') {
                        $('input[name="spare_date[]"]').val(res.date);
                        $('input[name="spare_amount[]"]').val(res.amount);
                        $('textarea[name="spare_desc[]"]').val(res.description);
                        $('select[name="payment_status_spare[]"]').val(res.payment_status_spare);
                        $('select[name="vendor_name[]"]').val(res.vendor_name);
                        $('input[name="invoice_number[]"]').val(res.invoice_number);

                    }

                    if (type === 'sublet') {
                        $('input[name="sublet_date[]"]').val(res.date);
                        $('input[name="sublet_amount[]"]').val(res.amount);
                        $('textarea[name="sublet_desc[]"]').val(res.description);
                        $('select[name="sublet_payment_type[]"]').val(res.payment_status_spare);
                        $('select[name="sublet_vendor[]"]').val(res.vendor_name);
                    }

                    // Existing image preview
                    if (res.image) {
                        $('#existing_image').html(
                            `<img src="/storage/${res.image}" class="preview-img">`
                        );
                    } else {
                        $('#existing_image').html('');
                    }

                });
            }, 50);

            $('#expenseModal').modal('show');
        });

        function previewImage(event, input) {
            const preview = input.nextElementSibling; // assumes the <img> is right after input
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // show preview
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.style.display = 'none'; // hide preview if no file
            }
        }


    });
</script>
@endsection