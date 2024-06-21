<?php

namespace Database\Seeders;

use App\Models\TransactionLogs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionLogs::create([
            'user_id' => 1,
            'provider_kode' => 'PROVIDER0001',
            'no_telepon' => '081234567890',
            'tgl_transaksi' => '2023-06-01 12:00:00',
            'nominal_pulsa' => 100000.00,
            'nilai_konversi' => 95000.00,
            'status' => 1,
            'deskripsi' => 'Transaksi berhasil',
            'balance_before' => 500000.00,
            'balance_after' => 595000.00,
            'metode_pembayaran' => 'Transfer Bank',
            'no_rekening' => '1234567890',
            'atas_nama' => 'John Doe'
        ]);
    }
}
