<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GunResource\Pages;
use App\Models\Gun;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

// Komponen untuk upload & tampilkan gambar
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class GunResource extends Resource
{
    // 📌 Model yang digunakan
    protected static ?string $model = Gun::class;

    // 📌 Navigasi di sidebar admin
    protected static ?string $navigationIcon = 'heroicon-o-fire';
    protected static ?string $navigationLabel = 'Gun';
    protected static ?string $navigationGroup = 'Gun Management';

    // 🧾 FORM INPUT
    public static function form(Form $form): Form
    {
        return $form->schema([
            // 📷 Upload foto senjata
            SpatieMediaLibraryFileUpload::make('photo')
                ->label('Foto Senjata')
                ->collection('guns')
                ->image()
                ->required(),

            // 📝 Nama senjata
            Forms\Components\TextInput::make('name')
                ->label('Nama Senjata')
                ->required()
                ->maxLength(255),

            // 🧾 Nomor seri
            Forms\Components\TextInput::make('serial_number')
                ->label('Nomor Seri')
                ->required()
                ->maxLength(255),

            // 🔗 Relasi ke Jenis Senjata
            Forms\Components\Select::make('gun_type_id')
                ->label('Jenis Senjata')
                ->relationship('gunType', 'name')
                ->required(),

            Forms\Components\Select::make('condition_id')
                ->relationship('condition', 'name')
                ->label('Kondisi')
                ->required(),
        ]);
    }

    // 📊 TABEL LISTING
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 📷 Foto senjata
                SpatieMediaLibraryImageColumn::make('photo')
                    ->label('Foto')
                    ->collection('guns')
                    ->circular(),

                // 📌 Nama
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Senjata')
                    ->sortable()
                    ->searchable(),

                // 📌 Nomor seri
                Tables\Columns\TextColumn::make('serial_number')
                    ->label('Nomor Seri')
                    ->sortable()
                    ->searchable(),

                // 🔗 Jenis senjata
                Tables\Columns\TextColumn::make('gunType.name')
                    ->label('Jenis')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('condition.name')
                    ->label('Kondisi')
                    ->sortable()
                    ->searchable(),

                // 📅 Tanggal dibuat
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Bisa ditambah delete massal kalau mau
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // 🔗 Relasi tambahan (tidak ada sekarang)
    public static function getRelations(): array
    {
        return [];
    }

    // 📄 Halaman yang tersedia
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuns::route('/'),
            'create' => Pages\CreateGun::route('/create'),
            'edit' => Pages\EditGun::route('/{record}/edit'),
        ];
    }
}
