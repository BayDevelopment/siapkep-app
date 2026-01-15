<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->placeholder('Masukan Nama')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->placeholder('Masukan Email')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->label('Password')
                    ->placeholder('Masukan password anda')
                    ->password()
                    ->revealable() // 👁️ tampilkan ikon mata
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->minLength(8)
                    ->helperText('Saat edit: isi hanya jika ingin mengganti password.'),

                TextInput::make('password_confirmation')
                    ->label('Confirm Password')
                    ->placeholder('Masukan konfirmasi password anda')
                    ->password()
                    ->revealable() // 👁️
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(false)
                    ->same('password'),
            ]);
    }
}
