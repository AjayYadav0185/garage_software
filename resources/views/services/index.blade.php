@extends('user.dashboard.layout.master')

@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Services') }}</h4>
                <button class="btn btn-primary" id="addServiceBtn">{{ translate('Add Service') }}</button>
            </div>
            <div class="card-body">
                 <div class="table-responsive">

                <table class="table table-bordered" id="servicesTable">
                    <thead>
                        <tr>
                            <th>{{ translate('ID') }}</th>
                            <th>{{ translate('Service Code') }}</th>
                            <th>{{ translate('Service Name') }}</th>
                            <th>{{ translate('Service Price') }}</th>
                            <!--<th>Duration (mins)</th> -->
                            <th>{{ translate('CGST %') }}</th>
                            <th>{{ translate('SGST %') }}</th>
                            <th>{{ translate('IGST %') }}</th>
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


<x-service-modal title="Add Service" />

<script>
    $(function() {

        // Initialize DataTable
        var table = $('#servicesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("services.ajax") }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'service_code',
                    name: 'service_code'
                },
                {
                    data: 'service_name',
                    name: 'service_name'
                },
                {
                    data: 'service_price',
                    name: 'service_price'
                },
                // { data: 'service_duration', name: 'service_duration' },
                {
                    data: 'cgst_percentage',
                    name: 'cgst_percentage'
                },
                {
                    data: 'sgst_percentage',
                    name: 'sgst_percentage'
                },
                {
                    data: 'igst_percentage',
                    name: 'igst_percentage'
                },
                {
                    data: 'service_status',
                    name: 'service_status'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Edit Service
        $(document).on('click', '.edit-service', function() {
            var id = $(this).data('id');
            $.get('/services/' + id + '/edit', function(data) {
                $('#service_id').val(data.id);
                // $('#serviceForm [name=service_code]').val(data.service_code);
                $('#serviceForm [name=service_name]').val(data.service_name);
                $('#serviceForm [name=service_price]').val(data.service_price);
                // $('#serviceForm [name=service_duration]').val(data.service_duration);
                $('#serviceForm [name=cgst_percentage]').val(data.cgst_percentage);
                $('#serviceForm [name=sgst_percentage]').val(data.sgst_percentage);
                $('#serviceForm [name=igst_percentage]').val(data.igst_percentage);
                $('#serviceForm [name=service_description]').val(data.service_description);
                $('#serviceForm [name=service_status]').val(data.service_status);

                $('#serviceModalTitle').text('Edit Service');
                $('#serviceModal').modal('show');
            });
        });


        // Delete Service
        $(document).on('click', '.delete-service', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This will delete the service permanently!",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/services/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            table.ajax.reload(null, false); // Reload DataTable after delete
                            Swal.fire({
                                icon: 'success',
                                title: res.success,
                                timer: 1500
                            });
                        }
                    });
                }
            });
        });
    });
</script>

@endsection
