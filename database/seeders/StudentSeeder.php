<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::insert([
        [
            'nis' => '2023001',
            'name' => 'Andi',
            'class' => 'XI PPLG',
            'address' => 'Jl. Mawar',
            'phone_number' => '08123456789',
            'is_active' => 1,
        ],
        [
            'nis' => '2023002',
            'name' => 'Budi',
            'class' => 'XI TKP',
            'address' => 'Jl. Melati',
            'phone_number' => '08123456788',
            'is_active' => 1,
        ],
        [
            'nis' => '2023003',
            'name' => 'Citra',
            'class' => 'XI UPT',
            'address' => 'Jl. Kenanga',
            'phone_number' => '08123456787',
            'is_active' => 0,
        ],
    ]);
    }
}
