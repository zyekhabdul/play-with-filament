<?php

namespace App\Filament\User\Resources\SchoolClasses\Pages;

use App\Filament\User\Resources\SchoolClasses\SchoolClassResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchoolClasses extends ListRecords
{
    protected static string $resource = SchoolClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
