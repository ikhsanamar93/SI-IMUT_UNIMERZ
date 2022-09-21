<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpmiKalendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spmi_kalenders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ami_id')->nullable();
            $table->foreignId('akreditasi_id')->nullable();
            $table->string('title');
            $table->foreignId('unit_master_id');
            $table->foreignId('auditee_id');
            $table->foreignId('auditor_1');
            $table->foreignId('auditor_2');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('spmi_kalenders');
    }
}
