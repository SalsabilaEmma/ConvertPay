<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Jam Buka
        Config::create([
            'kode' => 'jam_buka',
            'keterangan' => '08:00'
        ]);

        // Jam Tutup
        Config::create([
            'kode' => 'jam_tutup',
            'keterangan' => '17:00'
        ]);

        // Nomor Telepon
        Config::create([
            'kode' => 'no_telepon',
            'keterangan' => '081234567890'
        ]);

        // Alamat
        Config::create([
            'kode' => 'alamat',
            'keterangan' => 'Jl. Dummy No. 123'
        ]);
    }
}
