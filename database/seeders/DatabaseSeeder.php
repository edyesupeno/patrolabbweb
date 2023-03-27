<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
         Role::create(['name' => 'super-admin']);
         Role::create(['name' => 'user']);
         $this->call(PermissionSeeder::class);
        $user = User::create([
            'name' => 'super-admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        $user->assignRole('super-admin');

    }
}
