<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respon_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_periode_id');
            $table->foreignId('unit_master_id');
            $table->foreignId('mutu_periode_id');
            $table->foreignId('kuesioner_master_id');
            $table->foreignId('kuesioner_detail_id');
            $table->foreignId('respon_master_id');
            $table->tinyInteger('responden_kategori')->nullable();
            $table->bigInteger('responden_id')->nullable();
            $table->tinyInteger('jawaban');
            $table->tinyInteger('jawaban_1');
            $table->tinyInteger('jawaban_2');
            $table->tinyInteger('jawaban_3');
            $table->tinyInteger('jawaban_4');
            $table->tinyInteger('jawaban_5');
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
        Schema::dropIfExists('respon_details');
    }
}
