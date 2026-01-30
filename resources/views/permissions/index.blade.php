@extends('user.dashboard.layout.master')

@section('user-contant')
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Roles') }}</h4>
                <button class="btn btn-primary" id="addRoleBtn">{{ translate('Add Role') }}</button>
            </div>
            <div class="card-body">
                 <div class="table-responsive">

                <table class="table table-bordered" id="roleTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ translate('Role Name') }}</th>
                            <th>{{ translate('Permissions Count') }}</th>
                            <th>{{ translate('Actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Add/Edit Role -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="roleForm">
            @csrf
            <input type="hidden" name="id" id="role_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleModalTitle">{{ translate('Add Role') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ translate('Role Name') }}</label>
                        <input type="text" name="name" class="form-control" id="role_name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="saveRoleBtn">{{ translate('Save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
        // Show Add Modal
    $('#addRoleBtn').click(function() {
        $('#roleForm')[0].reset();
        $('#role_id').val('');
        $('#roleModalTitle').text('Add Role');
        $('#roleModal').modal('show');
    });

    // DataTable
    var table = $('#roleTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.roles.ajax') }}",
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name' },
            { data: 'permissions_count' },
            { data: 'actions', orderable: false, searchable: false }
        ]
    });

    // Add/Edit Role Submit
    $('#roleForm').submit(function(e) {
        e.preventDefault();
        let id = $('#role_id').val();
        let url = id
            ? "{{ route('roles.update', ':id') }}".replace(':id', id)
            : "{{ route('users.roles.add') }}";

        $.ajax({
            url: url,
            type: id ? 'PUT' : 'POST',
            data: $(this).serialize(),
            success: function(res) {
                $('#roleModal').modal('hide');
                table.ajax.reload(null, false);
                Swal.fire({ icon: 'success', title: res.success, timer: 1500 });
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors || {};
                let msg = '';
                for (let key in errors) msg += errors[key] + "\n";
                Swal.fire({ icon: 'error', title: 'Error', text: msg || xhr.responseJSON.message });
            }
        });
    });

    // Edit Role
    $(document).on('click', '.edit-role', function() {
        let id = $(this).data('id');
        let url = "{{ route('roles.edit', ':id') }}".replace(':id', id);

        $.get(url, function(res) {
            $('#role_id').val(res.id);
            $('#role_name').val(res.name);
            $('#roleModalTitle').text('Edit Role');
            $('#roleModal').modal('show');
        });
    });

    // Delete Role
    $(document).on('click', '.delete-role', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This will delete the role!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = "/users/roles/" + id; // Laravel route name for DELETE could also be used if needed

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        table.ajax.reload(null, false);
                        Swal.fire({ icon: 'success', title: res.success, timer: 1500 });
                    },
                    error: function(xhr) {
                        Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'Unable to delete' });
                    }
                });
            }
        });
    });

});
</script>

@endsection
