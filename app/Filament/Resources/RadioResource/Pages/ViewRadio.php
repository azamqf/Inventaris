<?php

namespace App\Filament\Resources\RadioResource\Pages;

use App\Filament\Resources\RadioResource;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Resources\Pages\ViewRecord;

class ViewRadio extends ViewRecord
{
    protected static string $resource = RadioResource::class;

    public function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Radio')
                    ->schema([
                        // Foto radio di kiri
                        SpatieMediaLibraryImageEntry::make('radios')
                            ->label('Foto')
                            ->collection('radios')
                            ->size(260)
                            ->columnSpan(1),

                        // Detail radio di kanan
                        Section::make()
                            ->schema([
                                TextEntry::make('serial_number')->label('Serial Number'),
                                TextEntry::make('radioType.name')->label('Tipe Radio')->default('-'),
                                TextEntry::make('member.name')->label('Member')->default('-'),
                                TextEntry::make('condition.name')->label('Kondisi')->default('-'),
                                TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('d M Y H:i'),
                            ])
                            ->columns(2)
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }
}
