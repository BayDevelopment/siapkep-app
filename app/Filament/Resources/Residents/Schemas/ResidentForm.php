<?php

namespace App\Filament\Resources\Residents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ResidentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nik')
                    ->label('NIK')
                    ->placeholder('Masukan Nik')
                    ->required()
                    ->minLength(16)
                    ->maxLength(16)
                    ->unique(ignoreRecord: true),

                TextInput::make('full_name')
                    ->label('Nama Lengkap')
                    ->placeholder('Masukan Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->required()
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),

                TextInput::make('birth_place')
                    ->label('Tempat Lahir')
                    ->placeholder('Tempat Lahir')
                    ->maxLength(255),

                DatePicker::make('birth_date')
                    ->label('Tanggal Lahir'),

                Textarea::make('address')
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

                Select::make('resident_status')
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
