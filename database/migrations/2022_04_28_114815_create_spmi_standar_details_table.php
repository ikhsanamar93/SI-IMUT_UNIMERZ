<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpmiStandarDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spmi_standar_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spmi_standar_master_id');
            $table->foreignId('unit_master_id');
            $table->tinyInteger('poin');
            $table->longText('pernyataan')->nullable();
            $table->longText('strategi')->nullable();
            $table->longText('indikator')->nullable();
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
        Schema::dropIfExists('spmi_standar_details');
    }
}
