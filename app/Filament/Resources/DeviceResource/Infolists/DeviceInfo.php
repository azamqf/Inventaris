<?php

namespace App\Filament\Resources\DeviceResource\Infolists;

use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;

class DeviceInfo
{
    public static function make(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Device')
                    ->schema([
                        ImageEntry::make('photo')
                            ->label('Foto Perangkat')
                            ->size(120)
                            ->columnSpan(1),
                        Section::make()
                            ->schema([
                                TextEntry::make('name')->label('Nama'),
                                TextEntry::make('serial_number')->label('Serial Number'),
                                TextEntry::make('deviceType.name')->label('Jenis Perangkat'),
                                TextEntry::make('condition.name')->label('Kondisi'),
                                TextEntry::make('member.name')->label('Member'),
                                TextEntry::make('created_at')->dateTime('d M Y H:i:s')->label('Dibuat'),
                            ])
                            ->columns(2)
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }
}
