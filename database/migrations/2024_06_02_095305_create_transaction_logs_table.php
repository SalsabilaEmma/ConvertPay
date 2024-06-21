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
            $table->string('user_id')->nullable(); // ID pengguna
            $table->string('provider_kode')->nullable(); // ID provider
            $table->string('no_telepon'); // Nomor telepon dari mana pulsa dikonversi
            $table->timestamp('tgl_transaksi'); // Tanggal dan waktu transaksi
            $table->decimal('nominal_pulsa', 15, 2); // Jumlah pulsa yang dikonversi
            $table->decimal('nilai_konversi', 15, 2); // Nilai saldo yang diterima setelah konversi
            $table->enum('status', [0, 1, 2]); // Status transaksi
            $table->text('deskripsi')->nullable(); // Deskripsi transaksi (opsional)
            $table->decimal('balance_before', 15, 2); // Saldo sebelum transaksi
            $table->decimal('balance_after', 15, 2); // Saldo setelah transaksi
            $table->string('metode_pembayaran');
            $table->string('no_rekening');
            $table->string('atas_nama');
            $table->timestamps(); // Timestamps untuk created_at dan updated_at

            // Optional: Add foreign key constraints without automatic deletion on related record deletion
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            // $table->foreign('provider_kode')->references('kode')->on('providers')->onDelete('restrict');
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
