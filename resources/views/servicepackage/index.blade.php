@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ translate('All Service Packages') }}</h4>
                <button class="btn btn-primary" id="addPackageBtn">
                    <i class="fas fa-plus"></i> {{ translate('Add Package') }}
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-hover table-bordered" id="packageTable">
                        <thead class="table-light">
                            <tr>
                                <th>{{ translate('ID') }}</th>
                                <th>{{ translate('Package Name') }}</th>
                                <th>{{ translate('Package Description') }}</th>
                                <th>{{ translate('Price') }}</th>
                                <th>{{ translate('Tax') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>


<x-service-package-modal title="Add Service Package" />

<script>
    $(function() {
    

        // ================= EDIT PACKAGE =================
        $(document).on('click', '.edit-package', function() {
            var id = $(this).data('id');
            var url = "{{ route('servicepackage.edit', ':id') }}".replace(':id', id);

            $.get(url, function(details) {
                // console.log(data.data)
                var data = details.data
                $('#packageForm')[0].reset(); // reset first
                $('#package_id').val(data.id);
                $('#packageForm [name=package]').val(data.package);
                $('#packageForm [name=packageprice]').val(data.packageprice);
                $('#packageForm [name=discountprice]').val(data.discountprice);
                $('#packageForm [name=package_desc]').val(data.package_desc);
                $('#packageForm [name=hsncode]').val(data.hsncode);
                $('#packageForm [name=stock]').val(data.stock);
                $('#packageForm [name=cgst_percentage]').val(data.cgst_percentage);
                $('#packageForm [name=sgst_percentage]').val(data.sgst_percentage);
                $('#packageForm [name=igst_percentage]').val(data.igst_percentage);

                // ✅ Uncheck all checkboxes first
                $('#packageForm input[name="items[]"]').prop('checked', false);

                // ✅ Check the items belonging to this package
                if (data.items && Array.isArray(data.items)) {
                    data.items.forEach(function(item) {
                        $('#item_' + item.id).prop('checked', true);
                    });
                }

                $('#packageModalTitle').text('Edit Package');
                $('#packageModal').modal('show');
            });
        });


    });
</script>

@endsection