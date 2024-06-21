<?php

namespace Database\Seeders;

use App\Models\ChipLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChipLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChipLog::create([
            'kode' => 'CHIPLOG0001',
            'chip_kode' => 'CHIP0001',
            'saldo_awal' => 100000,
            'total' => 50000,
            'saldo_real' => 150000,
            'selisih' => 0,
            'keterangan' => 'Pendapatan pulsa'
        ]);
    }
}
