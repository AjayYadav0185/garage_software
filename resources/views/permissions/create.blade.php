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

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>{{ translate('Name') }}</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="col-md-4">
                            <label>{{ translate('Email') }}</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="col-md-4">
                            <label>{{ translate('Password') }}</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <h5 class="section-title">{{ translate('Assign Roles') }}</h5>

                    <div class="row">
                        @foreach ($roles as $role)
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
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
