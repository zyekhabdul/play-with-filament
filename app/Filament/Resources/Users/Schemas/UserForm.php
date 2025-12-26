<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Hash;
use Filament\Schemas\Schema;

class UserForm
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
                        TextInput::make('username')
                        ->required()
                        ->maxLength(255),
                        Select::make('role')
                        ->required()
                        ->options([
                            'admin' => 'Admin',
                            'user' => 'User',
                        ]),
                        TextInput::make('email')
                        ->type('email')
                        ->required()
                        ->unique(),
                        TextInput::make('password')
                        ->type('password')
                        ->password()
                        ->revealable()
                        ->required()
                        ->minLength(4)
                        ->dehydrateStateUsing(fn (string $state): string => Hash::make($state)),


            ])
            ->columnSpanFull()
            ->columns(2)
        ]);
    }
}
