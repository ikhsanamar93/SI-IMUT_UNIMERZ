<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutuPeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutu_periodes', function (Blueprint $table) {
            $table->id();
            $table->string('siklus', 15)->unique();
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->boolean('akreditasi')->nullable();
            $table->boolean('spmi')->nullable();
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
        Schema::dropIfExists('mutu_periodes');
    }
}
