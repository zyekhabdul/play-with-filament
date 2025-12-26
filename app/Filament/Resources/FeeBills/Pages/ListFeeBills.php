<?php

namespace App\Filament\Resources\FeeBills\Pages;

use App\Filament\Resources\FeeBills\FeeBillResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFeeBills extends ListRecords
{
    protected static string $resource = FeeBillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
