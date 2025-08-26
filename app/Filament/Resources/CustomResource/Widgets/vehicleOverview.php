<?php

namespace App\Filament\Resources\CustomResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Vehicle;

class VehicleOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Kendaraan', Vehicle::count())
                ->description('Jumlah semua kendaraan')
                ->color('primary')
                ->icon('heroicon-o-truck'),

            Stat::make('Kendaraan Roda 2', Vehicle::where('tipe', 'Roda2')->count())
                ->description('Jumlah kendaraan roda 2')
                ->color('success')
                ->icon('heroicon-o-cog'), // ganti biar jalan, karena bicycle gak ada

            Stat::make('Kendaraan Roda 4', Vehicle::where('tipe', 'Roda4')->count())
                ->description('Jumlah kendaraan roda 4')
                ->color('warning')
                ->icon('heroicon-o-cube'), // ganti biar jalan, karena car gak ada
        ];
    }
}
