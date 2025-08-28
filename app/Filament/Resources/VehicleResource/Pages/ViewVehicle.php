<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use App\Filament\Resources\VehicleResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;

class ViewVehicle extends ViewRecord
{
    protected static string $resource = VehicleResource::class;

    public function infolist(Infolists\Infolist $infolist): Infolists\Infolist
    {
        return $infolist->schema([
            Section::make('Detail Kendaraan')
                ->schema([
                    Grid::make(2)
                        ->schema([

                            // FOTO BULAT DI KIRI
                            SpatieMediaLibraryImageEntry::make('foto')
                                ->label('Foto Kendaraan')
                                ->collection('vehicles')
                                ->size(160)
                                ->extraImgAttributes([
                                    'class' => 'rounded-full shadow border border-gray-300'
                                ])
                                ->columnSpan(1),

                            // DETAIL INFORMASI DI KANAN
                            Grid::make(2)
                                ->schema([
                                    TextEntry::make('nomor_kerangka')
                                        ->label('Nomor Rangka')
                                        ->default('-'),

                                    TextEntry::make('nomor_mesin')
                                        ->label('Nomor Mesin')
                                        ->default('-'),

                                    TextEntry::make('nomor_polisi')
                                        ->label('Nomor Polisi')
                                        ->default('-'),

                                    TextEntry::make('merk')
                                        ->label('Merek')
                                        ->default('-'),

                                    TextEntry::make('tipe')
                                        ->label('Tipe')
                                        ->default('-'),

                                    TextEntry::make('member.name')
                                        ->label('Pengguna')
                                        ->default('-'),

                                    TextEntry::make('condition.name')
                                        ->label('Kondisi')
                                        ->default('-'),

                                    TextEntry::make('created_at')
                                        ->label('Dibuat')
                                        ->dateTime('d M Y H:i')
                                        ->default('-'),

                                    TextEntry::make('updated_at')
                                        ->label('Terakhir Diperbarui')
                                        ->dateTime('d M Y H:i')
                                        ->default('-'),
                                ])
                                ->columnSpan(1),
                        ]),
                ])
                ->columns(2)
                ->collapsible()
                ->collapsed(false),
        ]);
    }
}
