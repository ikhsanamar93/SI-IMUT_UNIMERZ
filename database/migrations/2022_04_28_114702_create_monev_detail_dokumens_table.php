<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonevDetailDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monev_detail_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_master_id');
            $table->foreignId('mutu_periode_id');
            $table->foreignId('monev_master_dokumen_id');
            $table->foreignId('spmi_standar_master_id');
            $table->foreignId('mutu_dokumen_id');
            $table->string('kinerja_kategori');
            $table->string('nm_dokumen_monev')->nullable();
            $table->string('file_dokumen')->nullable();
            $table->text('link_dokumen')->nullable();
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
        Schema::dropIfExists('monev_detail_dokumens');
    }
}
