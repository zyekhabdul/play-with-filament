<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            // Section::make()
            //     ->schema([
            //         TextEntry::make('name')
            //             ->label('Full Name'),
            //         TextEntry::make('username'),
            //         TextEntry::make('email'),
            //         TextEntry::make('created_at')
            //             ->dateTime(),
            //     ])
            //     ->columnSpanFull()
            //     ->columns(2)
            ]);
    }
}
