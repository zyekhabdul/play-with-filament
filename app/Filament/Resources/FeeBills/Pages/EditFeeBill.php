<?php

namespace App\Filament\Resources\FeeBills\Pages;

use App\Filament\Resources\FeeBills\FeeBillResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFeeBill extends EditRecord
{
    protected static string $resource = FeeBillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
