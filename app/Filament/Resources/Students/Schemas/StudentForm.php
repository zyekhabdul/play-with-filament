<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Select::make('class')
                            ->options([
                                'X PPLG' => 'X PPLG',
                                'XI PPLG' => 'XI PPLG',
                                'X TKP' => 'X TKP',
                                'XI TKP' => 'XI TKP',
                                'X UPT' => 'X UPT',
                                'XI UPT' => 'XI UPT',
                            ])
                            ->required(),
                        TextInput::make('nis')
                            ->required()
                            ->unique()
                            ->maxLength(10)
                            ->minLength(7)
                            ->numeric()
                            ->placeholder('ex: 2023002'),
                        TextInput::make('address')
                            ->required()
                            ->maxLength(500),
                        TextInput::make('phone_number')
                            ->required()
                            ->maxLength(20),
                        Select::make('is_active')
                            ->required()
                            ->options([
                                1 => 'Active',
                                0 => 'Inactive',
                            ]),
                    ])
                    ->columnSpanFull()
                    ->columns(2)
            ]);
    }

    public static function form(Schema $schema): Schema
{
    return StudentForm::configure($schema);
}
}
