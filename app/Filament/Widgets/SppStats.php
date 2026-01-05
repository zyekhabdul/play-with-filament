<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\FeeBill;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class SppStats extends BaseWidget
{
    protected function getStats(): array
    {
        // 1. Calculate the sum first to avoid the 'undefined variable' error
        $monthlyPayments = Payment::whereMonth('payment_date', Carbon::now()->month)
            ->whereYear('payment_date', Carbon::now()->year) // Recommended: filter by current year too
            ->sum('amount_paid');

        return [
            Stat::make('Total Students', Student::count()),

            Stat::make(
                'Active Students',
                Student::where('is_active', true)->count()
            ),

            Stat::make(
                'Unpaid / Partial SPP',
                FeeBill::whereIn('payment_status', ['unpaid', 'partial'])->count()
            ),

            // 2. Use the variable here
            Stat::make('Payments This Month', 'Rp ' . number_format($monthlyPayments, 0, ',', '.'))
                ->description('Total collected this month')
                // ->chart([7, 2, 10, 3, 15, 4, 17]) // Optional: adds a visual trend
                // ->color('success'),
        ];
    }
}
