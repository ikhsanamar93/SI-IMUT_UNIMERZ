<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkreditasiPeriodeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akreditasi_periode_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akreditasi_periode_id');
            $table->foreignId('akreditasi_kategori_id');
            $table->foreignId('akreditasi_master_id');
            $table->longText('daftar_tilik')->nullable();
            $table->longText('observasi')->nullable();
            $table->string('temuan')->nullable();
            $table->longText('uraian_temuan')->nullable();
            $table->double('skor')->nullable();
            $table->double('bobot_penilaian')->nullable();
            $table->double('perolehan_skor')->nullable();
            $table->longText('rekomendasi')->nullable();
            $table->longText('praktek_baik')->nullable();
            $table->longText('efektifitas_rtk')->nullable();
            $table->longText('rtk')->nullable();
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
        Schema::dropIfExists('akreditasi_periode_details');
    }
}
