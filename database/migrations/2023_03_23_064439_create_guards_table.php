<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guards', function (Blueprint $table) {
            $table->id();
            $table->string('no_badge')->unique();
            $table->string('nama');
            $table->string('ttl');
            $table->string('jenis_kelamin');
            $table->string('email');
            $table->string('wa');
            $table->string('alamat');
            $table->enum('jabatan',['Admin','Arco','Security Officer']);
            $table->foreignId('id_wilayah');
            $table->foreignId('id_project');
            $table->foreignId('id_area');
            $table->foreignId('id_shift');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guards');
    }
};
