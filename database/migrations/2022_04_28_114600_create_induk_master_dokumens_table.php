<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndukMasterDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('induk_master_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('nm_dokumen_induk');
            $table->string('no_dokumen_induk', 30)->nullable();
            $table->foreignId('mutu_dokumen_id');
            $table->foreignId('unit_master_id');
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('induk_master_dokumens');
    }
}
