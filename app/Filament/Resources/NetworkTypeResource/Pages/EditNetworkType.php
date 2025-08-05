<?php

namespace App\Filament\Resources\NetworkTypeResource\Pages;

use App\Filament\Resources\NetworkTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNetworkType extends EditRecord
{
    protected static string $resource = NetworkTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
