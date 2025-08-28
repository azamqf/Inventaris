<?php

namespace App\Filament\Resources\CustomResource\Widgets;


use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Radio;
use App\Models\RadioType;

class RadioOverview extends BaseWidget
{
    // Non-static heading sesuai versi baru Filament
    protected ?string $heading = '📊 Ringkasan Radio';

    // Full width di header
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Radio', Radio::count())
                ->description('Jumlah semua radio')
                ->color('primary')
                ->icon('heroicon-o-signal'),

            Stat::make('Jenis Radio', RadioType::count())
                ->description('Kategori radio')
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),

            Stat::make('Radio Aktif', Radio::where('status', 'aktif')->count())
                ->description('Radio yang sedang aktif')
                ->color('warning')
                ->icon('heroicon-o-bolt'),
        ];
    }
}
