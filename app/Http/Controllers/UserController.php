<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\UserManage; // New staff table
use DataTables;
use App\Rules\PhoneNumber;

class UserController extends Controller
{
    public function updateRole(Request $request, $roleId)
    {
        // Find the role or fail
        $role = Role::findOrFail($roleId);

        // Validate input
        $request->validate([
            'name' => 'required', // ignore current role
        ]);

        // Update role
        $role->update([
            'name' => $request->name,
        ]);

        // Return JSON response
        return response()->json([
            'success' => 'Role updated successfully'
        ]);
    }

    // ----------------- ROLES -----------------

    // DataTable AJAX for roles
    public function ajax()
    {
        $roles = Role::withCount('permissions')->get();

        return Datatables::of($roles)
            ->addIndexColumn()
            ->addColumn('permissions_count', fn($role) => $role->permissions_count)
            ->addColumn('actions', function ($role) {
                $permissionsBtn = '<a href="' . route('roles.permissions.edit', $role->id) . '" class="btn btn-sm btn-warning">Permissions</a>';
                $editBtn = '<a href="javascript:void(0);" data-id="' . $role->id . '" class="btn btn-sm btn-primary edit-role">Edit</a>';
                return $editBtn . ' ' . $permissionsBtn;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    // Store new Role
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        return response()->json(['success' => 'Role created successfully']);
    }

    // Show Edit Role form (AJAX)
    public function editRole(Role $role)
    {
        return response()->json($role);
    }

    // Show permissions for a role
    public function editRolePermission(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('permissions.role_edit', compact('role', 'permissions', 'rolePermissions'));
    }

    // Update permissions for a role
    public function updateRolePermission(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);


        $permissions = $request->permissions ?? [];
        $permissions = Permission::whereIn('id', $permissions)->get();
        $role->syncPermissions($permissions);

        // $permissions = $request->permissions ?? [];
        // $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Permissions updated successfully!');
    }

    // ----------------- STAFF USERS -----------------

    // Staff Users list page
    public function index()
    {
        return view('roles.access'); // Your blade file for listing staff
    }

    // Roles list page
    public function roleIndex()
    {
        return view('roles.index'); // Your blade file for listing staff
    }

    // Staff DataTable AJAX
    public function datatable()
    {
        $users = UserManage::byGroup()->with('role')->select('id', 'g_id', 'user_code', 'name', 'email', 'role_id');


        return DataTables::of($users)
            ->addColumn('role_name', fn($user) => $user->role ? $user->role->name : '')
            ->addColumn('actions', function ($user) {
                $buttons = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-primary">Edit</a> ';
                return $buttons;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    // Create Staff form
    public function create()
    {
        return view('roles.create', [
            'roles' => Role::all()
        ]);
    }

    // Store new Staff user
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'user_phone' => ['required', new PhoneNumber(), 'unique:user_manage,user_phone,NULL,id,g_id,' . auth_id()],
            'email' => 'required|email|unique:user_manage,email',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = UserManage::create([
            'g_id' => auth_id(),
            'user_code' => $request->user_code,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);

        // Assign role via Spatie
        $role = Role::findById($request->role_id);
        $user->assignRole($role);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // Edit Staff form
    public function edit($g_id)
    {
        $user = UserManage::byGroup()->findOrFail($g_id);
        $roles = Role::all();

        // Get the user's current role ID
        $selectedRoleId = $user->role_id;

        // dd($selectedRoleId);

        return view('roles.edit', [
            'user' => $user,
            'roles' => $roles,
            'selectedRoleId' => $selectedRoleId
        ]);
    }



    // Update Staff
    public function update(Request $request, $g_id)
    {
        $user = UserManage::byGroup()->findOrFail($g_id);


        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // 'user_phone' => ['required', new PhoneNumber()],
            'role_id' => 'required|exists:roles,id'
        ]);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => (int)$request->role_id
        ]);



        // Sync Spatie roles
        $role = Role::findById($request->role_id);
        $user->syncRoles($role);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Optional: Load permissions for modal (role-based)
    public function permissions($roleId = null)
    {
        $permissions = Permission::all();
        $selected = $roleId ? Role::find($roleId)->permissions->pluck('id')->toArray() : [];

        $html = view('permissions.index', compact('permissions', 'selected'))->render();
        return response()->json(['html' => $html]);
    }
}
