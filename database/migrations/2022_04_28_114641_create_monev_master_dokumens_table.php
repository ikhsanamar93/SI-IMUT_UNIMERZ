<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonevMasterDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monev_master_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('semester', 6);
            // $table->foreignId('monev_kategori_id');
            $table->foreignId('mutu_periode_id');
            $table->foreignId('unit_master_id');
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
        Schema::dropIfExists('monev_master_dokumens');
    }
}
