<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hak_akses', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->string('permission_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hak_akses');
    }
};
