<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BankSeeder::class,
            ChipsSeeder::class,
            ConfigSeeder::class,
            NomorFakturSeeder::class,
            NotificationSeeder::class,
            PromoSeeder::class,
            ProviderSeeder::class,
            TransaksiSeeder::class,
            ChipLogSeeder::class,
            // tambahkan seeder lain di sini jika ada
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
