<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Vehicles';

    public static function form(Form $form): Form
    {
        return $form->schema([
            SpatieMediaLibraryFileUpload::make('photo')
                ->label('Foto Kendaraan')
                ->collection('vehicles')
                ->image()
                ->required(),

            Forms\Components\TextInput::make('nomor_kerangka')
                ->label('Nomor Kerangka')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('nomor_mesin')
                ->label('Nomor Mesin')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('nomor_polisi')
                ->label('Nomor Polisi')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('merk')
                ->label('Merk')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('member_id')
                ->relationship('member', 'name')
                ->label('Member')
                ->required(),

            Forms\Components\Select::make('tipe')
                ->label('Tipe')
                ->options([
                    'Roda2' => 'Roda 2',
                    'Roda4' => 'Roda 4',
                ])
                ->required(),

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
                ->collection('vehicles')
                ->circular(),

            Tables\Columns\TextColumn::make('nomor_kerangka')->label('Nomor Kerangka')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('nomor_mesin')->label('Nomor Mesin')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('nomor_polisi')->label('Nomor Polisi')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('merk')->label('Merk')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('member.name')->label('Member')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('tipe')->label('Tipe')->sortable(),
            Tables\Columns\TextColumn::make('condition.name')->label('Kondisi')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Dibuat')->sortable(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            // Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
