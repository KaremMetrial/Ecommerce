<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class AdminAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            'admins',
        ];

        $adminRole = Role::updateOrCreate(['name' => 'admin'], ['guard_name' => 'admin']);
        $superAdminRole = Role::updateOrCreate(['name' => 'super_admin'], ['guard_name' => 'admin']);

        $permissions = [];

        foreach ($models as $model) {
            $permissions[] = Permission::updateOrCreate(['name' => "create {$model}"], ['guard_name' => 'admin']);
            $permissions[] = Permission::updateOrCreate(['name' => "read {$model}"], ['guard_name' => 'admin']);
            $permissions[] = Permission::updateOrCreate(['name' => "update {$model}"], ['guard_name' => 'admin']);
            $permissions[] = Permission::updateOrCreate(['name' => "delete {$model}"], ['guard_name' => 'admin']);
        }

        $adminRole->givePermissionTo($permissions);
        $superAdminRole->givePermissionTo($permissions);

        $this->command->info('Admin and permission seed completed.');
    }
}
