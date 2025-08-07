<?php

namespace App\Filament\Resources\GunTypeResource\Pages;

use App\Filament\Resources\GunTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGunTypes extends ListRecords
{
    protected static string $resource = GunTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
