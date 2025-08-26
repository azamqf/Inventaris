<?php

namespace App\Filament\Resources\MemberResource\Widgets;

use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MemberStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Member', Member::count())
                ->description('Jumlah semua member')
                ->color('primary')
                ->icon('heroicon-o-users'),

            Stat::make('Member Aktif', Member::where('status', 'active')->count())
                ->description('Sedang aktif')
                ->color('success')
                ->icon('heroicon-o-check-circle'),

            Stat::make('Member Non Aktif', Member::where('status', 'inactive')->count())
                ->description('Belum aktif')
                ->color('danger')
                ->icon('heroicon-o-x-circle'),
        ];
    }
}
