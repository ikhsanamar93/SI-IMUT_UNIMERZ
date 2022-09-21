<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpmiDetailDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spmi_detail_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_master_id');
            $table->foreignId('spmi_master_dokumen_id');
            $table->string('nm_detail_spmi');
            $table->string('no_detail_spmi', 30)->nullable();
            $table->foreignId('mutu_kategori_id');
            $table->string('file_spmi')->nullable();
            $table->text('link_spmi')->nullable();
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
        Schema::dropIfExists('spmi_detail_dokumens');
    }
}
