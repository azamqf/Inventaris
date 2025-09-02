<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Daftar permission utama (CRUD + view_any/view_own)
        $resources = ['device', 'user', 'role', 'network', 'radio', 'vehicle', 'gun', 'member'];
        $actions = [
            'view_any', 'view', 'view_own', 'create', 'update', 'delete',
            'delete_any', 'force_delete', 'force_delete_any',
            'restore', 'restore_any', 'replicate', 'reorder',
        ];
        $permissions = [];
        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                $permissions[] = $action . '_' . $resource;
            }
        }
        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // 2. Buat role
        $admin = Role::findOrCreate('admin', 'web');
        $manager = Role::findOrCreate('manager', 'web');
        $userRole = Role::findOrCreate('user', 'web');

        // 3. Assign permission ke role
        // Admin: semua permission
        $admin->syncPermissions(Permission::all());

        // User: hanya view_own resource miliknya sendiri
        $userPermissions = [];
        foreach ($resources as $resource) {
            $userPermissions[] = 'view_own_' . $resource;
        }
        $userRole->syncPermissions($userPermissions);

        // Manager: mewarisi permission user + manage members, radios, vehicles
        $managerPermissions = $userPermissions;
        $managerResources = ['member', 'radio', 'vehicle'];
        foreach ($managerResources as $resource) {
            foreach ($actions as $action) {
                $managerPermissions[] = $action . '_' . $resource;
            }
        }
        $manager->syncPermissions(array_unique($managerPermissions));

        // 4. Contoh assign role ke user
        // User 1: admin
        $adminUser = User::where('email', 'admin@example.com')->first();
        if ($adminUser) {
            $adminUser->syncRoles(['admin']);
        }
        // User 2: manager
        $managerUser = User::where('email', 'manager@example.com')->first();
        if ($managerUser) {
            $managerUser->syncRoles(['manager']);
        }
        // User 3: user
        $user = User::where('email', 'user@example.com')->first();
        if ($user) {
            $user->syncRoles(['user']);
        }
        // User 4: manager + user
        $multiRoleUser = User::where('email', 'multi@example.com')->first();
        if ($multiRoleUser) {
            $multiRoleUser->syncRoles(['manager', 'user']);
        }
    }
}
