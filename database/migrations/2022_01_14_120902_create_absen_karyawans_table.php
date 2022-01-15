<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_karyawans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->boolean('absen');
            $table->unsignedBigInteger('id_karyawan');
            $table->timestamps();

            $table->foreign('id_karyawan')->references('id')->on('karyawans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen_karyawans');
    }
}
