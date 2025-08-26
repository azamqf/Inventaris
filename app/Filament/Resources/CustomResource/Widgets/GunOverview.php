<?php

namespace App\Filament\Resources\GunResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Gun;
use App\Models\GunType;

class GunOverview extends BaseWidget
{
    // HAPUS atau COMMENT baris ini:
    // protected static string $view = 'filament.resources.gun-resource.widgets.gun-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Guns', fn () => Gun::count())
                ->description('Jumlah semua senjata')
                ->color('primary')
                ->icon('heroicon-o-rectangle-stack'),

            Stat::make('Jenis Gun', fn () => GunType::count())
                ->description('Kategori gun')
                ->color('success')
                ->icon('heroicon-o-tag'),

            Stat::make('Guns Tersedia', fn () => Gun::where('status', 'available')->count())
                ->description('Jumlah gun yang tersedia')
                ->color('warning')
                ->icon('heroicon-o-bolt'),
        ];
    }
}
