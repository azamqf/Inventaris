<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

// ✅ tambahkan import widget
use App\Filament\Resources\MemberResource\Widgets\MemberStats;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // ✅ ini yang bikin widget muncul di atas tabel
    protected function getHeaderWidgets(): array
    {
        return [
            MemberStats::class,
        ];
    }
}
