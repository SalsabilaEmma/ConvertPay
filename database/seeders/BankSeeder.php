<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create([
            'kode' => 'BANK0001',
            'nama' => 'Bank Central Asia',
            'kode_transfer' => '014',
            'biaya_admin' => 5000
        ]);

        Bank::create([
            'kode' => 'BANK0002',
            'nama' => 'DANA',
            'kode_transfer' => '0149304233',
            'biaya_admin' => 0
        ]);
    }
}
