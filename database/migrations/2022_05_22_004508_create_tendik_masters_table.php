<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendikMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tendik_masters', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_kategori')->nullable();
            $table->string('nama');
            $table->string('nomor', 30)->unique();
            $table->string('nik', 20)->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('hp', 12)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('alamat')->nullable();
            $table->foreignId('unit_master_id');
            $table->foreignId('fakultas_id')->nullable();
            $table->foreignId('prodi_id')->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('tendik_masters');
    }
}
