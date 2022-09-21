<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkreditasiMasterDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akreditasi_master_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akreditasi_periode_id');
            $table->foreignId('akreditasi_master_id');
            $table->foreignId('unit_master_id');
            $table->foreignId('mutu_periode_id');
            $table->bigInteger('dokumen_kategori');
            $table->foreignId('induk_master_dokumen_id')->nullable();
            $table->foreignId('mutu_detail_dokumen_id')->nullable();
            $table->foreignId('monev_detail_dokumen_id')->nullable();
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
        Schema::dropIfExists('akreditasi_master_dokumens');
    }
}
