@extends('user.dashboard.layout.master')

@section('user-contant')
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('Manage Permissions for Role:') }} {{ $role->name }}</h4>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">{{ translate('Back to Roles') }}</a>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.permissions.update', $role->id) }}" method="POST">
                    @csrf
                    @php
                        $groupedPermissions = $permissions->groupBy(function($perm) {
                            $parts = explode('.', $perm->name);
                            return $parts[0];
                        });
                    @endphp

                    @foreach($groupedPermissions as $module => $perms)
                        <div class="mb-4 module-section">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="text-capitalize">{{ $module }}</h5>
                                <div hidden>
                                    <input type="checkbox" class="select-all-module" data-module="{{ $module }}" id="selectAll-{{ $module }}">
                                    <label for="selectAll-{{ $module }}" class="mb-0">{{ translate('Select All') }}</label>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($perms as $permission)
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-check mb-2">
                                            <input type="checkbox"
                                                   name="permissions[]"
                                                   value="{{ $permission->id }}"
                                                   id="perm{{ $permission->id }}"
                                                   class="form-check-input permission-checkbox"
                                                   data-module="{{ $module }}"
                                                   {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perm{{ $permission->id }}">
                                                {{ str_replace($module . '.', '', $permission->name) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                    @endforeach

                    <button type="submit" class="btn btn-primary mt-3">{{ translate('Save Permissions') }}</button>
                </form>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const moduleSections = document.querySelectorAll('.module-section');

    moduleSections.forEach(section => {
        const masterCheckbox = section.querySelector('.select-all-module');
        const checkboxes = section.querySelectorAll('.permission-checkbox');

        // Master checkbox toggles all checkboxes in its module
        masterCheckbox.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        // Update master checkbox if all individual boxes are checked/unchecked manually
        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                masterCheckbox.checked = Array.from(checkboxes).every(c => c.checked);
            });
        });

        // Initialize master checkbox state on page load
        masterCheckbox.checked = Array.from(checkboxes).every(c => c.checked);
    });
});
</script>
@endpush
@endsection
