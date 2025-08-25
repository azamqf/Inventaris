<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Notification;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                // Field 'email'
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                // Field 'password' - hanya untuk create, edit jangan menggunakan password
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn($get) => !$get('record'))
                    ->minLength(8)
                    ->maxLength(255)
                    ->dehydrated(fn($state) => $state ? bcrypt($state) : null),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->color('success')
                    ->wrap()
                    ->copyable()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(), // EDIT ACTION
                    Action::make('Set Role') // SET ROLE ACTION
                        ->icon('heroicon-o-adjustments-vertical')
                        ->form([
                            Select::make('roles')
                                ->relationship('roles', 'name')
                                ->multiple()
                                // ->required()
                                ->preload(),
                        ])
                        ->visible(fn() => auth()->user()->hasRole('super_admin')),
                    Action::make('Reset Password') // ACTION UNTUK RESET PASSWORD
                        ->icon('heroicon-o-key')
                        ->form([
                            TextInput::make('new_password')
                                ->label('New Password')
                                ->password()
                                ->required()
                                ->revealable()
                                ->minLength(8)
                                ->rule('regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/')
                                ->helperText('Must contain at least one uppercase letter, one number, and one special character.'),
                            TextInput::make('confirm_password')
                                ->label('Confirm Password')
                                ->password()
                                ->required()
                                ->revealable()
                                ->same('new_password')
                                ->minLength(8),
                        ])
                        ->requiresConfirmation()
                        ->action(function ($record, $data) {
                            self::resetUserPassword($record, $data['new_password']);
                        })
                        ->color('danger')
                        ->label('Reset Password')
                        ->visible(fn() => auth()->user()->hasRole('super_admin'))
            ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    // FUNGTION UNTUK RESET PASSWORD
    protected static function resetUserPassword($user, $newPassword)
    {
        // $newPassword = 'passwordbaru'; // Buat password baru yang akan digunakan
        $user->update(['password' => Hash::make($newPassword)]);

        // Tampilkan pop-up notifikasi
        Notification::make()
            ->title('Password Berhasil Direset')
            ->body("Password untuk user <strong>{$user->name}</strong> telah direset.")
            ->success()
            ->send();
    }
}
