<?php

namespace App\Filament\Resources\RadioResource\Pages;

use App\Filament\Resources\RadioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CustomResource\Widgets\RadioOverview;

class ListRadios extends ListRecords
{
    protected static string $resource = RadioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            RadioOverview::class,
        ];
    }
}
