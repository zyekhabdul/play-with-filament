<?php

namespace App\Filament\Resources\FeePackages\Pages;

use App\Filament\Resources\FeePackages\FeePackageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFeePackage extends EditRecord
{
    protected static string $resource = FeePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

