<?php

namespace App\Filament\Resources\Mutations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class MutationsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('resident_id')
                    ->label('Penduduk')
                    ->relationship(
                        name: 'residentMutations',
                        titleAttribute: 'full_name',
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                \Filament\Forms\Components\Select::make('mutation_type')
                    ->label('Tipe Mutasi')
                    ->required()
                    ->options([
                        'pindah antar RT/RW' => 'pindah antar RT/RW',
                        'Pindah keluar wilayah' => 'Pindah keluar wilayah',
                    ]),
                \Filament\Forms\Components\DatePicker::make('mutation_date')
                    ->required()
                    ->label('Tanggal Mutasi'),
                \Filament\Forms\Components\Textarea::make('old_address')
                    ->label('Alamat Sebelumnya')
                    ->placeholder('Alamat Sebelumnya ..')
                    ->rows(3),
                \Filament\Forms\Components\Textarea::make('new_address')
                    ->label('Alamat Sekarang')
                    ->placeholder('Alamat Sekarang ..')
                    ->rows(3),
            ]);
    }
}
