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
            $table->string('providers_name');
            $table->decimal('rate', 8, 2);
            $table->decimal('min_transaction', 15, 2);
            $table->decimal('max_transaction', 15, 2);
            $table->decimal('service_charge', 15, 2);
            $table->decimal('cost_settle', 15, 2);
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
