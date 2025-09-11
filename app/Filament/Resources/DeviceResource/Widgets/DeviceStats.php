<?php

namespace App\Filament\Resources\DeviceResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Device;

class DeviceStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Device', Device::count())
                ->description('Jumlah Devices')
                ->color('primary'),

            Stat::make('Available', Device::where('status', 'available')->count())
                ->description('Device yang siap dipakai')
                ->color('success'),

            Stat::make('Damaged', Device::where('status', 'damaged')->count())
                ->description('Device rusak')
                ->color('danger'),
        ];
    }
}
