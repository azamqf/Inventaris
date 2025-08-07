<?php

namespace App\Filament\Resources\GunResource\Pages;

use App\Filament\Resources\GunResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuns extends ListRecords
{
    protected static string $resource = GunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
