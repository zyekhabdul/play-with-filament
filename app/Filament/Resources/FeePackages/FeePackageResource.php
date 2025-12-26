<?php

namespace App\Filament\Resources\FeePackages;

use App\Filament\Resources\FeePackages\Pages\CreateFeePackage;
use App\Filament\Resources\FeePackages\Pages\EditFeePackage;
use App\Filament\Resources\FeePackages\Pages\ListFeePackages;
use App\Filament\Resources\FeePackages\Schemas\FeePackageForm;
use App\Filament\Resources\FeePackages\Tables\FeePackagesTable;
use App\Models\FeePackage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FeePackageResource extends Resource
{
    protected static ?string $model = FeePackage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return FeePackageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeePackagesTable::configure($table);
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
            'index' => ListFeePackages::route('/'),
            'create' => CreateFeePackage::route('/create'),
            'edit' => EditFeePackage::route('/{record}/edit'),
        ];
    }
}
