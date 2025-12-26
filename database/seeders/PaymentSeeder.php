<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::insert([
        [
            'fee_bill_id' => 1,
            'user_id' => 1,
            'payment_date' => now(),
            'amount_paid' => 300000,
            'notes' => 'Paid in full',
        ],
        [
            'fee_bill_id' => 2,
            'user_id' => 1,
            'payment_date' => now(),
            'amount_paid' => 150000,
            'notes' => 'First payment',
        ],
    ]);
    }
}
