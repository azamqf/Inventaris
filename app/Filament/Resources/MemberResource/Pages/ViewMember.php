<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Resources\Pages\ViewRecord;

class ViewMember extends ViewRecord
{
    protected static string $resource = MemberResource::class;

    public function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Member')
                    ->schema([
                        // Foto profil di sebelah kiri
                        SpatieMediaLibraryImageEntry::make('avatar')
                            ->label('Foto')
                            ->collection('avatars')
                            ->size(260) // ukuran 120px, default persegi
                            ->columnSpan(1),

                        // Data member di sebelah kanan
                        Section::make()
                            ->schema([
                                TextEntry::make('name')->label('Nama'),
                                TextEntry::make('nrp')->label('NRP'),
                                TextEntry::make('phone')->label('Telepon'),
                                TextEntry::make('gender')->label('Jenis Kelamin'),
                                TextEntry::make('rank.name')->label('Pangkat'),
                                TextEntry::make('user.name')->label('Kesatuan'),
                                TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('d M Y H:i:s'),
                            ])
                            ->columns(2)
                            ->columnSpan(1),
                    ])
                    ->columns(2), // foto kiri - data kanan
            ]);
    }
}
