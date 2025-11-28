<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@nauticaedu.com',
            'password' => Hash::make('password123'), // ganti jika mau
            'role' => 'admin',
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);
    }
}
