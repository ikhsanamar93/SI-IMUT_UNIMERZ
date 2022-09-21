<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyPeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_periodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_master_id');
            $table->foreignId('mutu_periode_id');
            $table->foreignId('kuesioner_master_id');
            $table->foreignId('monev_master_dokumen_id');
            $table->string('semester', 6);
            $table->boolean('responden_mahasiswa')->nullable();
            $table->boolean('responden_dosen')->nullable();
            $table->boolean('responden_tendik')->nullable();
            $table->boolean('responden_alumni')->nullable();
            $table->boolean('responden_mitra')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('survey_periodes');
    }
}
