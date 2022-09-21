<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmiPeriodeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ami_periode_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ami_periode_id');
            $table->foreignId('ami_periode_master_id');
            $table->foreignId('spmi_standar_master_id');
            $table->foreignId('spmi_standar_detail_id');
            $table->longText('daftar_tilik')->nullable();
            $table->longText('observasi')->nullable();
            $table->string('temuan')->nullable();
            $table->longText('uraian_temuan')->nullable();
            $table->longText('akar_masalah')->nullable();
            $table->longText('peluang_peningkatan')->nullable();
            $table->longText('rekomendasi')->nullable();
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
        Schema::dropIfExists('ami_periode_details');
    }
}
