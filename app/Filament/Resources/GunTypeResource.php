<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GunTypeResource\Pages;
use App\Models\GunType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;

class GunTypeResource extends Resource
{
    protected static ?string $model = GunType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Gun Type';
    protected static ?string $pluralModelLabel = 'Gun Type';
    protected static ?string $modelLabel = 'Gun Type';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Jenis Senjata')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Toggle::make('soft_delete')
                    ->label('Status (Nonaktifkan?)')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Jenis Senjata')
                    ->searchable(),

                BadgeColumn::make('soft_delete')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state ? 'Tidak Aktif' : 'Aktif')
                    ->colors([
                        'danger' => fn ($state) => $state,
                        'success' => fn ($state) => !$state,
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Ubah'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGunTypes::route('/'),
            'create' => Pages\CreateGunType::route('/create'),
            'edit' => Pages\EditGunType::route('/{record}/edit'),
        ];
    }
}
