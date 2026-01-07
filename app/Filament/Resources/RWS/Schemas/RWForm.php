<?php

namespace App\Filament\Resources\RWS\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RWForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('no_rw')
                    ->label('No RW')
                    ->required()
                    ->maxLength(3)
                    ->regex('/^\d{2}$/') // wajib 2 digit
                    ->unique(table: 'tb_rws', column: 'no_rw', ignoreRecord: true)
                    ->validationMessages([
                        'regex' => 'Format harus 2 digit. Contoh: 01, 02.',
                        'unique' => 'No RW sudah terdaftar.',
                    ]),
                TextInput::make('name')
                    ->label('Nama RW')
                    ->placeholder('Rw 01')
                    ->required()
                    ->minLength(2)
                    ->maxLength(10),
            ]);
    }
}
