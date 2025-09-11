<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GunResource\Pages;
use App\Models\Gun;
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

class GunResource extends Resource
{
    protected static ?string $model = Gun::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $navigationLabel = 'Guns';
    protected static ?string $navigationGroup = 'Gun Management';
    protected static ?string $modelLabel = 'Gun';
    protected static ?string $pluralModelLabel = 'Guns';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            SpatieMediaLibraryFileUpload::make('photo')
                ->label('Foto Gun')
                ->collection('guns')
                ->disk('public')
                ->image()
                ->nullable(),

            Forms\Components\TextInput::make('name')
                ->label('Nama Gun')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('serial_number')
                ->label('Serial Number')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('gun_type_id')
                ->relationship('type', 'name')
                ->label('Tipe Gun')
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
                ->collection('guns')
                ->disk('public')
                ->circular()
                ->defaultImageUrl('https://ui-avatars.com/api/?name=Gun'),

            Tables\Columns\TextColumn::make('name')
                ->label('Nama Gun')
                ->sortable()
                ->searchable(),

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
                ->default('-')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('condition.name')
                ->label('Kondisi')
                ->default('-')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->label('Dibuat')
                ->sortable(),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Gun')
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('photo')
                            ->label('Foto')
                            ->collection('guns')
                            ->disk('public')
                            ->circular(),

                        TextEntry::make('serial_number')
                            ->label('Serial Number'),

                        TextEntry::make('type.name')
                            ->label('Tipe Gun'),

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
            'index' => Pages\ListGuns::route('/'),
            'create' => Pages\CreateGun::route('/create'),
            'edit' => Pages\EditGun::route('/{record}/edit'),
            'view' => Pages\ViewGun::route('/{record}'),
        ];
    }
}
