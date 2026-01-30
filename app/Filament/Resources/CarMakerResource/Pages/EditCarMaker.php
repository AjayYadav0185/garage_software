<?php

namespace App\Filament\Resources\CarMakerResource\Pages;

use App\Filament\Resources\CarMakerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarMaker extends EditRecord
{
    protected static string $resource = CarMakerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
