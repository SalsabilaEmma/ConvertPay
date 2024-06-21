<?php

namespace Database\Seeders;

use App\Models\Providers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Providers::create([
            'kode' => 'PROVIDER0001',
            'nama' => 'axis',
            'rate' => 80,
            'min_transaksi' => 10000,
            'max_transaksi' => 1000000,
            'biaya_admin' => 5000,
            'saldo_mengendap' => 20000,
            'image' => 'https://example.com/images/bank_a.png'
        ]);
    }
}
