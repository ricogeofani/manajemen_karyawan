<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->char('foto', 100);
            $table->string('nama', 100);
            $table->string('email', 100);
            $table->string('telp', 100);
            $table->text('alamat');
            $table->char('gender', 1);
            $table->enum('jabatan', ['manager', 'admin', 'staff', 'hrd']);
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
        Schema::dropIfExists('karyawans');
    }
}
