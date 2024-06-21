<?php

namespace Database\Seeders;

use App\Models\Chip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chip::create([
            'kode' => 'CHIP0001',
            'no_telepon' => '081234567890',
            'keterangan' => 'Lorem Ipsum'
        ]);
    }
}
