<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutuDetailDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutu_detail_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_master_id');
            $table->foreignId('mutu_periode_id');
            $table->foreignId('mutu_dokumen_id');
            $table->foreignId('mutu_master_dokumen_id');
            $table->string('nm_detail_dokumen_mutu');
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
        Schema::dropIfExists('mutu_detail_dokumens');
    }
}
