@extends('user.dashboard.layout.master')

@section('user-contant')

@php

@endphp
<style>
    #statusFilter {
        border-radius: 5px;
        padding: 4px 8px;
        border: 1px solid #ced4da;
        background-color: #f8f9fa;
        font-size: 0.875rem;
    }

    #statusFilter:focus {
        outline: none;
        border-color: #495057;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }
</style>

<style>
    .section-title {
        font-weight: 600;
        font-size: 15px;
        padding: 6px 0;
        /* border-bottom: 2px solid #0d6efd; */
        margin-bottom: 10px;
        /* color: #0d6efd; */
    }
</style>

<style>
    .modal-xl {
        max-width: 98% !important;
    }

    .preview-img {
        width: 140px;
        height: 110px;
        object-fit: cover;
        border: 2px solid #ccc;
        margin-top: 10px;
    }

    .section-title {
        font-weight: 600;
        margin-top: 20px;
        margin-bottom: 10px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
    }
</style>


@php
$currentUrl = url()->current(); // full URL without query
$isPending = str_ends_with($currentUrl, '-pending'); // true if ends with '-pending'
@endphp

<!-- ================== HTML ================== -->
<div class="main-content">
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Payment JobCards') }}</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="statusFilter" class="form-label me-2">{{ translate('Filter by Status') }}:</label>
                    <select id="statusFilter" class="form-select form-select-sm w-auto d-inline-block">
                        <option value="">{{ translate('All') }}</option>
                        <option value="P" {{ $isPending ? 'selected' : '' }}>{{ translate('Pending') }}</option>
                        <option value="C" {{ !$isPending ? 'selected' : '' }}>{{ translate('Completed') }}</option>
                    </select>
                </div>

                <div class="table-responsive">

                    <table class="table table-bordered" id="jobCardTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Job Card No') }}</th>
                                <th>{{ translate('Customer') }}</th>
                                <th>{{ translate('Vehicle') }}</th>
                                <th>{{ translate('Registration') }}</th>
                                <th>{{ translate('Status') }}</th>
                                <th>{{ translate('Amount') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                        <!-- Filter row will be inserted by JS -->
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    $(document).ready(function() {

        var jobCardTable = $('#jobCardTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('jobcards.list-pending') }}",
                data: function(d) {
                    d.status = $('#statusFilter').val(); // send status filter to server
                },
                dataSrc: function(json) {
                    console.log("Server returned data:", json); // <-- log all data from server
                    return json.data;
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'job_card_no',
                    name: 'job_card_no'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'carbrand',
                    name: 'carbrand'
                },
                {
                    data: 'registration',
                    name: 'registration'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'dueamount',
                    name: 'dueamount'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });

        $('#statusFilter').on('change', function() {
            jobCardTable.ajax.reload();
        });

    });
</script>

@endsection
