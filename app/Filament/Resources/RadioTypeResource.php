<?php
namespace App\Filament\Resources;

use App\Models\RadioType;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Filament\Resources\RadioTypeResource\Pages;

class RadioTypeResource extends Resource
{
    protected static ?string $model = RadioType::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Inventaris';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRadioTypes::route('/'),
            'create' => Pages\CreateRadioType::route('/create'),
            'edit' => Pages\EditRadioType::route('/{record}/edit'),
        ];
    }
}
