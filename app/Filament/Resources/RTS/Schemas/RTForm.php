<?php

namespace App\Filament\Resources\RTS\Schemas;

use App\Models\RWModel;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RTForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('no_rt')
                    ->label('RT')
                    ->placeholder('01')
                    ->required()
                    ->minLength(2)
                    ->maxLength(2)
                    ->regex('/^\d{2}$/')
                    ->dehydrateStateUsing(fn ($state) => str_pad((string) $state, 2, '0', STR_PAD_LEFT))
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'regex' => 'Format RT harus 2 digit. Contoh: 01, 02.',
                        'unique' => 'No RT sudah terdaftar.',
                    ]),

                Select::make('rw_id')
                    ->label('RW')
                    ->relationship('rw', 'no_rw')
                    ->searchable()
                    ->preload()
                    ->disabled(fn () => ! RWModel::exists())
                    ->placeholder(fn () => RWModel::exists()
                            ? 'Pilih RW'
                            : 'Data Tidak Ditemukan, Segera Input'
                    )
                    ->required(fn () => RWModel::exists()),
                TextInput::make('name')
                    ->label('Nama RT')
                    ->placeholder('Rt 01')
                    ->required()
                    ->minLength(2)
                    ->maxLength(10),
            ]);
    }
}
