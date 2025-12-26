<?php

namespace App\Filament\Resources\FeePackages\Pages;

use App\Filament\Resources\FeePackages\FeePackageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFeePackages extends ListRecords
{
    protected static string $resource = FeePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
