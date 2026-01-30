@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>All Payments</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="paymentsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>JobCard</th>
                                <th>Payment Date</th>
                                <th>Amount</th>
                                <th>Mode</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {

        var table = $('#paymentsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("payment-history.ajax") }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'client',
                    name: 'client'
                },
                {
                    data: 'jobcard',
                    name: 'jobcard'
                },
                {
                    data: 'payment_date',
                    name: 'payment_date'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'mode',
                    name: 'mode'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Delete Payment (route name based)
        $(document).on('click', '.delete-payment', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will delete the payment permanently!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it'
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('payment-history.destroy', ':id') }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            table.ajax.reload(null, false);
                            Swal.fire('Deleted!', res.success ?? 'Payment deleted', 'success');
                        },
                        error: function() {
                            Swal.fire('Error', 'Unable to delete payment', 'error');
                        }
                    });
                }

            });
        });

    });
</script>


@endsection