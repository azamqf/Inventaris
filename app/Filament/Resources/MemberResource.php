<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Member;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\MemberResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Members';
    protected static ?string $pluralModelLabel = 'Members';
    protected static ?string $modelLabel = 'Member'; // singular

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),

                TextInput::make('nrp')
                    ->label('NRP')
                    ->required()
                    ->unique(ignorable: fn ($record) => $record),

                TextInput::make('phone')
                    ->label('Telepon')
                    ->tel(),

                Radio::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'male' => 'Laki-laki',
                        'female' => 'Perempuan',
                    ])
                    ->inline()
                    ->required(),

                SpatieMediaLibraryFileUpload::make('avatar')
                    ->label('Foto')
                    ->collection('avatars'),

                Select::make('rank_id')
                    ->label('Pangkat')
                    ->relationship('rank', 'name')
                    ->required(),

                Select::make('user_id')
                    ->label('Kesatuan')
                    ->relationship('user', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->collection('avatars')
                    ->disk('local')
                    ->visibility('private'),

                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),

                TextColumn::make('nrp')
                    ->searchable()
                    ->label('NRP'),

                TextColumn::make('phone')
                    ->label('Telepon'),

                TextColumn::make('gender')
                    ->label('Jenis Kelamin'),

                TextColumn::make('rank.name')
                    ->label('Pangkat'),

                TextColumn::make('user.name')
                    ->label('Kesatuan'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Dibuat')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            \App\Filament\Resources\MemberResource\Widgets\MemberStats::class,
        ];
    }
}
