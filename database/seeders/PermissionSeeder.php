<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'aset_index']);
        Permission::create(['name' => 'aset_create']);
        Permission::create(['name' => 'aset_edit']);
        Permission::create(['name' => 'aset_show']);
        Permission::create(['name' => 'aset_destroy']);
    }
}
