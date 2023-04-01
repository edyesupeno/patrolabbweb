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
        $data = [
            [
                'title' => 'asset',
                'name'  =>  'Menu Aset',
            ], 
            [
                'title' => 'asset',
                'name'  => 'Melihat data Aset',
            ],
            [
                'title' => 'asset',
                'name'  =>  'Membuat data Aset',
            ],
            [
                'title' => 'asset',
                'name'  => 'Mengedit data Aset',
            ],
            [
                'title' => 'asset',
                'name'  => 'Melihat detail data Aset',
            ],
            [
                'title' => 'asset',
                'name'  => 'Menghapus data Aset',
            ]

        ];

        foreach ($data as $item) {
            Permission::create($item);
        }
    }
}
