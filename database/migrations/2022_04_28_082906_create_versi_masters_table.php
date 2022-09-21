<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersiMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versi_masters', function (Blueprint $table) {
            $table->id();
            $table->string('nm_versi')->unique();
            $table->string('no_versi', 30)->nullable();
            $table->string('no_pengesahan_versi', 30)->nullable();
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
        Schema::dropIfExists('versi_masters');
    }
}
