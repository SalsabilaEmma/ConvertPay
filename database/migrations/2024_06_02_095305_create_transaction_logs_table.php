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
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id(); // ID transaksi
            $table->foreignId('user_id')->constrained('users'); // ID pengguna dengan relasi ke tabel users
            $table->foreignId('provider_id')->constrained('providers'); // ID provider dengan relasi ke tabel providers
            $table->string('phone_number'); // Nomor telepon dari mana pulsa dikonversi
            $table->timestamp('transaction_date'); // Tanggal dan waktu transaksi
            $table->decimal('pulsa_amount', 15, 2); // Jumlah pulsa yang dikonversi
            $table->decimal('conversion_value', 15, 2); // Nilai saldo yang diterima setelah konversi
            $table->enum('status', [0, 1, 2]); // Status transaksi
            $table->text('description')->nullable(); // Deskripsi transaksi (opsional)
            $table->decimal('balance_before', 15, 2); // Saldo sebelum transaksi
            $table->decimal('balance_after', 15, 2); // Saldo setelah transaksi
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_logs');
    }
};
