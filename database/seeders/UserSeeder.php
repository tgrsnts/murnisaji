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
        // Admin
        User::create([
            'role' => 1,
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'email' => 'admin@example.com',
            'telp' => '081234567890',
            'name' => 'Admin',
            'gambar' => null,
        ]);

        // Customer 1
        User::create([
            'role' => 0,
            'username' => 'user1',
            'password' => Hash::make('password'),
            'email' => 'user1@example.com',
            'telp' => '081234567891',
            'name' => 'Tegar',
            'gambar' => null,
        ]);

        // Customer 2
        User::create([
            'role' => 0,
            'username' => 'budi',
            'password' => Hash::make('password'),
            'email' => 'budi@example.com',
            'telp' => '081234567892',
            'name' => 'Budi Santoso',
            'gambar' => null,
        ]);

        // Customer 3
        User::create([
            'role' => 0,
            'username' => 'siti',
            'password' => Hash::make('password'),
            'email' => 'siti@example.com',
            'telp' => '081234567893',
            'name' => 'Siti Nurhaliza',
            'gambar' => null,
        ]);

        // Customer 4
        User::create([
            'role' => 0,
            'username' => 'ahmad',
            'password' => Hash::make('password'),
            'email' => 'ahmad@example.com',
            'telp' => '081234567894',
            'name' => 'Ahmad Dhani',
            'gambar' => null,
        ]);

        // Customer 5
        User::create([
            'role' => 0,
            'username' => 'rina',
            'password' => Hash::make('password'),
            'email' => 'rina@example.com',
            'telp' => '081234567895',
            'name' => 'Rina Kartika',
            'gambar' => null,
        ]);
    }
}

