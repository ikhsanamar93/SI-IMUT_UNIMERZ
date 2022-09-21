<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkreditasiMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akreditasi_masters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akreditasi_kategori_id');
            $table->foreignId('monev_kategori_id');
            $table->string('jenis_dokumen', 7)->nullable();
            $table->string('no_akreditasi_master', 30)->nullable();
            $table->string('elemen')->nullable();
            $table->longText('indikator');
            $table->longText('indikator_kinerja');
            $table->text('dokumen_terkait')->nullable();
            $table->double('bobot_penilaian');
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
        Schema::dropIfExists('akreditasi_masters');
    }
}
