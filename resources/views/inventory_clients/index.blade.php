@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Clients') }}</h4>
                <button class="btn btn-primary" id="addClientBtn">{{ translate('Add Client') }}</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
v
                    <table class="table table-bordered" id="clientTable">
                        <thead>
                            <tr>
                                <th>{{ translate('ID') }}</th>
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Email') }}</th>
                                <th>{{ translate('Mobile') }}</th>
                                <th>{{ translate('Address') }}</th>
                                <th>{{ translate('TAX') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<x-client-modal title="Add Client" />

<script>
    $(function() {
        var table = $('#clientTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("clients.ajax") }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'gst_number',
                    name: 'gst_number'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#addClientBtn').click(function() {
            $('#clientForm')[0].reset();
            $('#client_id').val('');
            $('#clientModalTitle').text('Add Client');
            $('#clientModal').modal('show');
        });

        $(document).on('click', '.edit-client', function() {
            let id = $(this).data('id');
            $.get('/clients/' + id + '/edit', function(data) {
                $('#clientForm')[0].reset();
                $('#client_id').val(data.id);
                $('#clientForm [name=name]').val(data.name);
                $('#clientForm [name=email]').val(data.email);
                $('#clientForm [name=mobile]').val(data.mobile);
                $('#clientForm [name=address]').val(data.address);
                $('#clientForm [name=gst_number]').val(data.gst_number);
                $('#clientModalTitle').text('Edit Client');
                $('#clientModal').modal('show');
            });
        });

        $(document).on('click', '.delete-client', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will delete the client permanently!',
                icon: 'warning',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/clients/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function(res) {
                            table.ajax.reload(null, false);
                            Swal.fire('Success', res.success, 'success');
                        }
                    });
                }
            });
        });

        $('#clientForm').submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.post("{{ route('clients.store') }}", formData, function(res) {
                $('#clientModal').modal('hide');
                table.ajax.reload(null, false);
                Swal.fire('Success', res.success, 'success');
            }).fail(function() {
                Swal.fire('Error', 'Please check your inputs!', 'error');
            });
        });
    });
</script>

@endsection
