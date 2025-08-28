<?php

namespace App\Filament\Resources\NetworkResource\Pages;

use App\Filament\Resources\NetworkResource;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Resources\Pages\ViewRecord;

class ViewNetwork extends ViewRecord
{
    protected static string $resource = NetworkResource::class;

    public function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Network')
                    ->schema([
                        // Foto/logo network di kiri (persegi)
                        SpatieMediaLibraryImageEntry::make('networks')
                            ->label('Foto')
                            ->collection('networks')
                            ->size(260) // ukuran 120px, default persegi
                            ->columnSpan(1),

                        // Detail network di kanan
                        Section::make()
                            ->schema([
                                TextEntry::make('serial_number')->label('Serial Number'),
                                TextEntry::make('type.name')->label('Tipe Network'),
                                TextEntry::make('member.name')->label('Member')->default('-'),
                                TextEntry::make('condition.name')->label('Kondisi')->default('-'),
                                TextEntry::make('status')->label('Status'),
                                TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('d M Y H:i'),
                            ])
                            ->columns(2)
                            ->columnSpan(1),
                    ])
                    ->columns(2), // kiri (foto) - kanan (detail)
            ]);
    }
}
