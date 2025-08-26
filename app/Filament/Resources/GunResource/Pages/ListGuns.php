<?php

namespace App\Filament\Resources\GunResource\Pages;

use App\Filament\Resources\GunResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\GunResource\Widgets\GunOverview; // panggil widget

class ListGuns extends ListRecords
{
    protected static string $resource = GunResource::class;

    // Tombol Create otomatis muncul di Filament 3.x, bisa dihapus getHeaderActions jika tidak perlu
    // Tapi kalau mau manual:
    // protected function getHeaderActions(): array
    // {
    //     return [
    //         \Filament\Actions\CreateAction::make(),
    //     ];
    // }

    protected function getHeaderWidgets(): array
    {
        return [
            GunOverview::class,
        ];
    }
}
