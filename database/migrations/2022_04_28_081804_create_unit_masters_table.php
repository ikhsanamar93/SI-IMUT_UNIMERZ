<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_masters', function (Blueprint $table) {
            $table->id();
            $table->string('nm_unit')->unique();
            $table->string('no_unit', 30)->nullable();
            $table->string('no_penetapan_unit', 30)->nullable();
            $table->date('tgl_penetapan_unit')->nullable();
            $table->foreignId('unit_kategori_id');
            $table->foreignId('unit_pengelola_id');
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('unit_masters');
    }
}
