<?php

namespace App\Filament\Resources\Residents\Schemas;

use Filament\Schemas\Schema;

class ResidentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('nik')
                    ->label('NIK')
                    ->placeholder('Masukan Nik')
                    ->required()
                    ->minLength(16)
                    ->maxLength(16)
                    ->unique(ignoreRecord: true),

                \Filament\Forms\Components\TextInput::make('full_name')
                    ->label('Nama Lengkap')
                    ->placeholder('Masukan Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                \Filament\Forms\Components\Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->required()
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),

                \Filament\Forms\Components\TextInput::make('birth_place')
                    ->label('Tempat Lahir')
                    ->placeholder('Tempat Lahir')
                    ->maxLength(255),

                \Filament\Forms\Components\DatePicker::make('birth_date')
                    ->label('Tanggal Lahir'),

                \Filament\Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->placeholder('Alamat')
                    ->rows(3),

                \Filament\Forms\Components\TextInput::make('rw')
                    ->label('RW')
                    ->placeholder('01')
                    ->maxLength(3),

                \Filament\Forms\Components\TextInput::make('rt')
                    ->label('RT')
                    ->placeholder('07')
                    ->maxLength(3),

                \Filament\Forms\Components\Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'aktif' => 'Aktif',
                        'pindah' => 'Pindah',
                        'meninggal' => 'Meninggal',
                    ])
                    ->default('aktif'),
            ]);
    }
}
