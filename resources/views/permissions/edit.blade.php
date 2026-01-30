@extends('user.dashboard.layout.master')

@section('user-contant')
<div class="main-content">
    <section class="section">

        <div class="card shadow-sm border-0">

            <!-- Header -->
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h4 class="mb-0">{{ translate('Manage Permissions —') }} <b>{{ $user->name }}</b></h4>

                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> {{ translate('Back') }}
                </a>
            </div>

            <div class="card-body">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('permissions.update', $user) }}" method="POST">
                    @csrf

                    <h5 class="mb-3 fw-bold">{{ translate('Assign Permissions') }}</h5>

                    <div class="permission-container">

                        @php
                            // Group permissions by module using dot-notation
                            $grouped = [];
                            foreach ($permissions as $perm) {
                                $parts = explode('.', $perm->name);
                                $module = $parts[0] ?? 'other';
                                $grouped[$module][] = $perm;
                            }
                        @endphp

                        <div class="row">
                            @foreach($grouped as $module => $modulePermissions)
                                <div class="col-md-4">

                                    <div class="permission-box shadow-sm mb-4 p-3 rounded">

                                        <h6 class="fw-bold text-primary text-capitalize mb-3">
                                            {{ str_replace('_', ' ', $module) }}
                                        </h6>

                                        @foreach($modulePermissions as $permission)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                       name="permissions[]"
                                                       value="{{ (int)$permission->id }}"
                                                       id="perm-{{ $permission->id }}"
                                                       {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label text-dark" for="perm-{{ $permission->id }}">
                                                    {{ ucfirst(str_replace($module.'.', '', $permission->name)) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save"></i> {{ translate('Save Permissions') }}
                    </button>

                </form>
            </div>

        </div>

    </section>
</div>

{{-- Custom Styles --}}
<style>
    .permission-box {
        background: #f9fafb;
        border-left: 4px solid #4e73df;
    }
    .form-check-label {
        cursor: pointer;
    }
</style>

@endsection
