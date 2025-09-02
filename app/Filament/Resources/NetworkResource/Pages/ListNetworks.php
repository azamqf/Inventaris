<?php

namespace App\Filament\Resources\NetworkResource\Pages;

use App\Filament\Resources\NetworkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CustomResource\Widgets\NetworkStats; // panggil widget

class ListNetworks extends ListRecords
{
    protected static string $resource = NetworkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            NetworkStats::class,
        ];
    }
}
