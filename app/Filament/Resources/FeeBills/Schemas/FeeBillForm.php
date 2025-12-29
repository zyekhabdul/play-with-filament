<?php

namespace App\Filament\Resources\FeeBills\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Utilities\Set;
use Filament\Forms\Components\Utilities\Get;

class FeeBillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->label('Student')
                    ->relationship(
                        name: 'student',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) =>
                        $query->where('is_active', 1)
                    )
                    ->searchable()
                    ->required()
                    ->disabled(fn ($livewire) => $livewire instanceof EditRecord)
                    ->dehydrated(fn ($livewire) => ! ($livewire instanceof EditRecord)),
                Select::make('fee_package_id')
                    ->label('Fee Package')
                    ->relationship('feePackage', 'description')
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set) {
                        $package = \App\Models\FeePackage::find($state);

                        if ($package) {
                            $set('total_amount', $package->amount);
                        }
                    })
                    ->afterStateHydrated(function ($state, $set) {
                        $package = \App\Models\FeePackage::find($state);
                        if ($package) {
                            $set('total_amount', $package->amount);
                        }
                    }),
                Select::make('month')
                    ->options([
                        1 => 'January',
                        2 => 'February',
                        3 => 'March',
                        4 => 'April',
                        5 => 'May',
                        6 => 'June',
                        7 => 'July',
                        8 => 'August',
                        9 => 'September',
                        10 => 'October',
                        11 => 'November',
                        12 => 'December',
                    ])
                    ->required(),
                TextInput::make('year')
                    ->required(),
                TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->numeric()
                    ->required()
                    ->disabled()
                    ->dehydrated(),
                // Select::make('payment_status')
                //     ->options([
                //         'unpaid' => 'Unpaid',
                //         'partial' => 'Partial',
                //         'paid' => 'Paid'
                //         ,])
                //     ->disabled()
                //     ->required()
                //     ->disabled(fn ($record) => $record?->payment_status === 'paid')
                //     ->dehydrated(fn ($record) => $record?->payment_status !== 'paid')
                //     ->dehydrated(false),
            ]);
    }
}
