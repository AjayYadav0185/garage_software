<!-- Vehicle Modal -->
<div class="modal fade" id="vehicleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <form id="vehicleForm">
            @csrf
            <input type="hidden" name="id" id="vehicle_id">
            <!-- SERVICE DEFAULTS -->
            <input type="hidden" name="last_service_date" value="{{ date('Y-m-d') }}">
            <input type="hidden" name="service_interval_days" value="365">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vehicleModalTitle">{{ translate('Add Vehicle') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <!-- ================= CUSTOMER INFO ================= -->
                    <div class="form-group">
                        <label>{{ translate('Select Customer') }} <span class="text-danger">*</span></label>
                        <select name="client_id" id="vehicle_customerSelectVehicle" class="form-control select2" required>
                            <option value="">{{ translate('-- Select Customer --') }}</option>
                            @foreach(\App\Models\Customer::all() as $c)
                            <option value="{{ $c->c_id }}"
                                data-name="{{ $c->cus_name }}"
                                data-contact="{{ $c->cus_mob }}"
                                data-email="{{ $c->cus_email }}"
                                data-gst="{{ $c->c_gst }}"
                                data-address="{{ $c->c_add }}">
                                {{ $c->cus_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>{{ translate('Name') }}</label>
                            <input type="text" id="vehicle_custName" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>{{ translate('Contact') }}</label>
                            <input type="text" id="vehicle_custContact" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>{{ translate('Email') }}</label>
                            <input type="text" id="vehicle_custEmail" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>{{ translate('TAX') }}</label>
                            <input type="text" id="vehicle_custGST" class="form-control" readonly>
                        </div>
                        <div class="col-md-8">
                            <label>{{ translate('Address') }}</label>
                            <textarea id="vehicle_custAddress" class="form-control" readonly></textarea>
                        </div>
                    </div>

                    <!-- ================= VEHICLE BASIC INFO ================= -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>{{ translate('Number Plate') }} <span class="text-danger">*</span></label>
                            <input type="text" name="number_plate" class="form-control text-uppercase" required>
                        </div>
                        <div class="col-md-3">
                            <label>{{ translate('Brand') }} <span class="text-danger">*</span></label>
                            <select name="carbrand" id="carMakerSelect" class="form-control select2" required>
                                <option value="">{{ translate('-- Select Brand --') }}</option>
                                @foreach(\App\Models\CarMaker::all() as $maker)
                                <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>{{ translate('Model') }} <span class="text-danger">*</span></label>
                            <select name="carmodel" id="carModelSelect" class="form-control select2" required>
                                <option value="">{{ translate('-- Select Model --') }}</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>{{ translate('Fuel Type') }} <span class="text-danger">*</span></label>
                            <select name="fueltype" class="form-control select2" required>
                                <option value="">Select Fuel</option>
                                @foreach(App\Enums\FuelType::cases() as $fuel)
                                <option value="{{ $fuel->value }}">{{ $fuel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>{{ translate('Transmission') }} <span class="text-danger">*</span></label>
                            <select name="transmission" class="form-control" required>
                                <option value="">Select Transmission</option>
                                @foreach(App\Enums\Transmission::cases() as $trans)
                                <option value="{{ $trans->value }}">{{ $trans->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>{{ translate('Mechanic') }}</label>
                            <select name="mechanic_id" class="form-control">
                                <option value="">{{ translate('Optional') }}</option>
                                @foreach(\App\Models\Mechanic::all() as $mechanic)
                                <option value="{{ $mechanic->id }}">{{ $mechanic->m_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>{{ translate('Chassis No') }}</label>
                            <input type="text" name="chassis_no" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>{{ translate('Engine No') }}</label>
                            <input type="text" name="engine_no" class="form-control">
                        </div>
                    </div>

                    <!-- ================= OPTIONAL EXTENDED INFO ================= -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>Emirate</label>
                            <select name="vehicle_emirate" class="form-control">
                                <option value="">Select Emirate</option>
                                @foreach(['Abu Dhabi','Dubai','Sharjah','Ajman','Umm Al Quwain','Ras Al Khaimah','Fujairah'] as $em)
                                <option value="{{ $em }}">{{ $em }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Number Plate Code</label>
                            <input type="text" name="vehicle_number_plate_code" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Number Plate Color</label>
                            <select name="vehicle_number_plate_color" class="form-control">
                                <option value="">Select Color</option>
                                @foreach(App\Enums\NumberPlateColor::cases() as $color)
                                <option value="{{ $color->value }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Car Body Color</label>
                            <input type="text" name="vehicle_car_body_color" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>Manufacturing Year</label>
                            <select name="vehicle_manfacturing_year" class="form-control">
                                <option value="">Select Year</option>
                                @for($year = date('Y'); $year >= 1995; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Odometer</label>
                            <input type="number" name="vehicle_odometer" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Brake System</label>
                            <select name="vehicle_braking" class="form-control">
                                <option value="">Select Braking</option>
                                @foreach(App\Enums\BrakeSystem::cases() as $brake)
                                <option value="{{ $brake->value }}">{{ $brake->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Fuel Meter</label>
                            <select name="vehicle_fuelmeter" class="form-control">
                                <option value="">Select</option>
                                <option>0-10</option>
                                <option>10-30</option>
                                <option>30-60</option>
                                <option>60-80</option>
                                <option>80-100</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ translate('Save Vehicle') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(function() {
        const routes = {
            ajax: "{{ route('vehicles.ajax') }}",
            store: "{{ route('vehicles.store') }}",
            edit: "{{ route('vehicles.edit', ':id') }}",
            update: "{{ route('vehicles.update', ':id') }}",
            destroy: "{{ route('vehicles.destroy', ':id') }}",
            modelsByMaker: "{{ route('car-models.by-maker', ':maker') }}"
        };

        // Load models when brand changes
        $('#carMakerSelect').on('change', function() {
            let brandId = $(this).val();
            $('#carModelSelect').html('<option value="">Loading...</option>');
            if (!brandId) {
                $('#carModelSelect').html('<option value="">-- Select Model --</option>');
                return;
            }
            let url = routes.modelsByMaker.replace(':maker', brandId);
            $.get(url, function(data) {
                let options = '<option value="">-- Select Model --</option>';
                data.forEach(model => options += `<option value="${model.name}">${model.name}</option>`);
                $('#carModelSelect').html(options);
            });
        });

        function loadModelsForEdit(brandId, modelName) {
            let url = routes.modelsByMaker.replace(':maker', brandId);
            $('#carModelSelect').html('<option>Loading...</option>');
            $.get(url, function(data) {
                let opts = '<option value="">Select Model</option>';
                data.forEach(m => opts += `<option value="${m.name}">${m.name}</option>`);
                $('#carModelSelect').html(opts).val(modelName);
            });
        }

        // Auto-fill customer info
        $('#vehicle_customerSelectVehicle').on('change', function() {
            let s = $(this).find(':selected');
            console.log('customerSelectVehicle');
            console.log(s);
            $('#vehicle_custName').val(s.data('name'));
            $('#vehicle_custContact').val(s.data('contact'));
            $('#vehicle_custEmail').val(s.data('email'));
            $('#vehicle_custGST').val(s.data('gst'));
            $('#vehicle_custAddress').val(s.data('address'));
        });

        // DataTable
        var table = $('#vehicleTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: routes.ajax,
            columns: [{
                    data: 'id'
                },
                {
                    data: 'number_plate'
                },
                {
                    data: 'carbrand'
                },
                {
                    data: 'carmodel'
                },
                {
                    data: 'fueltype'
                },
                {
                    data: 'customer_name'
                },
                {
                    data: 'mechanic_name'
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Add Vehicle
        $('#addVehicleBtn').click(function() {
            $('#vehicleForm')[0].reset();
            $('#vehicle_id').val('');
            $('#vehicleModalTitle').text('Add Vehicle');
            $('#vehicleModal').modal('show');
        });

        // Save / Update Vehicle
        $('#vehicleForm').submit(function(e) {
            e.preventDefault();
            let id = $('#vehicle_id').val();
            let url = id ? routes.update.replace(':id', id) : routes.store;
            let type = 'POST';
            let formData = $(this).serializeArray();
            if (id) formData.push({
                name: '_method',
                value: 'PUT'
            });

            $.ajax({
                url,
                type,
                data: $.param(formData),
                success: res => {
                    $('#vehicleModal').modal('hide');
                    table.ajax.reload();

                    // Pass PHP variable to JS safely
                    let reloadPage = @json($reload); // true or false

                    if (reloadPage) {
                        // Wait a moment so the user sees the Swal
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: xhr => {
                    let errors = xhr.responseJSON?.errors || {};
                    let message = '';
                    for (let key in errors) message += errors[key].join('\n') + '\n';
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: message || xhr.responseJSON?.message
                    });
                }
            });
        });

        // Edit Vehicle
        $(document).on('click', '.edit-vehicle', function() {
            let id = $(this).data('id');
            let url = routes.edit.replace(':id', id);
            $.get(url, function(data) {
                $('#vehicle_id').val(data.id);
                $('#vehicle_customerSelectVehicle').val(data.c_id).trigger('change');
                $('#vehicle_custName').val(data.customer_name);
                $('#vehicle_custContact').val(data.customer_contact);
                $('#vehicle_custEmail').val(data.customer_email);
                $('#vehicle_custGST').val(data.customer_gst);
                $('#vehicle_custAddress').val(data.customer_address);
                $('[name="number_plate"]').val(data.number_plate);
                $('#carMakerSelect').val(data.carbrand).trigger('change');
                loadModelsForEdit(data.carbrand, data.carmodel);
                $('[name="fueltype"]').val(data.fueltype);
                $('[name="transmission"]').val(data.transmission);
                $('[name="mechanic_id"]').val(data.mechanic_id);
                $('[name="chassis_no"]').val(data.chassis_no);
                $('[name="engine_no"]').val(data.engine_no);
                $('[name="vehicle_emirate"]').val(data.vehicle_emirate);
                $('[name="vehicle_number_plate_code"]').val(data.vehicle_number_plate_code);
                $('[name="vehicle_number_plate_color"]').val(data.vehicle_number_plate_color);
                $('[name="vehicle_car_body_color"]').val(data.vehicle_car_body_color);
                $('[name="vehicle_manfacturing_year"]').val(data.vehicle_manfacturing_year);
                $('[name="vehicle_odometer"]').val(data.vehicle_odometer);
                $('[name="vehicle_braking"]').val(data.vehicle_braking);
                $('[name="vehicle_fuelmeter"]').val(data.vehicle_fuelmeter);
                $('#vehicleModalTitle').text('Edit Vehicle');
                $('#vehicleModal').modal('show');
            });
        });

        // Delete Vehicle
        $(document).on('click', '.delete-vehicle', function() {
            let id = $(this).data('id');
            let url = routes.destroy.replace(':id', id);
            Swal.fire({
                title: 'Are you sure?',
                text: 'This cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete!'
            }).then(res => {
                if (res.isConfirmed) {
                    $.ajax({
                        url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: r => {
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: r.success,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        });
    });
</script>