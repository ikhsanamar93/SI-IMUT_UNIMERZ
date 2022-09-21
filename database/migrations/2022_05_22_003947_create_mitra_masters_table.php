<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitraMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra_masters', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor', 30)->unique();
            $table->string('hp', 12)->nullable();
            $table->foreignId('unit_master_id');
            $table->string('mitra_kategori')->nullable();
            $table->string('kerjasama_kategori')->nullable();
            $table->date('tgl_kerjasama')->nullable();
            $table->integer('durasi')->nullable();
            $table->date('tgl_berakhir')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('mitra_masters');
    }
}
