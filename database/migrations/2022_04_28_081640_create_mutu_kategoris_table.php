<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutuKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutu_kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nm_kategori_mutu')->unique();
            $table->string('no_kategori_mutu', 30)->nullable();
            $table->foreignId('mutu_sistem_id');
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
        Schema::dropIfExists('mutu_kategoris');
    }
}
