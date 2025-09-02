<?php

namespace App\Filament\Resources\CustomResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Gun;

class GunOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Guns', Gun::count())
                ->description('Jumlah semua senjata')
                ->color('primary'),

            Stat::make('Available', Gun::where('status', 'available')->count())
                ->description('Senjata yang siap dipakai')
                ->color('success'),

            Stat::make('Damaged', Gun::where('status', 'damaged')->count())
                ->description('Senjata rusak')
                ->color('danger'),
        ];
    }
}
