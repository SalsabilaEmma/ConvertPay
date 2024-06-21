<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promo::create([
            'kode' => 'PROMO0002',
            'judul' => 'Promo Spesial',
            'deskripsi' => 'Dapatkan diskon hingga 50% untuk produk-produk pilihan',
            'image' => 'promo.jpg',
            'status' => '0'
        ]);
    }
}
