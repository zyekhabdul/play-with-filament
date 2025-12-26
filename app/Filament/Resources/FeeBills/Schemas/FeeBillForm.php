<?php

namespace App\Filament\Resources\FeeBills\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FeeBillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_id')
                    ->required()
                    ->numeric(),
                TextInput::make('fee_package_id')
                    ->required()
                    ->numeric(),
                TextInput::make('month')
                    ->required(),
                TextInput::make('year')
                    ->required(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                Select::make('payment_status')
                    ->options(['unpaid' => 'Unpaid', 'paid' => 'Paid'])
                    ->default('unpaid')
                    ->required(),
            ]);
    }
}
