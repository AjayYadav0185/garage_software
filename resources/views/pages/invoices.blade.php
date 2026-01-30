@extends('user.dashboard.layout.master')
@section('user-contant')
    <style>
        td.editable {
            cursor: pointer;
            background-color: #f9f9f9;
            /* subtle highlight */
            transition: background-color 0.3s;
        }

        td.editable:hover {
            background-color: #e6f7ff;
        }
    </style>

    <div class="main-content">
        <section class="section" style="margin-top:-34px;">
            <div class="section-body">
                <div class="row">

                    <div class="col-12">
                        <div class="card">

                            <div class="card-header supreme-container" style="display: block;">


                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                                class="btn btn-primary go_forbtn"
                                                style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;"
                                                data-toggle="tooltip" data-placement="top" title="Go Back">
                                                <i class="fa-sharp fa fa-arrow-left"></i>
                                            </a>&nbsp;&nbsp;
                                            <h4 class="mb-0">{{ translate('Invoices') }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header-form">
                                <div class=" text-right " style="margin-right:2% ;">

                                    @if (get_role(Auth::user()->usertype) == 2)
                                        <a href="#" class="btn btn-outline-primary"
                                            onclick="openBulkUploadModal('invoice')"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                            {{ translate('Bulk Upload') }}</a>
                                    @endif

                                    <a href="#" class="btn btn-outline-primary" onclick="myFunction()"><i
                                            class="fa fa-filter" aria-hidden="true"></i>
                                        &nbsp;{{ translate('Filter') }}&nbsp;</i></a>

                                    <a href="javascript:void(0);" onclick="location.reload();"
                                        class="btn btn-outline-primary">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Refresh&nbsp;
                                    </a>

                                </div>
                            </div>
                            <div class="col-md-12 my-2 " id="myDIV" style="display: none;">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Filter</h4>
                                        <div class="card-header-action">
                                        </div>
                                    </div>
                                    <div class="card-body" style="background-color: #bfbfbf;">
                                        <form class="order_filter" method="post" id="IdFilterData">
                                            {!! csrf_field() !!}
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <label class="form-label" style="color:#0d0d0d;">{{ translate('Date Range') }}</label>
                                                    <select class="form-control" id="date_range" name="date_range">
                                                        <option value="">{{ translate('---Select Data Range---') }}</option>
                                                        <option value="today">{{ translate('Today') }}</option>
                                                        <option value="yesterday">{{ translate('Yesterday') }}</option>
                                                        <option value="-7 days">{{ translate('Last seven days') }}</option>
                                                        <option value="first day of">{{ translate('Current Month') }}</option>
                                                        <option value="-1 months">{{ translate('Last Month') }}</option>
                                                        <option value="All Time Order">{{ translate('All Time') }}</option>
                                                        <option value="CustomDateRange">{{ translate('Custom Date Range') }}</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4 d-none" id="custom_date_from">
                                                    <label class="form-label" for="from_date" style="color:#0d0d0d;">{{ translate('From
                                                        Date') }}</label>
                                                    <input type="date" class="form-control" id="from_date"
                                                        name="from_date">
                                                </div>

                                                <div class="col-md-4 d-none" id="custom_date_to">
                                                    <label class="form-label" for="to_date" style="color:#0d0d0d;">{{ translate('To
                                                        Date') }}</label>
                                                    <input type="date" class="form-control" id="to_date"
                                                        name="to_date">
                                                </div>

                                                <div class="col-md-3" @if (get_role(Auth::user()->usertype) == 1) hidden @endif>
                                                    <label class="form-label">{{ translate('Client Wise') }}</label>
                                                    <div class="list-inline text-center">
                                                        <div class="form-group">
                                                            <select class="form-control" id="client" name="client">
                                                                <option value="">{{ translate('---Select Client Wise---') }}</option>
                                                                @foreach ($clientData as $dx)
                                                                    <option value="{{ $dx->User_Id }}">
                                                                        {{ mention_client_filter($dx) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">

                                                <div class="col-md-1 my-2">
                                                    <button type="button" class="btn btn-primary mt-4"
                                                        id="filterButton">{{ translate('Apply') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content excel" id="myTabContent2" style="text-align: center;">

                                    <div class="tab-pane fade show active my-2" id="profile3" role="tabpanel"
                                        aria-labelledby="profile-tab3">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>{{ translate('SR.No') }}.</th>
                                                        @if (get_role(Auth::user()->usertype) == 2)
                                                            <th>{{ translate('Client Name') }}</th>
                                                        @endif
                                                        <th>{{ translate('Invoice Number') }}</th>
                                                        <th class="date-field">{{ translate('Invoice Date') }} </th>
                                                        <th class="date-field">{{ translate('Invoice Period') }} </th>
                                                        <th class="date-field">{{ translate('Due Date') }}</th>
                                                        <th>{{ translate('Tax Number') }}</th>
                                                        <th>{{ translate('Serive Type') }}</th>
                                                        <th>{{ translate('Invoice Amount') }}</th>
                                                        <th style="width:65px !important">{!! get_role(Auth::user()->usertype) == 2
                                                            ? 'Paid  <i class="fa fa-pencil" style="color:#007bff;"></i>'
                                                            : 'Paid ' !!}</th>
                                                        <th>{{ translate('Balance') }} </th>
                                                        <th>{!! get_role(Auth::user()->usertype) == 2
                                                            ? 'Invoice Status <i class="fa fa-pencil" style="color:#007bff;"></i>'
                                                            : 'Invoice Status' !!}</th>
                                                        <th>{{ translate('PDF') }}</th>
                                                        <th>{{ translate('XlSX') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbodyfiltr_data"></tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        var today = new Date().toISOString().split('T')[0];
        $('#from_date').attr('max', today);
        $('#to_date').attr('max', today);

        $('#date_range').change(function() {
            if ($(this).val() == 'CustomDateRange') {
                $('#custom_date_from').removeClass('d-none');
                $('#custom_date_to').removeClass('d-none');
            } else {
                $('#custom_date_from').addClass('d-none');
                $('#custom_date_to').addClass('d-none');
            }
        });
        $(document).ready(function() {
            var failedlisttable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Invoice Number"
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.invoice-ajaxcall') }}",
                    type: "GET",
                    datatype: "json",
                    data: function(d) {
                        d.status = $('#order_status1').val();
                        d.client = $('#client').val();
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.search['value'];
                    }
                },
                columns: [{
                        data: 'id',
                        orderable: false
                    },
                    @if (get_role(Auth::user()->usertype) == 2)
                        {
                            data: 'client_name',
                            orderable: false
                        },
                    @endif {
                        data: 'invoice_number',
                        orderable: false
                    },
                    {
                        data: 'invoice_date',
                        orderable: false
                    },
                    {
                        data: 'Invoice_Period',
                        orderable: false
                    },
                    {
                        data: 'Due_Date',
                        orderable: false
                    },
                    {
                        data: 'user_gst',
                        orderable: false
                    },
                    {
                        data: 'billing_type',
                        orderable: false
                    },
                    {
                        data: 'total',
                        orderable: false,
                    },
                    {!! get_role(Auth::user()->usertype) == 2
                        ? "{ data: 'Paid', orderable: false, createdCell: function(td, cellData, rowData, row, col) { \$(td).addClass('editable').attr('data-field', 'Paid').attr('data-total', rowData.total).attr('data-id', rowData.unique_id); } },"
                        : "{ data: 'Paid', orderable: false }," !!} {
                        data: 'Balance',
                        orderable: false
                    },
                    @if (get_role(Auth::user()->usertype) == 2)
                        {
                            data: 'status',
                            orderable: false,
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).addClass('editable')
                                    .attr('data-field', 'status')
                                    .attr('data-id', rowData.unique_id);
                            },
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return data == 1 ? 'Completed' : 'Pending';
                                }
                                return data; // for sorting/searching use raw value
                            }
                        },
                    @else
                    {
                        data: 'status',
                        orderable: false
                    },
                    @endif

                    {
                        data: 'action',
                        orderable: false
                    },
                    {
                        data: 'xlsx',
                        orderable: false
                    },
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
            });

            // Filter button click reloads DataTable with new params
            $('#filterButton').on('click', function() {
                failedlisttable.ajax.reload();
            });
        });


        // Handle cell click for editing
        $('#datatable tbody').on('click', 'td.editable', function() {
            var $cell = $(this);

            // Prevent editing if already editing
            if ($cell.find('input, select').length > 0) return;

            var field = $cell.data('field'); // e.g. "Paid" or "status"
            var id = $cell.data('id'); // unique id for AJAX
            var currentValue = $cell.text().trim();

            if (field === 'Paid') {
                // Show text input
                var input = $('<input>', {
                    type: 'text',
                    value: currentValue,
                    class: 'form-control form-control-sm',
                    css: {
                        width: '100%'
                    }
                });

                $cell.empty().append(input);
                input.focus();

                // Handle blur and enter key for update
                input.on('blur keypress', function(e) {
                    if (e.type === 'blur' || (e.type === 'keypress' && e.which === 13)) {
                        var newValue = input.val().trim();
                        var totalVal = $cell.data('total');

                        if (newValue == 0 || newValue < 0 || newValue > totalVal) {
                            Swal.fire(
                                'Invalid Amount',
                                `The value must be between 0 and the total amount (${totalVal}).`,
                                'warning'
                            );
                            return;
                        }


                        Swal.fire({
                            title: 'Are you sure?',
                            // Show friendly names instead of raw values
                            text: `Update ${field} from "${currentValue}" to "${newValue}"?`,
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, update it',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {



                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{ route('user.invoice-update') }}",
                                    method: 'POST',
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        id: id,
                                        field: field,
                                        value: newValue
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            Swal.fire('Updated!', response.message,
                                                'success');
                                            $cell.text(newValue);
                                            location.reload();
                                        } else {
                                            Swal.fire('Update Failed', response.message,
                                                'warning');
                                            $cell.text(currentValue);
                                        }
                                    },
                                    error: function() {
                                        Swal.fire('Error',
                                            'Failed to update due to server error.',
                                            'error');
                                        $cell.text(currentValue);
                                    }
                                });
                            } else {
                                $cell.text(currentValue);
                            }
                        });
                    }
                });

            } else if (field === 'status') {
                // Create dropdown select
                var select = $('<select>', {
                    class: 'form-control form-control-sm',
                    css: {
                        width: '100%'
                    }
                });

                select.append($('<option>', {
                    value: 0,
                    text: 'Pending'
                }));
                select.append($('<option>', {
                    value: 1,
                    text: 'Completed'
                }));

                // Fix selected value: currentValue could be number or string ('Pending'/'Completed')
                var valLower = currentValue.toLowerCase();
                var selectedVal = (valLower == 'completed') ? 1 : 0;


                select.val(selectedVal);

                $cell.empty().append(select);

                // Focus dropdown with small delay to avoid issues
                setTimeout(() => select.focus(), 0);

                // Handle change event for update
                select.on('change blur', function(e) {
                    // To avoid double trigger on blur+change, only act on change OR blur without change
                    if (e.type === 'blur' && !select.data('changed')) return;

                    var newValue = select.val();
                    var newText = select.find('option:selected').text();

                    // If no change, just restore cell text
                    if (newValue == selectedVal) {
                        $cell.text(currentValue);
                        return;
                    }


                    // Mapping for display text
                    const statusText = {
                        0: 'Pending',
                        1: 'Completed'
                    };

                    Swal.fire({
                        title: 'Are you sure?',
                        // Show friendly names instead of raw values
                        text: `Update ${field} from "${currentValue}" to "${statusText[newValue]}"?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, update it',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('user.invoice-update') }}",
                                method: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    id: id,
                                    field: field,
                                    value: newValue
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire('Updated!', response.message,
                                            'success');
                                        $cell.text(newText);
                                        location.reload();
                                    } else {
                                        Swal.fire('Update Failed', response.message,
                                            'warning');
                                        $cell.text(currentValue);
                                    }
                                },
                                error: function() {
                                    Swal.fire('Error',
                                        'Failed to update due to server error.',
                                        'error');
                                    $cell.text(currentValue);
                                }
                            });
                        } else {
                            $cell.text(currentValue);
                        }
                    });
                });

                // Mark as changed when user changes the dropdown value
                select.on('change', function() {
                    select.data('changed', true);
                });

            } else {
                // Not editable field
                return;
            }
        });
    </script>
@endsection
