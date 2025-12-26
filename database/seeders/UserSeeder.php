<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::firstOrCreate(
    ['username' => 'admin'], // Cari berdasarkan username
    [
        'name' => 'Admin',
        'email' => 'admin@school.test',
        'password' => bcrypt('....'),
        'role' => 'admin',
    ]
);

    User::firstOrCreate(
    ['username' => 'user'], // Cari berdasarkan username
    [
        'name' => 'User',
        'email' => 'user@school.test',
        'password' => bcrypt('....'),
        'role' => 'user',
    ]
);
}
}
