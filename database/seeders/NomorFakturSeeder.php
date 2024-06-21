<?php

namespace Database\Seeders;

use App\Models\NomorFaktur;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NomorFakturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        NomorFaktur::create([
            'kode' => 'BANK',
            'nomor' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        NomorFaktur::create([
            'kode' => 'CHIP',
            'nomor' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        NomorFaktur::create([
            'kode' => 'CONFIG',
            'nomor' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        NomorFaktur::create([
            'kode' => 'NOTIF',
            'nomor' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        NomorFaktur::create([
            'kode' => 'PROMO',
            'nomor' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        NomorFaktur::create([
            'kode' => 'PROVIDER',
            'nomor' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        NomorFaktur::create([
            'kode' => 'TRANSAKSILOG',
            'nomor' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        NomorFaktur::create([
            'kode' => 'CHIPLOG',
            'nomor' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
