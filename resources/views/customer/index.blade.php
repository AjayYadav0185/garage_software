@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Customers') }}</h4>
                <button class="btn btn-primary" id="addCustomerBtn">
                    {{ translate('Add Customer') }}
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="customerTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Tax Number</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<x-customer-modal title="Add Customer" />

@endsection
