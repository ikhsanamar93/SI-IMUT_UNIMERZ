<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuesionerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuesioner_master_id');
            $table->text('pertanyaan');
            $table->string('jawaban_1');
            $table->string('jawaban_2');
            $table->string('jawaban_3');
            $table->string('jawaban_4');
            $table->string('jawaban_5')->nullable();
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
        Schema::dropIfExists('kuesioner_details');
    }
}
