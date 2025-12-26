<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FeePackage;

class FeePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeePackage::create([
        'academic_year' => '2024/2025',
        'amount' => 300000,
        'description' => 'SPP Bulanan',
    ]);
    }
}
