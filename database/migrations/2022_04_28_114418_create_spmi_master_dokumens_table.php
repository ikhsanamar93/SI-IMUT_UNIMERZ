<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpmiMasterDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spmi_master_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('nm_spmi');
            $table->string('no_spmi', 30)->nullable();
            $table->foreignId('mutu_sistem_id');
            $table->foreignId('unit_master_id');
            $table->foreignId('versi_master_id');
            $table->boolean('status_spmi')->nullable();
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
        Schema::dropIfExists('spmi_master_dokumens');
    }
}
