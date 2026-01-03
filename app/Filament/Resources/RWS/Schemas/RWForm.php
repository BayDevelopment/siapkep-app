<?php

namespace App\Filament\Resources\RWS\Schemas;

use Filament\Schemas\Schema;

class RWForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('no_rw')
                    ->label('Rw')
                    ->placeholder('01')
                    ->required()
                    ->numeric()
                    ->minLength(2)
                    ->maxLength(2)
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Nama RW')
                    ->placeholder('Rw 01')
                    ->required()
                    ->minLength(2)
                    ->maxLength(10),
            ]);
    }
}
