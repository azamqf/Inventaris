<?php

namespace App\Filament\Resources;

use App\Models\Radio;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Filament\Resources\RadioResource\Pages;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;

class RadioResource extends Resource
{
    protected static ?string $model = Radio::class;

    // **TAMBAHAN**
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['radioType', 'member', 'condition']);
    }

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';
    protected static ?string $navigationGroup = 'Inventaris';
    protected static ?string $navigationLabel = 'Radios';

    public static function form(Form $form): Form
    {
        return $form->schema([
            SpatieMediaLibraryFileUpload::make('photo')
                ->label('Foto Radio')
                ->collection('radios')
                ->image()
                ->imageEditor()
                ->required(),

            Forms\Components\TextInput::make('serial_number')
                ->label('Nomor Seri')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('radio_type_id')
                ->label('Tipe Radio')
                ->relationship('radioType', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\Select::make('member_id')
                ->label('Pengguna')
                ->relationship('member', 'name')
                ->searchable()
                ->preload()
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
                ->collection('radios')
                ->circular(),

            Tables\Columns\TextColumn::make('serial_number')
                ->label('Nomor Seri')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('radioType.name')
                ->label('Tipe')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('member.name')
                ->label('Pengguna')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('condition.name')
                ->label('Kondisi')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime('d M Y H:i')
                ->sortable(),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Detail Radio')
                ->schema([

                    ImageEntry::make('photo')
                        ->label('Foto Radio')
                        ->getStateUsing(fn ($record) => $record->getFirstMediaUrl('radios'))
                        ->circular(),

                    TextEntry::make('serial_number')
                        ->label('Nomor Seri'),

                    TextEntry::make('radioType.name')
                        ->label('Tipe Radio'),

                    TextEntry::make('member.name')
                        ->label('Pengguna'),

                    TextEntry::make('condition.name')
                        ->label('Kondisi'),

                    TextEntry::make('created_at')
                        ->label('Dibuat')
                        ->dateTime('d M Y H:i'),
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
            'index' => Pages\ListRadios::route('/'),
            'create' => Pages\CreateRadio::route('/create'),
            'edit' => Pages\EditRadio::route('/{record}/edit'),
            'view' => Pages\ViewRadio::route('/{record}'),
        ];
    }
}
