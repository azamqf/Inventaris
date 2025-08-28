<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NetworkResource\Pages;
use App\Models\Network;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;

class NetworkResource extends Resource
{
    protected static ?string $model = Network::class;

    protected static ?string $navigationIcon = 'heroicon-o-server';
    protected static ?string $navigationLabel = 'Networks';
    protected static ?string $navigationGroup = 'Inventory';

    public static function form(Form $form): Form
    {
        return $form->schema([
            SpatieMediaLibraryFileUpload::make('photo')
                ->label('Gambar Network')
                ->collection('networks')
                ->image()
                ->nullable(),

            Forms\Components\TextInput::make('serial_number')
                ->label('Serial Number')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('network_type_id')
                ->relationship('type', 'name')
                ->label('Tipe Network')
                ->required(),

            Forms\Components\Select::make('member_id')
                ->relationship('member', 'name')
                ->label('Member')
                ->nullable(),

            Forms\Components\Select::make('condition_id')
                ->relationship('condition', 'name')
                ->label('Kondisi')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            SpatieMediaLibraryImageColumn::make('photo')
                ->label('Foto')
                ->collection('networks')
                ->circular()
                ->disk('public')
                ->defaultImageUrl('https://ui-avatars.com/api/?name=Network'),

            Tables\Columns\TextColumn::make('serial_number')
                ->label('Serial Number')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('type.name')
                ->label('Tipe')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('member.name')
                ->label('Member')
                ->default('-'),

            Tables\Columns\TextColumn::make('condition.name')
                ->label('Kondisi')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->label('Dibuat')
                ->sortable(),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),   // ✅ Tambah tombol View
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    // ✅ Tambah Infolist agar halaman ViewNetwork menampilkan detail rapi
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Network')
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('photo')
                            ->label('Foto')
                            ->collection('networks')
                            ->circular(),

                        TextEntry::make('serial_number')
                            ->label('Serial Number'),

                        TextEntry::make('type.name')
                            ->label('Tipe Network'),

                        TextEntry::make('member.name')
                            ->label('Member')
                            ->default('-'),

                        TextEntry::make('condition.name')
                            ->label('Kondisi')
                            ->default('-'),

                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d M Y H:i'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNetworks::route('/'),
            'create' => Pages\CreateNetwork::route('/create'),
            'edit' => Pages\EditNetwork::route('/{record}/edit'),
            'view' => Pages\ViewNetwork::route('/{record}'), // ✅ route View aktif
        ];
    }
}
