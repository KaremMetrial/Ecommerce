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
        $this->command->info('Admin seed completed.');
    }
}
