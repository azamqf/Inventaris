<?php

namespace App\Filament\Resources\GunResource\Pages;

use App\Filament\Resources\GunResource;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Resources\Pages\ViewRecord;

class ViewGun extends ViewRecord
{
    protected static string $resource = GunResource::class;

    public function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Gun')
                    ->schema([
                        // Foto gun di kiri
                        SpatieMediaLibraryImageEntry::make('photo')
                            ->label('Foto')
                            ->collection('guns') // sesuai collection di upload
                            ->size(260)
                            ->circular()
                            ->columnSpan(1),

                        // Detail gun di kanan
                        Section::make()
                            ->schema([
                                TextEntry::make('serial_number')->label('Serial Number'),
                                TextEntry::make('type.name')->label('Tipe Gun'),
                                TextEntry::make('member.name')->label('Member')->default('-'),
                                TextEntry::make('condition.name')->label('Kondisi')->default('-'),
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
