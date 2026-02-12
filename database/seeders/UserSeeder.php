<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role' => 1,
            'username' => 'admin',
            'password' => Hash::make('password'),
            'email' => 'admin@example.com',
            'telp' => '081234567890',
            'name' => 'Admin',
            'gambar' => null,
        ]);

        User::create([
            'role' => 0,
            'username' => 'user1',
            'password' => Hash::make('password'),
            'email' => 'user1@example.com',
            'telp' => '081234567891',
            'name' => 'User Satu',
            'gambar' => null,
        ]);
    }
}
