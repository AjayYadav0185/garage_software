@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('Tax Configuration') }}</h4>
                <button class="btn btn-primary" id="addTaxConfigBtn">{{ translate('Add Tax Configuration') }}</button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="taxConfigTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Country') }}</th>
                                <th>{{ translate('Tax System') }}</th>
                                <th>{{ translate('Status') }}</th>
                                <th>{{ translate('Tax Rates') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

{{-- MODAL --}}
<div class="modal fade" id="taxConfigModal">
    <div class="modal-dialog modal-xl">
        <form id="taxConfigForm">
            @csrf
            <input type="hidden" name="id" id="tax_config_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="taxConfigModalTitle">{{ translate('Add Tax Configuration') }}</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ translate('Country') }} <span class="text-danger">*</span></label>
                                <select name="country" class="form-control" required>
                                    <option value="">{{ translate('Select Country') }}</option>
                                    <option value="UAE">UAE</option>
                                    <option value="India">India</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Bahrain">Bahrain</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ translate('Tax System') }} <span class="text-danger">*</span></label>
                                <select name="tax_system" class="form-control" required>
                                    <option value="">{{ translate('Select Tax System') }}</option>
                                    <option value="VAT">VAT (Value Added Tax)</option>
                                    <option value="GST">GST (Goods & Services Tax)</option>
                                    <option value="Sales Tax">Sales Tax</option>
                                    <option value="Excise Tax">Excise Tax</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ translate('Status') }}</label>
                                <select name="is_active" class="form-control">
                                    <option value="1">{{ translate('Active') }}</option>
                                    <option value="0">{{ translate('Inactive') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6>{{ translate('Tax Rates') }}</h6>
                        <button type="button" class="btn btn-sm btn-success" id="addRateBtn">
                            <i class="fas fa-plus"></i> {{ translate('Add Rate') }}
                        </button>
                    </div>

                    <div id="taxRatesContainer">
                        {{-- Tax rates will be added dynamically --}}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="saveTaxConfigBtn" class="btn btn-primary">{{ translate('Save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {
        let rateCounter = 0;

        const routes = {
            ajax: "{{ route('tax-configurations.ajax') }}",
            store: "{{ route('tax-configurations.store') }}",
            edit: "{{ route('tax-configurations.edit', ':id') }}",
            update: "{{ route('tax-configurations.update', ':id') }}",
            destroy: "{{ route('tax-configurations.destroy', ':id') }}"
        };

        // ================= DATATABLE =================
        let table = $('#taxConfigTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: routes.ajax,
            columns: [
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: (d, t, r, m) => m.row + 1
                },
                {
                    data: 'country'
                },
                {
                    data: 'tax_system'
                },
                {
                    data: 'is_active',
                    render: function(data) {
                        return data == 1 
                            ? '<span class="badge badge-success">{{ translate("Active") }}</span>'
                            : '<span class="badge badge-secondary">{{ translate("Inactive") }}</span>';
                    }
                },
                {
                    data: 'tax_rates',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        if(!data || data.length === 0) return 'N/A';
                        
                        let rates = data.map(rate => {
                            let defaultBadge = rate.is_default ? ' <span class="badge badge-primary">Default</span>' : '';
                            return `${rate.tax_type}: ${rate.rate_name} (${rate.rate_percentage}%)${defaultBadge}`;
                        }).join('<br>');
                        
                        return rates;
                    }
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // ================= ADD =================
        $('#addTaxConfigBtn').click(function() {
            $('#taxConfigForm')[0].reset();
            $('#tax_config_id').val('');
            $('#taxRatesContainer').html('');
            rateCounter = 0;
            addTaxRateRow(); // Add one default row
            $('#taxConfigModalTitle').text('{{ translate("Add Tax Configuration") }}');
            $('#saveTaxConfigBtn').text('{{ translate("Save") }}');
            $('#taxConfigModal').modal('show');

            $('#taxConfigForm').off('submit').on('submit', saveTaxConfig);
        });

        // ================= ADD TAX RATE ROW =================
        $('#addRateBtn').click(function() {
            addTaxRateRow();
        });

        function addTaxRateRow(data = null) {
            const html = `
                <div class="card mb-2 rate-row" data-index="${rateCounter}">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <input type="text" 
                                    name="rates[${rateCounter}][tax_type]" 
                                    class="form-control form-control-sm" 
                                    placeholder="{{ translate('Tax Type (e.g., VAT, CGST)') }}" 
                                    value="${data ? data.tax_type : ''}"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <input type="text" 
                                    name="rates[${rateCounter}][rate_name]" 
                                    class="form-control form-control-sm" 
                                    placeholder="{{ translate('Rate Name') }}" 
                                    value="${data ? data.rate_name : ''}"
                                    required>
                            </div>
                            <div class="col-md-2">
                                <input type="number" 
                                    step="0.01" 
                                    name="rates[${rateCounter}][rate_percentage]" 
                                    class="form-control form-control-sm" 
                                    placeholder="{{ translate('Rate %') }}" 
                                    value="${data ? data.rate_percentage : ''}"
                                    required 
                                    min="0" 
                                    max="100">
                            </div>
                            <div class="col-md-3">
                                <select name="rates[${rateCounter}][is_default]" class="form-control form-control-sm">
                                    <option value="0" ${data && !data.is_default ? 'selected' : ''}>{{ translate('Not Default') }}</option>
                                    <option value="1" ${data && data.is_default ? 'selected' : ''}>{{ translate('Default') }}</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-sm remove-rate">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('#taxRatesContainer').append(html);
            rateCounter++;
        }

        // ================= REMOVE TAX RATE ROW =================
        $(document).on('click', '.remove-rate', function() {
            if($('.rate-row').length > 1) {
                $(this).closest('.rate-row').remove();
            } else {
                Swal.fire('{{ translate("Warning") }}', '{{ translate("At least one tax rate is required") }}', 'warning');
            }
        });

        // ================= EDIT =================
        $(document).on('click', '.edit-tax-config', function() {
            let id = $(this).data('id');

            $.get(routes.edit.replace(':id', id), function(data) {
                $('#taxConfigForm')[0].reset();
                $('#tax_config_id').val(data.id);
                $('[name=country]').val(data.country);
                $('[name=tax_system]').val(data.tax_system);
                $('[name=is_active]').val(data.is_active);

                // Clear and populate tax rates
                $('#taxRatesContainer').html('');
                rateCounter = 0;

                if(data.tax_rates && data.tax_rates.length > 0) {
                    data.tax_rates.forEach(function(rate) {
                        addTaxRateRow(rate);
                    });
                } else {
                    addTaxRateRow(); // Add one empty row
                }

                $('#taxConfigModalTitle').text('{{ translate("Edit Tax Configuration") }}');
                $('#saveTaxConfigBtn').text('{{ translate("Update") }}');
                $('#taxConfigModal').modal('show');

                $('#taxConfigForm').off('submit').on('submit', saveTaxConfig);
            });
        });

        // ================= SAVE/UPDATE =================
        function saveTaxConfig(e) {
            e.preventDefault();

            let id = $('#tax_config_id').val();
            let url = id ? routes.update.replace(':id', id) : routes.store;
            let formData = new FormData(this);

            formData.append('_method', id ? 'PUT' : 'POST');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('#taxConfigModal').modal('hide');
                    table.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: res.success,
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    let msg = '';
                    if(errors) {
                        $.each(errors, function(k, v) {
                            msg += v[0] + '\n';
                        });
                    } else {
                        msg = xhr.responseJSON?.message || '{{ translate("Something went wrong") }}';
                    }
                    Swal.fire('{{ translate("Error") }}', msg, 'error');
                }
            });
        }

        // ================= DELETE =================
        $(document).on('click', '.delete-tax-config', function() {
            let id = $(this).data('id');
            
            Swal.fire({
                title: '{{ translate("Are you sure?") }}',
                text: '{{ translate("This will affect all products using this tax configuration!") }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{ translate("Yes, delete it!") }}',
                cancelButtonText: '{{ translate("Cancel") }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: routes.destroy.replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(res) {
                            table.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: res.success,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(xhr) {
                            Swal.fire('{{ translate("Error") }}', xhr.responseJSON?.message || '{{ translate("Something went wrong") }}', 'error');
                        }
                    });
                }
            });
        });

    });
</script>

@endsection