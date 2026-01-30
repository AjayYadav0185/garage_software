@extends('user.dashboard.layout.master')
@section('user-contant')
    <style>
        .nav-pills .nav-item .nav-link:hover {
            background-color: #e2e60a;
            margin-left: 4px !important;
        }

        .theme-white .nav-pills .nav-link.active {
            color: #fff;
            background-color: #6777ef;
            margin-left: 4px !important;
        }

        .nav-pills .nav-item .nav-link {
            color: #6777ef;
            /* padding-left: 15px !important; */
            /* padding-right: 15px !important; */
            margin-left: 4px;
        }

        table.dataTable {
            width: 100% !important;
        }

        tbody th,
        table.dataTable tbody td {
            padding: 0px 8px !important;
        }

        .aa {
            color: rgb(0, 32, 122);
        }

        .bb {
            color: rgb(0, 112, 192);
        }

        .cc {
            color: rgb(86, 131, 55);
        }

        .dd {
            color: rgb(255, 193, 3);
        }

        .ee {
            color: rgb(255, 0, 0);
        }

        .ff {
            color: rgb(64, 64, 64);
        }

        .gg {
            color: rgb(255, 0, 0);
        }

        .hh {
            color: rgb(255, 0, 0);
        }

        .ii {
            color: rgb(255, 220, 132);
        }

        .jj {
            color: rgb(84, 130, 53);
        }

        .kk {
            color: rgb(117, 62, 63);
        }

        .dhjvsdghv {
            min-width: 100px;
        }

        table thead tr th {
            min-width: 65px;
        }

        .Update_class {
            background-color: #93D9F1 !important;
            font-weight: 600;
        }


        .custom-file-input {

            opacity: 1 !important;
            border: 1px solid rgb(187 184 184);
            padding-top: 3px;
            padding-left: 4px;
        }

        .dataTables_length {
            margin-top: 15px !important;

        }

        th {
            text-align: center !important;
        }
    </style>

    <div class="main-content">
        <section class="section" style="margin-top:-34px;">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="display: block;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                                class="btn btn-primary go_forbtn"
                                                style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;"
                                                data-toggle="tooltip" data-placement="top" title="Go Back">
                                                <i class="fa-sharp fa fa-arrow-left"></i>
                                            </a>&nbsp;&nbsp;
                                            <h4 class="mb-0">{{ translate('Credit Note') }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="card-header-form">
                                <div class=" text-right " style="margin-right:2% ;">
                                    <a href="javascript:void(0);" onclick="location.reload();"
                                        class="btn btn-outline-primary">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;{{ translate('Refresh') }}&nbsp;
                                    </a>


                                    @if (get_role(Auth::user()->usertype) == 2)
                                        <a href="#" class="btn btn-outline-primary"
                                            onclick="openBulkUploadModal('credit')"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                                {{ translate('Bulk Upload') }}</a>
                                    @endif

                                    <a href="#" class="btn btn-outline-primary" onclick="myFunction()"><i
                                            class="fa fa-filter" aria-hidden="true"></i>
                                        &nbsp;{{ translate('Filter') }}&nbsp;</i></a>

                                    {{--
                                    <a href="javascript:void(0)"><button type="button" id="upload_report"
                                            name="upload_report"
                                            class="btn btn-outline-primary">&nbsp;Export&nbsp;</button></i></a> --}}

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
                                            <table class="table table-striped table-bordered" id="Credit_table"
                                                style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        @if (get_role(Auth::user()->usertype) == 2)
                                                            <th>{{ translate('Client Name') }}</th>
                                                        @endif
                                                        <th>{{ translate('Credit Id') }}</th>
                                                        <th>{{ translate('Issued Note') }}</th>
                                                        <th>{{ translate('Issued Date') }}</th>
                                                        <th>{{ translate('Amount') }}</th>
                                                        <th>{{ translate('Purpose') }}</th>
                                                        <th>{{ translate('Download PDF') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
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

        $(document).ready(function() {
            // Show/hide custom date inputs based on date_range selection
            $('#date_range').on('change', function() {
                if ($(this).val() === 'CustomDateRange') {
                    $('#from_date, #to_date').removeClass('d-none');
                } else {
                    $('#from_date, #to_date').addClass('d-none');
                    $('#from_date').val('');
                    $('#to_date').val('');
                }
            });

            var table = $('#Credit_table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search By Credit Id"
                },
                dom: 'ftlip',
                ajax: {
                    url: "{{ route('user.creditNote') }}",
                    type: 'GET',
                    datatype: "json",
                    data: function(d) {
                        d.client = $('#client').val();
                        d.date_range = $('#date_range').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.search['value'];
                    },

                },
                columns: [


                    @if (get_role(Auth::user()->usertype) == 2)
                        {
                            data: 'client_name',
                            name: 'client_name'
                        },
                    @endif {
                        data: 'credit_id',
                        name: 'credit_id'
                    },
                    {
                        data: 'issued_note',
                        name: 'issued_note'
                    },
                    {
                        data: 'issued_date',
                        name: 'issued_date'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'purpose',
                        name: 'purpose'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                "lengthMenu": [
                    [50, 100, 200, 500, 5000],
                    [50, 100, 200, 500, "All"]
                ],
                order: [
                    [2, 'DESC']
                ]

            });

            // Filter button click reloads DataTable with new params
            $('#filterButton').on('click', function() {
                table.ajax.reload();
            });
        });
    </script>




    <script>
        function check_id() {
            var activeTabId = $('.nav-item .active').attr('id');
            var tableId;
            if (activeTabId === 'contact-tab6') {
                tableId = 'failed_table';
            } else if (activeTabId === 'profile-tab3') {
                tableId = 'profile3-table';
            } else if (activeTabId === 'home-tab3') {
                tableId = 'alltable';
            }
            var url = "{{ route('user.place-order') }}";
            if (tableId) {
                manageOrder(tableId, 'Please Select Order', url);
            }
        }
        $(document).on('click', '.abc', function() {
            var table_id = $(this).parents('table').attr('id');
            if ($("#" + table_id + " .abc:checked").length == $("#" + table_id + " .abc").length) {
                $('#' + table_id + ' th input[type="checkbox"]').prop('checked', true);
            } else {
                $('#' + table_id + ' th input[type="checkbox"]').prop('checked', false);
            }
        });

        function myFunction5(id) {
            var checkboxItem = '#' + id + ' th input[type="checkbox"]';
            if ($(checkboxItem).is(':checked')) {
                $("#" + id + " .abc").each(function() {
                    this.checked = true;
                });
            } else {
                $("#" + id + " .abc").each(function() {
                    this.checked = false;
                });
            }
        }





        $("#upload_report").click(function() {
            var activeTabId = $('.nav-item .active').attr('id');
            var tableId = (activeTabId === 'contact-tab6') ? 'failed_table' : 'profile3-table';
            var checkboxes = '#' + tableId + ' tbody input[type="checkbox"]';
            var selected = [];

            $(checkboxes + ':checked').each(function() {
                selected.push($(this).val());
            });

            if (selected.length > 0) {
                var orderno = selected.join(",");

                window.location.href = `{{ route('user.export_order') }}?awbno=${orderno}`;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Please Select Order',
                    width: '400px',
                });
            }
        });
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
    </script>
@endsection
