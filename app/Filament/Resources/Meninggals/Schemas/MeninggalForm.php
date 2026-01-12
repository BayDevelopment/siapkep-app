<?php

namespace App\Filament\Resources\Meninggals\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MeninggalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('resident_id')
                    ->label('Nama Penduduk')
                    ->relationship(
                        name: 'residentMeninggal',              // relasi di model form (belongsTo)
                        titleAttribute: 'full_name',   // kolom yang dipakai sebagai title default
                        modifyQueryUsing: fn (Builder $query) => $query
                            ->where('resident_status', 'meninggal') // ✅ filter hanya penduduk mutasi
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
                        'unique' => 'Data Meninggal untuk penduduk ini sudah ada.',
                    ]),
                DatePicker::make('death_date')
                    ->required()
                    ->label('Tanggal Meninggal'),
                Textarea::make('death_place')
                    ->label('Tempat Meninggal')
                    ->placeholder('Contoh: Rumah Sakit')
                    ->required()
                    ->rows(3),
                Textarea::make('cause_of_death')
                    ->label('Penyebab Kematian')
                    ->placeholder('Contoh: Mengidap sakit HIV')
                    ->required()
                    ->rows(3),
                Textarea::make('notes')
                    ->label('Catatan')
                    ->placeholder('Contoh: Meninggal di RS umum.')
                    ->required()
                    ->rows(3),
                Section::make('Dokumen')
                    ->description('Upload surat keterangan meninggal (PDF/JPG/PNG).')
                    ->extraAttributes([
                        'class' => 'bg-slate-50/60 rounded-xl p-4',
                    ])
                    ->schema([
                        FileUpload::make('death_certificate_path')
                            ->label('Surat Keterangan Meninggal')
                            ->disk('public')
                            ->visibility('public')
                            ->directory('surat-meninggal')
                            ->preserveFilenames()
                            ->openable()
                            ->downloadable()
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->maxSize(2048)
                            ->required(),
                    ]),
            ]);
    }
}
