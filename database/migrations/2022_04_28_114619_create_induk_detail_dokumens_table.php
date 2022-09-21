<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndukDetailDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('induk_detail_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_master_id');
            $table->foreignId('mutu_dokumen_id');
            $table->foreignId('induk_master_dokumen_id');
            $table->string('nm_detail_dokumen_induk');
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
        Schema::dropIfExists('induk_detail_dokumens');
    }
}
