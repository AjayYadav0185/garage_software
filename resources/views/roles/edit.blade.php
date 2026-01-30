@extends('user.dashboard.layout.master')

@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>{{ translate('Edit User') }}</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>{{ translate('Name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="col-md-4">
                            <label>{{ translate('Email') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <h5 class="section-title">{{ translate('Assign Role') }}</h5>

                    <div class="row">
                        <div class="col-md-4">
                            <select name="role_id" class="form-control" required>
                                <option value="">{{ translate('Select Role') }}</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ (isset($selectedRoleId) && $selectedRoleId == $role->id) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <br>
                    <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ translate('Back') }}</a>

                </form>

            </div>
        </div>
    </section>
</div>

@endsection
