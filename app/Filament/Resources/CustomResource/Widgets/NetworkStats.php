<?php

namespace App\Filament\Resources\CustomResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Network;
use App\Models\NetworkType;

class NetworkStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Network', Network::count())
                ->description('Jumlah semua network')
                ->color('primary')
                ->icon('heroicon-o-signal'),

            Stat::make('Jenis Network', NetworkType::count())
                ->description('Kategori network')
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),

            Stat::make('Network Aktif', Network::where('status', 'active')->count())
                ->description('Network yang sedang aktif')
                ->color('warning')
                ->icon('heroicon-o-bolt'),
        ];
    }
}
