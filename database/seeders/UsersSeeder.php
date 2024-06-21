<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John Doe si Super Admin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => '0', // Assuming '2' is the default role for regular users
            'image' => null, // You can set a default image path here if needed
        ]);

        User::create([
            'name' => 'Customer Service',
            'email' => 'cs@example.com',
            'password' => Hash::make('password'),
            'role' => 1, // Role admin
            'image' => 'admin.jpg', // Nama file gambar admin
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 2, // Role user
            'image' => 'user.jpg', // Nama file gambar user
        ]);
    }
}
