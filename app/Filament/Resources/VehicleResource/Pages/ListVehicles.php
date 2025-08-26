<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use App\Filament\Resources\VehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CustomResource\Widgets\VehicleOverview;

class ListVehicles extends ListRecords
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // 👉 Tambahin ini
    protected function getHeaderWidgets(): array
    {
        return [
            VehicleOverview::class,
        ];
    }
}
