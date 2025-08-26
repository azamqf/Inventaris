<?php

namespace App\Filament\Resources;

use App\Models\Gun;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Filament\Resources\GunResource\Pages;
use App\Filament\Resources\GunResource\Widgets\GunOverview;

class GunResource extends Resource
{
    protected static ?string $model = Gun::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Guns';
    protected static ?string $navigationGroup = 'Gun Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(255),
            Forms\Components\TextInput::make('serial_number')->required()->maxLength(255),
            Forms\Components\Select::make('gun_type_id')
                ->relationship('gunType', 'name')
                ->required(),
            Forms\Components\Select::make('condition_id')
                ->relationship('condition', 'name')
                ->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'available' => 'Available',
                    'unavailable' => 'Unavailable',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('serial_number'),
            Tables\Columns\TextColumn::make('gunType.name')->label('Gun Type')->searchable(),
            Tables\Columns\TextColumn::make('condition.name')->label('Condition')->searchable(),
            Tables\Columns\TextColumn::make('status')->label('Status'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')->options([
                'available' => 'Available',
                'unavailable' => 'Unavailable',
            ]),
            Tables\Filters\SelectFilter::make('gun_type_id')
                ->relationship('gunType', 'name'),
        ])
        ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuns::route('/'),
            'create' => Pages\CreateGun::route('/create'),
            'edit' => Pages\EditGun::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            GunOverview::class,
        ];
    }
}
