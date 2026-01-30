@extends('user.dashboard.layout.master')

@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>{{ translate('Add New User') }}</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <!-- User Basic Info -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>{{ translate('User Code') }}</label>
                            <input type="text" class="form-control" name="user_code" required>
                        </div>

                        <div class="col-md-3">
                            <label>{{ translate('Name') }}</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="col-md-3">
                            <label>{{ translate('Email') }}</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="col-md-3">
                            <label>{{ translate('Phone') }}</label>
                            <input type="text" class="form-control" name="user_phone">
                        </div>
                    </div>

                    <!-- Password & Gender -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>{{ translate('Password') }}</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="col-md-3">
                            <label>{{ translate('Gender') }}</label>
                            <select name="gender" class="form-control">
                                <option value="Male" selected>{{ translate('Male') }}</option>
                                <option value="Female">{{ translate('Female') }}</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>{{ translate('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="Active" selected>{{ translate('Active') }}</option>
                                <option value="Inactive">{{ translate('Inactive') }}</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>{{ translate('Role') }}</label>
                            <select name="role_id" class="form-control" required>
                                <option value="">{{ translate('Select Role') }}</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <br>
                    <button type="submit" class="btn btn-primary">{{ translate('Create User') }}</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ translate('Back') }}</a>

                </form>

            </div>
        </div>
    </section>
</div>

@endsection