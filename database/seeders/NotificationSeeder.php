<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::create([
            'kode' => 'NOTIF0001',
            'judul' => 'Judul Dummy',
            'link' => 'https://www.youtube.com/'
        ]);
    }
}
