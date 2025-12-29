<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('payment_date')
                    ->label('Payment Date')
                    ->type('date')
                    ->required(),
                Select::make('fee_bill_id')
                    ->label('Fee Bill')
                    ->relationship(
                        'feeBill',
                        'payment_status', // 👈 any real column
                        fn ($query) => $query->whereIn('payment_status', ['unpaid', 'partial'])
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                        $record->student->name
                        . ' - '
                        . $record->month . '/' . $record->year
                        . ' (Rp ' . number_format($record->total_amount) . ')'
                    )
                    ->searchable(['payment_status']) // 👈 explicit
                    ->required()
                    ->preload()
                    ->searchable(),
                TextInput::make('amount_paid')
                    ->label('Amount Paid')
                    ->numeric()
                    ->minValue(1)
                    ->prefix('Rp')
                    ->required(),
                TextInput::make('notes')
                    ->label('Notes')
                    ->nullable(),
                // Hidden::make('user_id')
                //     ->default(auth()->user()?->id)
                //     ->dehydrated(true)
                //     ->required(),
            ]);
    }
}
