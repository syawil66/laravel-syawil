<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Admin
        User::create([
            'name' => 'Syawil Admin',
            'email' => 'syawiladmin@gmail.com',
            'password' => Hash::make('12123344'),
            'role' => 'admin',
            'alamat' => 'banda',
            'no_telp' => '081234567890',
        ]);

        // User Biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'alamat' => 'banda',
            'no_telp' => '081234567890',
        ]);
    }
}
