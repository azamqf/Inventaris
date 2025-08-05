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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('nrp')->required()->unique(ignoreRecord: true),
                TextInput::make('phone')->tel(),
                Radio::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->inline()
                    ->required(),
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->collection('avatars'),
                // FileUpload::make('thumbnail')
                //     ->image()
                //     ->directory('members')
                //     ->nullable(),
                Select::make('rank_id')
                    ->relationship('rank', 'name')
                    ->required(),
                Select::make('user_id')
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
                // ImageColumn::make('thumbnail')->circular()->label('Photo'),
                TextColumn::make('name')->searchable()->label('Nama'),
                TextColumn::make('nrp')->searchable()->label('NRP'),
                TextColumn::make('phone')->label('Telepon'),
                TextColumn::make('gender')->label('Jenis Kelamin'),
                TextColumn::make('rank.name')->label('Pangkat'),
                TextColumn::make('user.name')->label('Kesatuan'),
                TextColumn::make('created_at')->dateTime()->label('Created'),
            ])
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
}