<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respon_masters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_periode_id');
            $table->foreignId('unit_master_id');
            $table->foreignId('mutu_periode_id');
            $table->foreignId('kuesioner_master_id');
            $table->tinyInteger('responden_kategori');
            $table->tinyInteger('responden_target');
            $table->bigInteger('responden_id')->nullable();
            $table->text('responden_ket')->nullable();
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
        Schema::dropIfExists('respon_masters');
    }
}
