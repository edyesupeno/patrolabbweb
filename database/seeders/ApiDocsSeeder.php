<?php

namespace Database\Seeders;

use App\Models\ApiDocs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiDocsSeeder extends Seeder
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
                'nama'=>'Login',
                'endpoint'=>route('login.api'),
                'method'=>'post',
                'response'=>'{}'
            ],
            [
                'nama'=>'Data User Yang Login',
                'method'=>'get',
                'endpoint'=>route('me.api'),
                'response'=>'{}'
            ]
        ];
        foreach ($data as $item) {
            ApiDocs::create($item);
        }
    }
}
