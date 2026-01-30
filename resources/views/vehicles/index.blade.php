@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Vehicles') }}</h4>
                <button class="btn btn-primary" id="addVehicleBtn">{{ translate('Add Vehicle') }}</button>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="vehicleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Number Plate') }}</th>
                                <th>{{ translate('Brand') }}</th>
                                <th>{{ translate('Model') }}</th>
                                <th>{{ translate('Fuel Type') }}</th>
                                <th>{{ translate('Customer') }}</th>
                                <th>{{ translate('Mechanic') }}</th>

                                <!-- 🚀 NEW -->
                                <!-- <th>Service Status</th>
                            <th>Next Service</th> -->

                                <th>{{ translate('Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<x-vehicle-modal title="Add Vehicle" />


@endsection