@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Mechanics') }}</h4>
                <button class="btn btn-primary" id="addMechanicBtn">{{ translate('Add Mechanic') }}</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="mechanicTable">
                        <thead>
                            <tr>
                                <th>{{ translate('ID') }}</th>
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Mobile') }}</th>
                                <th>{{ translate('Email') }}</th>
                                <th>{{ translate('Status') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Add/Edit Mechanic -->
<div class="modal fade" id="mechanicModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="mechanicForm">
            @csrf
            <input type="hidden" name="id" id="mechanic_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mechanicModalTitle">{{ translate('Add Mechanic') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ translate('Name') }}</label>
                        <input type="text" name="m_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Mobile') }}</label>
                        <input type="text" name="m_mob" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Email') }}</label>
                        <input type="email" name="m_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1">{{ translate('Active') }}</option>
                            <option value="2">{{ translate('Inactive') }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="saveMechanicBtn">{{ translate('Save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function() {

    const routes = {
        ajax: "{{ route('mechanics.ajax') }}",
        store: "{{ route('mechanics.store') }}",
        edit: "{{ route('mechanics.edit', ':id') }}",
        update: "{{ route('mechanics.update', ':id') }}",
        destroy: "{{ route('mechanics.destroy', ':id') }}"
    };

    // ================= DATATABLE =================
    let table = $('#mechanicTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: routes.ajax,
        columns: [
            { data: null, orderable: false, searchable: false, render: (d, t, r, m) => m.row + 1 },
            { data: 'm_name', name: 'm_name' },
            { data: 'm_mob', name: 'm_mob' },
            { data: 'm_email', name: 'm_email' },
            { data: 'status', name: 'status' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ]
    });

    // ================= ADD =================
    $('#addMechanicBtn').click(function() {
        $('#mechanicForm')[0].reset();
        $('#mechanic_id').val('');
        $('#mechanicModalTitle').text('{{ translate("Add Mechanic") }}');
        $('#mechanicModal').modal('show');

        $('#mechanicForm').off('submit').on('submit', submitMechanicForm);
    });

    // ================= EDIT =================
    $(document).on('click', '.edit-mechanic', function() {
        let id = $(this).data('id');
        $.get(routes.edit.replace(':id', id), function(data) {
            $('#mechanicForm')[0].reset();
            $('#mechanic_id').val(data.id);
            $('#mechanicForm [name=m_name]').val(data.m_name);
            $('#mechanicForm [name=m_mob]').val(data.m_mob);
            $('#mechanicForm [name=m_email]').val(data.m_email);
            $('#mechanicForm [name=status]').val(data.status);
            $('#mechanicModalTitle').text('{{ translate("Edit Mechanic") }}');
            $('#mechanicModal').modal('show');

            $('#mechanicForm').off('submit').on('submit', submitMechanicForm);
        });
    });

    // ================= SUBMIT ADD/EDIT =================
    function submitMechanicForm(e) {
        e.preventDefault();
        let id = $('#mechanic_id').val();
        let url = id ? routes.update.replace(':id', id) : routes.store;
        let formData = $(this).serializeArray();
        if(id) formData.push({ name: '_method', value: 'PUT' });

        $.ajax({
            url: url,
            type: 'POST',
            data: $.param(formData),
            success: function(res) {
                $('#mechanicModal').modal('hide');
                table.ajax.reload(null, false);
                Swal.fire({ icon: 'success', title: res.success, showConfirmButton: false, timer: 1500 });
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let message = '';
                for(let key in errors) message += errors[key].join('\n') + '\n';
                Swal.fire({ icon: 'error', title: 'Validation Error', text: message || 'Something went wrong' });
            }
        });
    }

    // ================= DELETE =================
    $(document).on('click', '.delete-mechanic', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: routes.destroy.replace(':id', id),
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}', _method: 'DELETE' },
                    success: function(res){
                        table.ajax.reload(null, false);
                        Swal.fire({ icon: 'success', title: res.success, showConfirmButton: false, timer: 1500 });
                    },
                    error: function(xhr){
                        Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong', 'error');
                    }
                });
            }
        });
    });

});
</script>

@endsection
