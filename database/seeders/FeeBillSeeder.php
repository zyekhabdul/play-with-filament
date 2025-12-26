<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FeeBill;

class FeeBillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeeBill::insert([
        [
            'student_id' => 1,
            'fee_package_id' => 1,
            'month' => 1,
            'year' => 2025,
            'total_amount' => 300000,
            'payment_status' => 'paid',
        ],
        [
            'student_id' => 2,
            'fee_package_id' => 1,
            'month' => 1,
            'year' => 2025,
            'total_amount' => 300000,
            'payment_status' => 'partial',
        ],
        [
            'student_id' => 3,
            'fee_package_id' => 1,
            'month' => 1,
            'year' => 2025,
            'total_amount' => 300000,
            'payment_status' => 'unpaid',
        ],
    ]);
    }
}
