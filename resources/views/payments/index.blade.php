@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Payments') }}</h4>
                <button class="btn btn-primary" id="addPaymentBtn">{{ translate('Add Payment') }}</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="paymentsTable">
                        <thead>
                            <tr>
                                <th>{{ translate('ID') }}</th>
                                <th>{{ translate('Client') }}</th>
                                <th>{{ translate('Payment Date') }}</th>
                                <th>{{ translate('Amount') }}</th>
                                <th>{{ translate('Mode') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<x-payment-modal title="Add Payment" :salesOrders="$salesOrders" />

<script>
    $(function() {
        var table = $('#paymentsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("payments.ajax") }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'order_info',
                    name: 'order_info'
                },
                {
                    data: 'payment_date',
                    name: 'payment_date'
                },
                {
                    data: 'payment_amount',
                    name: 'amount'
                },
                {
                    data: 'payment_mode',
                    name: 'payment_mode'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#addPaymentBtn').click(function() {
            $('#paymentForm')[0].reset();
            $('#payment_id').val('');
            $('#paymentModalTitle').text('Add Payment');
            $('#paymentModal').modal('show');
        });

        $(document).on('click', '.edit-payment', function() {
            let id = $(this).data('id');
            $.get('/payments/' + id + '/edit', function(data) {
                $('#paymentForm')[0].reset();
                $('#payment_id').val(data.id);
                $('#paymentForm [name=client_id]').val(data.client_id);
                $('#paymentForm [name=payment_date]').val(data.payment_date);
                $('#paymentForm [name=amount]').val(data.amount);
                $('#paymentForm [name=payment_mode]').val(data.payment_mode);
                $('#paymentModalTitle').text('Edit Payment');
                $('#paymentModal').modal('show');
            });
        });

        $(document).on('click', '.delete-payment', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will delete the payment permanently!',
                icon: 'warning',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/payments/' + id,
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

        $('#paymentForm').submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.post("{{ route('payments.store') }}", formData, function(res) {
                $('#paymentModal').modal('hide');
                table.ajax.reload(null, false);
                Swal.fire('Success', res.success, 'success');
            }).fail(function() {
                Swal.fire('Error', 'Please check inputs!', 'error');
            });
        });

    });
</script>

@endsection
