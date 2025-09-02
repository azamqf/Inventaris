<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_condition","view_any_condition","create_condition","update_condition","restore_condition","restore_any_condition","replicate_condition","reorder_condition","delete_condition","delete_any_condition","force_delete_condition","force_delete_any_condition","view_device","view_any_device","create_device","update_device","restore_device","restore_any_device","replicate_device","reorder_device","delete_device","delete_any_device","force_delete_device","force_delete_any_device","view_device::type","view_any_device::type","create_device::type","update_device::type","restore_device::type","restore_any_device::type","replicate_device::type","reorder_device::type","delete_device::type","delete_any_device::type","force_delete_device::type","force_delete_any_device::type","view_gun","view_any_gun","create_gun","update_gun","restore_gun","restore_any_gun","replicate_gun","reorder_gun","delete_gun","delete_any_gun","force_delete_gun","force_delete_any_gun","view_gun::type","view_any_gun::type","create_gun::type","update_gun::type","restore_gun::type","restore_any_gun::type","replicate_gun::type","reorder_gun::type","delete_gun::type","delete_any_gun::type","force_delete_gun::type","force_delete_any_gun::type","view_member","view_any_member","create_member","update_member","restore_member","restore_any_member","replicate_member","reorder_member","delete_member","delete_any_member","force_delete_member","force_delete_any_member","view_network","view_any_network","create_network","update_network","restore_network","restore_any_network","replicate_network","reorder_network","delete_network","delete_any_network","force_delete_network","force_delete_any_network","view_network::type","view_any_network::type","create_network::type","update_network::type","restore_network::type","restore_any_network::type","replicate_network::type","reorder_network::type","delete_network::type","delete_any_network::type","force_delete_network::type","force_delete_any_network::type","view_radio","view_any_radio","create_radio","update_radio","restore_radio","restore_any_radio","replicate_radio","reorder_radio","delete_radio","delete_any_radio","force_delete_radio","force_delete_any_radio","view_radio::type","view_any_radio::type","create_radio::type","update_radio::type","restore_radio::type","restore_any_radio::type","replicate_radio::type","reorder_radio::type","delete_radio::type","delete_any_radio::type","force_delete_radio::type","force_delete_any_radio::type","view_rank","view_any_rank","create_rank","update_rank","restore_rank","restore_any_rank","replicate_rank","reorder_rank","delete_rank","delete_any_rank","force_delete_rank","force_delete_any_rank","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_vehicle","view_any_vehicle","create_vehicle","update_vehicle","restore_vehicle","restore_any_vehicle","replicate_vehicle","reorder_vehicle","delete_vehicle","delete_any_vehicle","force_delete_vehicle","force_delete_any_vehicle"]},{"name":"role_user","guard_name":"web","permissions":["view_device","view_any_device","create_device","update_device","restore_device","restore_any_device","replicate_device","reorder_device","delete_device","delete_any_device","force_delete_device","force_delete_any_device","view_gun","view_any_gun","create_gun","update_gun","restore_gun","restore_any_gun","replicate_gun","reorder_gun","delete_gun","delete_any_gun","force_delete_gun","force_delete_any_gun","view_member","view_any_member","create_member","update_member","restore_member","restore_any_member","replicate_member","reorder_member","delete_member","delete_any_member","force_delete_member","force_delete_any_member","view_network","view_any_network","create_network","update_network","restore_network","restore_any_network","replicate_network","reorder_network","delete_network","delete_any_network","force_delete_network","force_delete_any_network","view_radio","view_any_radio","create_radio","update_radio","restore_radio","restore_any_radio","replicate_radio","reorder_radio","delete_radio","delete_any_radio","force_delete_radio","force_delete_any_radio","view_vehicle","view_any_vehicle","create_vehicle","update_vehicle","restore_vehicle","restore_any_vehicle","replicate_vehicle","reorder_vehicle","delete_vehicle","delete_any_vehicle","force_delete_vehicle","force_delete_any_vehicle"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
