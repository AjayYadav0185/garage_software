<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal for Add/Edit Inventory -->
<div class="modal fade" id="inventoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="inventoryForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="inventory_id">
            <!-- Hidden fields to send percentage values -->
            <input type="hidden" name="vat_percentage" id="vatPercentage" value="5.00">
            <!-- <input type="hidden" name="cgst_percentage" id="cgstPercentage" value="5.00"> -->
            <input type="hidden" name="sgst_percentage" id="sgstPercentage">
            <input type="hidden" name="igst_percentage" id="igstPercentage">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inventoryModalTitle">Add Inventory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Product Name -->
                            <div class="form-group col-md-6">
                                <label>Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="Product" class="form-control" required>
                            </div>

                            <!-- Photo Upload -->
                            <div class="form-group col-md-6">
                                <label>Photo</label>
                                <input type="file" name="Photo" class="form-control" accept="image/*">
                                <img id="photoPreview" src="" style="width:80px; margin-top:10px; display:none;">
                            </div>

                            <!-- Part Number -->
                            <div class="form-group col-md-6">
                                <label>Part Number</label>
                                <input type="text" name="PartNumber" class="form-control">
                            </div>

                            <!-- Category -->
                            <div class="form-group col-md-6">
                                <label>Category <span class="text-danger">*</span></label>
                                <select name="Category" class="form-control" required>
                                    <option value="">--Select Category--</option>
                                    <option value="Internal">Internal</option>
                                    <option value="External">External</option>
                                    <option value="Spare Part">Spare Part</option>
                                    <option value="Accessory">Accessory</option>
                                    <option value="Consumable">Consumable</option>
                                </select>
                            </div>

                            <!-- Unit Type -->
                            <div class="form-group col-md-6">
                                <label>Unit Type</label>
                                <select name="UnitType" class="form-control">
                                    <option value="PCS">PCS</option>
                                    <option value="SET">SET</option>
                                    <option value="PAIR">PAIR</option>
                                    <option value="LITRE">LITRE</option>
                                    <option value="KG">KG</option>
                                </select>
                            </div>

                            <!-- Stock -->
                            <div class="form-group col-md-6">
                                <label>Stock <span class="text-danger">*</span></label>
                                <input type="number" name="Stock" class="form-control" required min="0">
                            </div>

                            <!-- Minimum Stock -->
                            <div class="form-group col-md-6">
                                <label>Minimum Stock</label>
                                <input type="number" name="MinStock" class="form-control" min="0" placeholder="Optional">
                            </div>

                            <!-- Cost Price -->
                            <div class="form-group col-md-6">
                                <label>Cost Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="CostPrice" class="form-control" required>
                            </div>

                            <!-- Sale Price -->
                            <div class="form-group col-md-6">
                                <label>Sale Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="SalePrice" id="salePrice" class="form-control" required>
                            </div>

                            <!-- Location -->
                            <div class="form-group col-md-6">
                                <label>Location</label>
                                <input type="text" name="Location" class="form-control">
                            </div>

                            <!-- Tax Country -->
                            <div class="form-group col-md-6" hidden>
                                <label>Tax Country <span class="text-danger">*</span></label>
                                <select name="tax_configuration_id" id="taxCountrySelect" class="form-control" required>
                                    <option value="">-- Select Country --</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label">VAT %</label>
                                <input type="number" step="0.01" value="5.00" name="cgst_percentage" class="form-control">
                            </div>

                            <div hidden>

                                <!-- Hidden field to store tax system -->
                                <input type="hidden" name="tax_system" id="taxSystem">

                                <!-- For VAT Countries (single rate) -->
                                <div class="form-group col-md-6" id="vatRateContainer" style="display:none;">
                                    <label>VAT Rate <span class="text-danger">*</span></label>
                                    <select name="vat_rate_id" id="vatRateSelect" class="form-control">
                                        <option value="">-- Select VAT Rate --</option>
                                    </select>
                                </div>

                                <!-- For GST - Show all 3 fields -->
                                <div class="form-group col-md-4 gst-fields" style="display:none;">
                                    <label>CGST %</label>
                                    <select name="cgst_rate_id" id="cgstRateSelect" class="form-control">
                                        <option value="">-- Select --</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4 gst-fields" style="display:none;">
                                    <label>SGST %</label>
                                    <select name="sgst_rate_id" id="sgstRateSelect" class="form-control">
                                        <option value="">-- Select --</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4 gst-fields" style="display:none;">
                                    <label>IGST %</label>
                                    <select name="igst_rate_id" id="igstRateSelect" class="form-control">
                                        <option value="">-- Select --</option>
                                    </select>
                                </div>

                                <!-- Tax Preview -->
                                <div class="form-group col-md-12">
                                    <div class="alert alert-info" id="taxPreview" style="display:none;">
                                        <strong><i class="fas fa-calculator"></i> Tax Breakdown:</strong>
                                        <div id="taxBreakdownContent" class="mt-2"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="saveInventoryBtn">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(function() {

        var table = $('#inventoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("inventory.ajax") }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'Product',
                    name: 'Product'
                },
                {
                    data: 'Photo',
                    name: 'Photo'
                },
                {
                    data: 'PartNumber',
                    name: 'PartNumber'
                },
                {
                    data: 'Category',
                    name: 'Category'
                },
                {
                    data: 'Location',
                    name: 'Location'
                },
                {
                    data: 'Stock',
                    name: 'Stock'
                },
                {
                    data: 'CostPrice',
                    name: 'CostPrice'
                },
                {
                    data: 'SalePrice',
                    name: 'SalePrice'
                },
                {
                    data: 'cgst_percentage',
                    name: 'cgst_percentage'
                },
                // {data: 'cgst_percentage', name: 'cgst_percentage'},
                // {data: 'sgst_percentage', name: 'sgst_percentage'},
                // {data: 'igst_percentage', name: 'igst_percentage'},
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });


        // Named routes
        const routes = {
            store: "{{ route('inventory.store') }}",
            edit: "{{ route('inventory.edit', ':id') }}",
            taxEdit: "{{ route('tax-configurations.edit', ':id') }}",
            destroy: "{{ route('inventory.destroy', ':id') }}",
            taxConfigs: "{{ route('tax-configurations.active') }}"
        };

        let currentTaxSystem = '';

        // Load Tax Countries on page load
        loadTaxCountries();

        function loadTaxCountries() {
            $.get(routes.taxConfigs, function(data) {
                let html = '<option value="">-- Select Country --</option>';

                data.forEach(function(config) {
                    html += `<option value="${config.id}" data-tax-system="${config.tax_system}">
                        ${config.country} (${config.tax_system})
                     </option>`;
                });

                $('#taxCountrySelect').html(html);

                // ✅ Auto-select and trigger change if only 1 record exists
                if (data.length === 1) {
                    const onlyConfigId = data[0].id;
                    const onlyTaxSystem = data[0].tax_system;

                    // Set value manually
                    $('#taxCountrySelect').val(onlyConfigId);

                    // Set currentTaxSystem manually before AJAX
                    currentTaxSystem = onlyTaxSystem;
                    $('#taxSystem').val(onlyTaxSystem);

                    // Call the same code as in change handler directly
                    loadTaxRatesForCountry(onlyConfigId, onlyTaxSystem);
                }
            }).fail(function() {
                console.error('Failed to load tax configurations');
                $('#taxCountrySelect').html('<option value="">No tax configurations available</option>');
            });
        }

        // Extracted function to load tax rates
        function loadTaxRatesForCountry(configId, taxSystem) {
            resetTaxFields();
            $('#taxPreview').hide();

            if (!configId) return;

            $.get(routes.taxEdit.replace(':id', configId), function(data) {
                if (taxSystem === 'GST') {
                    setupGSTFields(data.tax_rates);
                } else if (taxSystem === 'VAT') {
                    setupVATFields(data.tax_rates);
                }
            }).fail(function() {
                Swal.fire('Error', 'Failed to load tax rates', 'error');
            });
        }

        // Handle Country Selection
        $('#taxCountrySelect').change(function() {
            const configId = $(this).val();
            const taxSystem = $(this).find('option:selected').data('tax-system');

            currentTaxSystem = taxSystem;
            $('#taxSystem').val(taxSystem);

            loadTaxRatesForCountry(configId, taxSystem);
        });

        // Setup GST Fields (India) - Show all 3
        function setupGSTFields(rates) {
            $('.gst-fields').show();

            // Populate CGST rates
            let cgstRates = rates.filter(r => r.tax_type === 'CGST');
            let cgstHtml = '<option value="">-- Select --</option>';
            cgstRates.forEach(function(rate) {
                cgstHtml += `<option value="${rate.id}" data-percentage="${rate.rate_percentage}">${rate.rate_name} (${rate.rate_percentage}%)</option>`;
            });
            $('#cgstRateSelect').html(cgstHtml);

            // Populate SGST rates
            let sgstRates = rates.filter(r => r.tax_type === 'SGST');
            let sgstHtml = '<option value="">-- Select --</option>';
            sgstRates.forEach(function(rate) {
                sgstHtml += `<option value="${rate.id}" data-percentage="${rate.rate_percentage}">${rate.rate_name} (${rate.rate_percentage}%)</option>`;
            });
            $('#sgstRateSelect').html(sgstHtml);

            // Populate IGST rates
            let igstRates = rates.filter(r => r.tax_type === 'IGST');
            let igstHtml = '<option value="">-- Select --</option>';
            igstRates.forEach(function(rate) {
                igstHtml += `<option value="${rate.id}" data-percentage="${rate.rate_percentage}">${rate.rate_name} (${rate.rate_percentage}%)</option>`;
            });
            $('#igstRateSelect').html(igstHtml);
        }

        // Setup VAT Fields (UAE, Saudi, etc.)
        function setupVATFields(rates) {
            $('#vatRateContainer').show();
            $('#vatRateSelect').prop('required', true);

            let vatHtml = '<option value="">-- Select VAT Rate --</option>';
            rates.forEach(function(rate) {
                let defaultLabel = rate.is_default ? ' (Default)' : '';
                vatHtml += `<option value="${rate.id}" data-percentage="${rate.rate_percentage}" ${rate.is_default ? 'selected' : ''}>${rate.rate_name} (${rate.rate_percentage}%)${defaultLabel}</option>`;
            });
            $('#vatRateSelect').html(vatHtml);

            // Trigger change to calculate tax
            $('#vatRateSelect').trigger('change');
        }

        function resetTaxFields() {
            $('.gst-fields, #vatRateContainer').hide();
            // $('#cgstRateSelect, #sgstRateSelect, #igstRateSelect, #vatRateSelect').val('');
            $('#cgstRateSelect, #sgstRateSelect, #igstRateSelect, #vatRateSelect').val('').prop('required', false);
            // $('#vatPercentage, #cgstPercentage, #sgstPercentage, #igstPercentage').val('');
            currentTaxSystem = '';
        }

        $('#vatRateSelect').on('change', function() {
            let percent = $(this).find('option:selected').data('percentage') || '';
            $('#vatPercentage').val(percent);
            calculateTaxPreview();
        });


        $('#cgstRateSelect').on('change', function() {
            let percent = $(this).find('option:selected').data('percentage') || '';
            $('#cgstPercentage').val(percent);
            calculateTaxPreview();
        });

        $('#sgstRateSelect').on('change', function() {
            let percent = $(this).find('option:selected').data('percentage') || '';
            $('#sgstPercentage').val(percent);
            calculateTaxPreview();
        });

        $('#igstRateSelect').on('change', function() {
            let percent = $(this).find('option:selected').data('percentage') || '';
            $('#igstPercentage').val(percent);
            calculateTaxPreview();
        });


        // Reset all tax fields
        // function resetTaxFields() {
        //     $('.gst-fields, #vatRateContainer').hide();
        //     $('#cgstRateSelect, #sgstRateSelect, #igstRateSelect, #vatRateSelect').val('').prop('required', false);
        //     currentTaxSystem = '';
        // }

        // Calculate and show tax preview
        $('#salePrice, #vatRateSelect, #cgstRateSelect, #sgstRateSelect, #igstRateSelect').on('change keyup', function() {
            calculateTaxPreview();
        });

        function calculateTaxPreview() {
            let price = parseFloat($('#salePrice').val()) || 0;

            if (!price) {
                $('#taxPreview').hide();
                return;
            }

            let breakdown = '';
            let totalTax = 0;

            if (currentTaxSystem === 'VAT') {
                // VAT Calculation
                let vatPercentage = parseFloat($('#vatRateSelect option:selected').data('percentage')) || 0;
                let vatAmount = (price * vatPercentage) / 100;
                totalTax = vatAmount;

                breakdown = `
                    <div class="row">
                        <div class="col-6">Base Price:</div>
                        <div class="col-6 text-right"><strong>₹${price.toFixed(2)}</strong></div>
                        
                        <div class="col-6">VAT (${vatPercentage}%):</div>
                        <div class="col-6 text-right"><strong>₹${vatAmount.toFixed(2)}</strong></div>
                        
                        <div class="col-12"><hr class="my-2"></div>
                        
                        <div class="col-6"><strong>Total Price:</strong></div>
                        <div class="col-6 text-right"><strong class="text-primary">₹${(price + totalTax).toFixed(2)}</strong></div>
                    </div>
                `;

            } else if (currentTaxSystem === 'GST') {
                // GST Calculation - Calculate whichever fields are filled
                let cgstPercentage = parseFloat($('#cgstRateSelect option:selected').data('percentage')) || 0;
                let sgstPercentage = parseFloat($('#sgstRateSelect option:selected').data('percentage')) || 0;
                let igstPercentage = parseFloat($('#igstRateSelect option:selected').data('percentage')) || 0;

                let cgstAmount = cgstPercentage ? (price * cgstPercentage) / 100 : 0;
                let sgstAmount = sgstPercentage ? (price * sgstPercentage) / 100 : 0;
                let igstAmount = igstPercentage ? (price * igstPercentage) / 100 : 0;

                totalTax = cgstAmount + sgstAmount + igstAmount;

                breakdown = `<div class="row">
                    <div class="col-6">Base Price:</div>
                    <div class="col-6 text-right"><strong>₹${price.toFixed(2)}</strong></div>`;

                if (cgstAmount > 0) {
                    breakdown += `
                        <div class="col-6">CGST (${cgstPercentage}%):</div>
                        <div class="col-6 text-right"><strong>₹${cgstAmount.toFixed(2)}</strong></div>`;
                }

                if (sgstAmount > 0) {
                    breakdown += `
                        <div class="col-6">SGST (${sgstPercentage}%):</div>
                        <div class="col-6 text-right"><strong>₹${sgstAmount.toFixed(2)}</strong></div>`;
                }

                if (igstAmount > 0) {
                    breakdown += `
                        <div class="col-6">IGST (${igstPercentage}%):</div>
                        <div class="col-6 text-right"><strong>₹${igstAmount.toFixed(2)}</strong></div>`;
                }

                if (totalTax > 0) {
                    breakdown += `
                        <div class="col-6">Total GST:</div>
                        <div class="col-6 text-right"><strong>₹${totalTax.toFixed(2)}</strong></div>`;
                }

                breakdown += `
                    <div class="col-12"><hr class="my-2"></div>
                    <div class="col-6"><strong>Total Price:</strong></div>
                    <div class="col-6 text-right"><strong class="text-primary">₹${(price + totalTax).toFixed(2)}</strong></div>
                </div>`;
            }

            if (breakdown) {
                $('#taxBreakdownContent').html(breakdown);
                $('#taxPreview').slideDown();
            } else {
                $('#taxPreview').slideUp();
            }
        }

        // Open Add Inventory Modal
        $('#addInventoryBtn').click(function() {
            $('#inventoryForm')[0].reset();
            $('#inventory_id').val('');
            $('#photoPreview').hide();
            $('#taxPreview').hide();
            resetTaxFields();
            $('#inventoryModalTitle').text('Add Inventory');
            // $('#inventoryForm').data('url', routes.store);
            $('#inventoryModal').modal('show');

            loadTaxCountries();
        });

        // Photo Preview
        $('input[name="Photo"]').change(function(e) {
            if (this.files && this.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#photoPreview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#inventoryForm').off('submit').on('submit', function(e) {
            e.preventDefault();
            let id = parseInt($('#inventory_id').val()) || null;
            let url = routes.store;

            let formData = new FormData(this);

            console.log('here');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire('Success', res.success || 'Inventory saved', 'success');
                    $('#inventoryModal').modal('hide');

                    // Pass PHP variable to JS safely
                    let reloadPage = @json($reload); // true or false

                    if (reloadPage) {
                        // Wait a moment so the user sees the Swal
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }

                    if (typeof table !== 'undefined') {
                        table.ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    let msg = '';
                    if (errors) {
                        $.each(errors, function(k, v) {
                            msg += v[0] + '\n';
                        });
                    } else {
                        msg = xhr.responseJSON?.message || 'Something went wrong';
                    }
                    Swal.fire('Error!', msg, 'error');
                }
            });
        });

        // Edit Inventory
        $(document).on('click', '.edit-inventory', function() {
            let id = $(this).data('id');

            $.get(routes.edit.replace(':id', id), function(data) {
                $('#inventory_id').val(parseInt(data.id)); // id as integer
                $('#vatPercentage').val(parseFloat(data.cgst_percentage) || 0); // VAT as number
                // $('#cgstPercentage').val(parseFloat(data.cgst_percentage) || 0);
                $('#sgstPercentage').val(parseFloat(data.sgst_percentage) || 0);
                $('#igstPercentage').val(parseFloat(data.igst_percentage) || 0);

                $('[name="cgst_percentage"]').val(data.cgst_percentage);
                $('[name="Product"]').val(data.Product);
                $('[name="PartNumber"]').val(data.PartNumber);
                $('[name="Category"]').val(data.Category);
                $('[name="UnitType"]').val(data.UnitType);
                $('[name="Stock"]').val(data.Stock);
                $('[name="MinStock"]').val(data.MinStock);
                $('[name="CostPrice"]').val(data.CostPrice);
                $('[name="SalePrice"]').val(data.SalePrice);
                $('[name="Location"]').val(data.Location);

                if (data.Photo) {
                    $('#photoPreview').attr('src', '/uploads/inventory/' + data.Photo).show();
                } else {
                    $('#photoPreview').hide();
                }

                // Set tax configuration
                if (data.tax_configuration_id) {

                    loadTaxCountries();
                    // $('#taxCountrySelect').val(data.tax_configuration_id).trigger('change');

                    // setTimeout(function() {
                    //     // Set tax values based on system
                    //     if (data.tax_system === 'VAT' && data.vat_rate_id) {
                    //         $('#vatRateSelect').val(data.vat_rate_id).trigger('change');
                    //     } else if (data.tax_system === 'GST') {
                    //         if (data.cgst_rate_id) $('#cgstRateSelect').val(data.cgst_rate_id);
                    //         if (data.sgst_rate_id) $('#sgstRateSelect').val(data.sgst_rate_id);
                    //         if (data.igst_rate_id) $('#igstRateSelect').val(data.igst_rate_id);
                    //         calculateTaxPreview();
                    //     }
                    // }, 600);
                }

                $('#inventoryModalTitle').text('Edit Inventory');
                // $('#inventoryForm').data('url', routes.edit.replace(':id', id));
                $('#inventoryModal').modal('show');
            }).fail(function(xhr) {
                Swal.fire('Error!', 'Failed to load inventory data', 'error');
            });
        });

        // Delete Inventory
        $(document).on('click', '.delete-inventory', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete!',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then(res => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: routes.destroy.replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(r) {
                            Swal.fire('Deleted!', r.success || 'Inventory deleted', 'success');

                            if (typeof table !== 'undefined') {
                                table.ajax.reload(null, false);
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Failed to delete inventory', 'error');
                        }
                    });
                }
            });
        });

    });
</script>