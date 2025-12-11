<?php

namespace App\Filament\Resources\Users\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->type('email')
                    ->required()
                    ->unique(),
                TextInput::make('password')
                    ->type('password')
                    ->password()
                    ->required()
                    ->minLength(8),
            ]);
    }
}
