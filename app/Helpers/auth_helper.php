<?php

use Illuminate\Support\Facades\Auth;
use App\Models\AuthAccount;

if (! function_exists('authAccount')) {
    /**
     * Get authenticated AuthAccount
     */
    function authAccount()
    {
        return Auth::user(); // App\Models\AuthAccount
    }
}

if (! function_exists('isAdmin')) {
    /**
     * Check if logged-in account type is admin
     */
    function isAdmin(): bool
    {
        return authAccount() && authAccount()->type === 'admin';
    }
}

if (! function_exists('isEmployee')) {
    /**
     * Check if logged-in account type is employee
     */
    function isEmployee(): bool
    {
        return authAccount() && authAccount()->type === 'employee';
    }
}

if (! function_exists('hasRole')) {
    /**
     * Check employee role (via role_id)
     */
    function hasRole(string|int $role): bool
    {
        $auth = authAccount();

        if (! $auth || $auth->type !== 'employee' || ! $auth->employee) {
            return false;
        }

        // Allow role ID or role name
        if (is_numeric($role)) {
            return $auth->employee->role_id == $role;
        }

        return optional($auth->employee->role)->name === $role;
    }
}

if (! function_exists('hasPermission')) {
    /**
     * Check permission assigned via employee role
     * Matches Role::permissions() logic
     */
    function hasPermission(int|string $permission): bool
    {
        $auth = authAccount();

        // Admin bypass (optional)
        if ($auth && $auth->type === 'admin') {
            return true;
        }

        if (! $auth || $auth->type !== 'employee' || ! $auth->employee) {
            return false;
        }

        $role = $auth->employee->role;

        if (! $role) {
            return false;
        }

        // Allow permission ID or permission name
        if (is_numeric($permission)) {
            return $role->permissions()
                ->where('permissions.id', $permission)
                ->exists();
        }


        return $role->permissions()
            ->where('permissions.name', $permission)
            ->exists();
    }
}

if (! function_exists('canAccess')) {
    /**
     * Human-readable access check
     * Alias of canAccess()
     */
    function canAccess(int|string $permission): bool
    {
        return hasPermission($permission);
    }
}





if (!function_exists('userPermissions')) {
    /**
     * Get all permission names assigned to logged-in user
     */
    function userPermissions(): array
    {
        $auth = authAccount();

        // Admin: return ALL permissions (or a marker)
        if ($auth && $auth->type === 'admin') {
            return ['*']; // means full access
        }

        if (! $auth || $auth->type !== 'employee' || ! $auth->employee || ! $auth->employee->role) {
            return [];
        }

        return $auth->employee->role
            ->permissions()
            ->pluck('name')
            ->unique()
            ->toArray();
    }
}

if (!function_exists('permissionCount')) {
    /**
     * Count how many permissions the logged-in user has
     */
    function permissionCount(): int
    {
        return count(userPermissions());
    }
}

if (!function_exists('auth_id')) {
    function auth_id()
    {
        if (Auth::check()) {
            return Auth::user()->ref_id ?? Auth::id();
        }
        return null;
    }
}

if (!function_exists('self')) {
    function self()
    {
       $self = AuthAccount::with(['admin', 'employee'])->where('id', auth_id())->first();
    //    $retVal = (isEmployee()) ? $self->employee : $self->admin ;
       $retVal = $self->admin ;
       return $retVal;
    }
}
