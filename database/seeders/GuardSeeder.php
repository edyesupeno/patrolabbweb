<?php

namespace Database\Seeders;

use App\Models\Guard;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guard::create([
            'no_badge' => '123456',
            'nama' => 'AGUS',
            'ttl' => '1990-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'email' => 'agus@gmail.com',
            'wa' => '08123456789',
            'alamat' => 'Jl. Raya',
            'id_wilayah' => 1,
            'id_area' => 1,
            'id_shift' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
