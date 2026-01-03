<?php

namespace App\Filament\Resources\RTS\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class RTForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('rw_id')
                    ->label('RW')
                    ->relationship('rw', 'no_rw') // tampilkan no_rw di dropdown
                    ->searchable()
                    ->preload()
                    ->required(),
                \Filament\Forms\Components\TextInput::make('no_rt')
                    ->label('RT')
                    ->placeholder('01')
                    ->required()
                    ->numeric()
                    ->minLength(2)
                    ->maxLength(2)
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Nama RT')
                    ->placeholder('Rt 01')
                    ->required()
                    ->minLength(2)
                    ->maxLength(10),
            ]);
    }
}
