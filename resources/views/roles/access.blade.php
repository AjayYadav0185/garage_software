@extends('user.dashboard.layout.master')

@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Us') }}
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">{{ translate('Add User') }}</a>
            </div>


            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered" id="userTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Unique') }}</th>
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Email') }}</th>
                                <th>{{ translate('Roles') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.datatable') }}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'user_code'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'role_name'
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>

@endsection