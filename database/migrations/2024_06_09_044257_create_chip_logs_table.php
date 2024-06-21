<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chip_logs', function (Blueprint $table) {
            $table->id();
            // chip, saldo awal, today (pendapatan pulsa), total, real, selisih, ket(limit/kosong),
            $table->string('kode'); // kode master chip
            $table->string('chip_kode'); // kode master chip
            $table->decimal('saldo_awal');
            // $table->decimal('total'); //today
            $table->decimal('total');
            $table->decimal('saldo_real');
            $table->decimal('selisih');
            $table->string('keterangan');
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
        Schema::dropIfExists('chip_logs');
    }
};
