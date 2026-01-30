<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSetupSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to avoid errors
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop tables in the correct order
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('permission_user'); // any other table referencing permissions
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Recreate 'roles' table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name')->default('web');
            $table->timestamps();
        });

        // Recreate 'permissions' table
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name')->default('web');
            $table->timestamps();
        });

        // Recreate pivot table 'model_has_roles'
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->morphs('model'); // model_type and model_id
            $table->primary(['role_id', 'model_id', 'model_type']);
        });

        // Recreate pivot table 'model_has_permissions'
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->foreignId('permission_id')->constrained('permissions')->cascadeOnDelete();
            $table->morphs('model'); // model_type and model_id
            $table->primary(['permission_id', 'model_id', 'model_type']);
        });

        // Recreate pivot table 'role_has_permissions'
        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->foreignId('permission_id')->constrained('permissions')->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->primary(['permission_id', 'role_id']);
        });

        // Seed roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Seed permissions (module-based example)
        $viewUsers = Permission::create(['name' => 'view users']);
        $editUsers = Permission::create(['name' => 'edit users']);
        $deleteUsers = Permission::create(['name' => 'delete users']);
        $viewCars = Permission::create(['name' => 'view cars']);
        $editCars = Permission::create(['name' => 'edit cars']);
        $deleteCars = Permission::create(['name' => 'delete cars']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all()); // admin gets all permissions
        $userRole->givePermissionTo(['view users', 'view cars']); // user gets limited permissions
    }
}
