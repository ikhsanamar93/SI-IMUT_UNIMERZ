<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_masters', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor', 30)->unique();
            $table->string('nik', 20)->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('hp', 12)->nullable();
            $table->string('email')->unique()->nullable();
            $table->date('tgl_yudisium')->nullable();
            $table->string('sk_yudisium')->nullable();
            $table->date('tgl_ijazah')->nullable();
            $table->string('no_ijazah')->nullable();
            $table->foreignId('unit_master_id')->nullable();
            $table->foreignId('fakultas_id')->nullable();
            $table->foreignId('angkatan_id')->nullable();
            $table->foreignId('daerah_id')->nullable();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('alumni_masters');
    }
}
