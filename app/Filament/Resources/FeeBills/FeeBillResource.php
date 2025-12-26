<?php

namespace App\Filament\Resources\FeeBills;

use App\Filament\Resources\FeeBills\Pages\CreateFeeBill;
use App\Filament\Resources\FeeBills\Pages\EditFeeBill;
use App\Filament\Resources\FeeBills\Pages\ListFeeBills;
use App\Filament\Resources\FeeBills\Schemas\FeeBillForm;
use App\Filament\Resources\FeeBills\Tables\FeeBillsTable;
use App\Models\FeeBill;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FeeBillResource extends Resource
{
    protected static ?string $model = FeeBill::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return FeeBillForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeeBillsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFeeBills::route('/'),
            'create' => CreateFeeBill::route('/create'),
            'edit' => EditFeeBill::route('/{record}/edit'),
        ];
    }
}
