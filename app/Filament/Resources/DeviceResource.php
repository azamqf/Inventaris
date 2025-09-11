<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeviceResource\Pages;
use App\Filament\Resources\DeviceResource\RelationManagers;
use App\Filament\Resources\DeviceResource\Infolists\DeviceInfo;
use App\Models\Device;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ViewAction;
use App\Filament\Resources\DeviceResource\Actions\ExportDevicePdfAction;

class DeviceResource extends Resource
{
    protected static ?string $model = Device::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Device Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('photo')
                    ->label('Foto Perangkat')
                    ->collection('devices')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('device_type_id')
                    ->label('Jenis Perangkat')
                    ->relationship('deviceType', 'name')
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('serial_number')->required(),
                forms\Components\Select::make('condition_id')
                    ->relationship('condition', 'name')
                    ->label('Kondisi')
                    ->required(),
                Forms\Components\Select::make('member_id')
                    ->relationship('member', 'name')
                    ->searchable()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('photo')
                    ->collection('devices')
                    ->label('Photo')
                    ->circular()
                    ->size(50)
                    ->default('heroicon-o-device-phone'),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('deviceType.name')
                    ->label('Jenis Perangkat')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial_number')->searchable(),
                Tables\Columns\TextColumn::make('condition.name')
                    ->label('Kondisi')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('member.name')->label('Member'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Created'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('condition_id')
                    ->relationship('condition', 'name')
                    ->label('Kondisi Perangkat'),
                Tables\Filters\SelectFilter::make('device_type_id')
                    ->relationship('deviceType', 'name')
                    ->label('Jenis Perangkat'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                ExportDevicePdfAction::makeSingle(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportDevicePdfAction::makeBulk(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDevices::route('/'),
            'create' => Pages\CreateDevice::route('/create'),
            'edit' => Pages\EditDevice::route('/{record}/edit'),
        ];
    }

    public static function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return DeviceInfo::make($infolist);
    }
}
