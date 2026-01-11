<?php

namespace App\Filament\Resources\Mutations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MutationsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('resident_id')
                    ->label('Penduduk')
                    ->relationship(
                        name: 'residentMutations',              // relasi di model form (belongsTo)
                        titleAttribute: 'full_name',   // kolom yang dipakai sebagai title default
                        modifyQueryUsing: fn (Builder $query) => $query
                            ->where('resident_status', 'mutasi') // ✅ filter hanya penduduk mutasi
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn (Model $record) => "{$record->nik} — {$record->full_name}"
                    )
                    ->searchable(['nik', 'full_name']) // ✅ bisa cari via NIK / Nama
                    ->preload()                        // opsional (kalau datanya sedikit)
                    ->required()
                     // ✅ cegah duplikat resident_id
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Data mutasi untuk penduduk ini sudah ada.',
                    ]),

                Select::make('mutation_type')
                    ->label('Tipe Mutasi')
                    ->required()
                    ->options([
                        'pindah antar RT/RW' => 'pindah antar RT/RW',
                        'Pindah keluar wilayah' => 'Pindah keluar wilayah',
                    ]),
                DatePicker::make('mutation_date')
                    ->required()
                    ->label('Tanggal Mutasi'),
                Textarea::make('old_address')
                    ->label('Alamat Sebelumnya')
                    ->placeholder('Alamat Sebelumnya ..')
                    ->rows(3),
                Textarea::make('new_address')
                    ->label('Alamat Sekarang')
                    ->placeholder('Alamat Sekarang ..')
                    ->rows(3),
            ]);
    }
}
