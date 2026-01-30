@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>All Reminders</h4>
                <!-- <button class="btn btn-primary" id="addReminderBtn">Add Reminder</button> -->
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="statusFilter" class="form-label me-2">{{ translate('Filter by Status:') }}</label>
                    <select id="statusFilter" class="form-select form-select-sm w-auto d-inline-block">
                        <option value="">{{ translate('All') }}</option>
                        <option selected ="Service">{{ translate('Service') }}</option>
                        <option value="Insurance">{{ translate('Insurance') }}</option>
                    </select>
                </div>
                 <div class="table-responsive">

                <table class="table table-bordered" id="reminderTable">
                    <thead>
                        <!-- <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Service Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr> -->
                        <tr>
                            <th>#</th>
                            <th>{{ translate('Customer Name') }}</th>
                            <th>{{ translate('Mobile') }}</th>
                            <th>{{ translate('Email') }}</th>
                            <th>{{ translate('Address') }}</th>
                            <th>{{ translate('Car Brand') }}</th>
                            <th>{{ translate('Car Model') }}</th>
                            <th>{{ translate('Fuel Type') }}</th>
                            <th>{{ translate('Registration No') }}</th>
                            <th>{{ translate('Reminder Type') }}</th>
                            <th>{{ translate('Due Expiry') }}</th>
                            <th>{{ translate('Action') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Add/Edit Reminder -->
<div class="modal fade" id="reminderModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="reminderForm">
            @csrf
            <input type="hidden" id="reminder_id" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reminderModalTitle">{{ translate('Add Reminder') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>{{ translate('Name') }}</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>{{ translate('Email') }}</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>{{ translate('Type') }}</label>
                        <select name="reminder_type" class="form-control" required>
                            <option value="">{{ translate('Select Type') }}</option>
                            <option value="service">{{ translate('Service') }}</option>
                            <option value="insurance">{{ translate('Insurance') }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>{{ translate('Service Date') }}</label>
                        <input type="date" name="service_date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">{{ translate('Save Reminder') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(function() {

        var table = $('#reminderTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("reminder.ajax") }}',
            // columns: [{
            //         data: 'id',
            //         name: 'id'
            //     },
            //     {
            //         data: 'name',
            //         name: 'name'
            //     },
            //     {
            //         data: 'email',
            //         name: 'email'
            //     },
            //     {
            //         data: 'reminder_type',
            //         name: 'reminder_type'
            //     },
            //     {
            //         data: 'service_date',
            //         name: 'service_date'
            //     },
            //     {
            //         data: 'is_sent',
            //         name: 'is_sent',
            //         render: function(data) {
            //             return data == 1 ? '<span class="badge bg-success">Sent</span>' : '<span class="badge bg-warning">Pending</span>';
            //         }
            //     },
            //     {
            //         data: 'actions',
            //         name: 'actions',
            //         orderable: false,
            //         searchable: false
            //     }
            // ]
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'contact',
                    name: 'contact'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'carbrand',
                    name: 'carbrand'
                },
                {
                    data: 'carmodel',
                    name: 'carmodel'
                },
                {
                    data: 'fueltype',
                    name: 'fueltype'
                },
                {
                    data: 'registration',
                    name: 'registration'
                },
                {
                    data: 'reminder_type',
                    name: 'reminder_type'
                },
                {
                    data: 'due_date',
                    name: 'due_date'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Open modal for Add
        $('#addReminderBtn').click(function() {
            $('#reminderForm')[0].reset();
            $('#reminder_id').val('');
            $('#reminderModalTitle').text('Add Reminder');
            $('#reminderModal').modal('show');
        });

        // Edit Reminder
        $(document).on('click', '.edit-reminder', function() {
            var id = $(this).data('id');
            $.get('/reminder/' + id + '/edit', function(data) {
                $('#reminder_id').val(data.id);
                $('#reminderForm [name=name]').val(data.name);
                $('#reminderForm [name=email]').val(data.email);
                $('#reminderForm [name=reminder_type]').val(data.reminder_type);
                $('#reminderForm [name=service_date]').val(data.service_date);
                $('#reminderModalTitle').text('Edit Reminder');
                $('#reminderModal').modal('show');
            });
        });

        // Save Reminder (Add/Edit)
        $('#reminderForm').submit(function(e) {
            e.preventDefault();
            var id = $('#reminder_id').val();
            var url = id ? '/reminder/' + id : '{{ route("reminder.store") }}';
            $.ajax({
                url: url,
                type: id ? 'PUT' : 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    $('#reminderModal').modal('hide');
                    table.ajax.reload(null, false);
                    Swal.fire('Success', res.success, 'success');
                },
                error: function(err) {
                    Swal.fire('Error', 'Something went wrong', 'error');
                }
            });
        });

        // Delete Reminder
        $(document).on('click', '.delete-reminder', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This will delete the reminder permanently!",
                icon: 'warning',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/reminder/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            table.ajax.reload(null, false);
                            Swal.fire('Deleted!', res.success, 'success');
                        }
                    });
                }
            });
        });

        // Send Reminder
        $(document).on('click', '.send-reminder', function() {
            var id = $(this).data('id');
            $.post('{{ route("reminder.send") }}', {
                id: id,
                _token: '{{ csrf_token() }}'
            }, function(res) {
                table.ajax.reload(null, false);
                Swal.fire('Sent!', res.message, 'success');
            });
        });


        // -------------------------------
        // Status Filter Dropdown
        // -------------------------------
        $('#statusFilter').on('change', function() {
            var val = $(this).val();
            reminderTable.column(9).search(val).draw(); // Status column index = 5
        });

    });
</script>

@endsection
