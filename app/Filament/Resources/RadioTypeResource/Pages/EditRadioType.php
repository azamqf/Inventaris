<?php

namespace App\Filament\Resources\RadioTypeResource\Pages;

use App\Filament\Resources\RadioTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRadioType extends EditRecord
{
    protected static string $resource = RadioTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
