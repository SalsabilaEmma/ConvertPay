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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->decimal('rate', 8, 2);
            $table->decimal('min_transaksi', 15, 2);
            $table->decimal('max_transaksi', 15, 2);
            $table->decimal('biaya_admin', 15, 2);
            $table->decimal('saldo_mengendap', 15, 2);
            // $table->decimal('cost_settle', 15, 2);
            $table->text('image')->nullable();
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
        Schema::dropIfExists('providers');
    }
};
