<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Infolists;
use App\Models\Member;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Infolists\Components\Section;
use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\Actions\ExportMemberPdfAction;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Members';
    protected static ?string $pluralModelLabel = 'Members';
    protected static ?string $modelLabel = 'Member';

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
                    ->collection('avatars')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('nrp')
                    ->label('NRP')
                    ->searchable(),

                TextColumn::make('phone')->label('Telepon'),
                TextColumn::make('gender')->label('Jenis Kelamin'),
                TextColumn::make('rank.name')->label('Pangkat'),
                TextColumn::make('user.name')->label('Kesatuan'),
                TextColumn::make('created_at')->dateTime()->label('Dibuat')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                ExportMemberPdfAction::makeSingle(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportMemberPdfAction::makeBulk(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Member')
                    ->schema([
                        ImageEntry::make('avatar')
                            ->label('Foto Profil')
                            ->collection('avatars')
                            ->size(120)
                            ->columnSpan(1),

                        Section::make()
                            ->schema([
                                TextEntry::make('name')->label('Nama'),
                                TextEntry::make('nrp')->label('NRP'),
                                TextEntry::make('phone')->label('Telepon')->default('-'),
                                TextEntry::make('gender')->label('Jenis Kelamin')->default('-'),
                                TextEntry::make('rank.name')->label('Pangkat')->default('-'),
                                TextEntry::make('user.name')->label('Kesatuan')->default('-'),
                                TextEntry::make('created_at')
                                    ->dateTime('d M Y H:i:s')
                                    ->label('Dibuat'),
                            ])
                            ->columns(2)
                            ->columnSpan(1),
                    ])
                    ->columns(2), // foto kiri - data kanan
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
            // 'view' => Pages\ViewMember::route('/{record}'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            \App\Filament\Resources\MemberResource\Widgets\MemberStats::class,
        ];
    }
}
