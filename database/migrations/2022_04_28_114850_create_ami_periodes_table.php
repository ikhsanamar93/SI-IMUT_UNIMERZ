<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmiPeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ami_periodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mutu_periode_id');
            $table->foreignId('unit_master_id');
            $table->foreignId('auditee_id');
            $table->foreignId('auditor1_id');
            $table->foreignId('auditor2_id');
            $table->foreignId('observer_id');
            $table->date('tgl_periode_ami');
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
        Schema::dropIfExists('ami_periodes');
    }
}
