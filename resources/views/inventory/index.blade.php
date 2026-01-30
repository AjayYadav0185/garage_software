@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>{{ translate('All Inventory') }}</h4>

                <div>
                    <!-- <a href="{{ route('inventory.export') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> {{ translate('Export Excel') }}
                    </a>

                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importExcelModal">
                        <i class="fas fa-upload"></i> {{ translate('Import Excel') }}
                    </button> -->

                    <button class="btn btn-primary" id="addInventoryBtn">
                        <i class="fas fa-plus"></i> {{ translate('Add Inventory') }}
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="inventoryTable">
                        <thead>
                            <tr>
                                <th>{{ translate('ID') }}</th>
                                <th>{{ translate('Product') }}</th>
                                <th>{{ translate('Photo') }}</th>
                                <th>{{ translate('Part Number') }}</th>
                                <th>{{ translate('Category') }}</th>
                                <th>{{ translate('Location') }}</th>
                                <th>{{ translate('Stock') }}</th>
                                <th>{{ translate('Cost Price') }}</th>
                                <th>{{ translate('Sale Price') }}</th>
                                <th>{{ translate('VAT%') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- ADD / EDIT INVENTORY MODAL --}}
<x-inventory-modal title="Add Inventory" />

{{-- IMPORT EXCEL MODAL --}}
<div class="modal fade" id="importExcelModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="importExcelForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ translate('Import Inventory (Excel)') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="file" name="file" class="form-control" required>
                    <small class="text-muted">{{ translate('Allowed: .xlsx, .xls') }}</small>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        {{ translate('Import') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection