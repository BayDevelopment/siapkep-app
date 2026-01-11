<?php

namespace App\Filament\Resources\Residents\Schemas;

use Filament\Forms\Components\Select;
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

                Select::make('rt_id')
                    ->label('RT')
                    ->relationship(
                        name: 'rt_rtmodel',
                        titleAttribute: 'no_rt',
                        modifyQueryUsing: fn ($query) => $query->with('rw') // biar no_rw kebaca & gak N+1
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->no_rt} - Rw {$record->rw?->no_rw}")
                    ->searchable()
                    ->preload()
                    ->required(),

                \Filament\Forms\Components\Select::make('resident_status')
                    ->label('Status Penduduk')
                    ->required()
                    ->options([
                        'aktif' => 'Aktif',
                        'mutasi' => 'Mutasi',
                        'meninggal' => 'Meninggal',
                    ])
                    ->default('aktif'),
            ]);
    }
}
