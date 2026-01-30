<?php

namespace App\Filament\Resources\CarMakerResource\Pages;

use App\Filament\Resources\CarMakerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarMakers extends ListRecords
{
    protected static string $resource = CarMakerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
