<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutuDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutu_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('nm_dokumen_mutu')->unique();
            $table->string('no_dokumen_mutu', 30)->nullable();
            $table->string('jenis_dokumen_mutu');
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('mutu_dokumens');
    }
}
