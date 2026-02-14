<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = Admin::factory(10)->create();
        foreach ($admins as $admin) {
            $admin->assignRole('admin');
        }
        $superAdmin = Admin::create(['name' => 'Super Admin', 'email' => 'karem@admin.com', 'password' => bcrypt('123456789')]);
        $superAdmin->assignRole('super_admin');
        $this->command->info('Admin seed completed.');
    }
}
