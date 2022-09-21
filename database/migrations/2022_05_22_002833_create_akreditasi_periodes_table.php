<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkreditasiPeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akreditasi_periodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akreditasi_kategori_id');
            $table->foreignId('mutu_periode_id');
            $table->foreignId('unit_master_id');
            $table->foreignId('auditee_id');
            $table->foreignId('asesor1_id');
            $table->foreignId('asesor2_id');
            $table->foreignId('observer_id');
            $table->date('tgl_periode_akreditasi');
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
        Schema::dropIfExists('akreditasi_periodes');
    }
}
