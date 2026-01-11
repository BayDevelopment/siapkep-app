<?php

namespace App\Filament\Resources\Residents\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ResidentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('full_name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('gender')
                    ->label('JK')
                    ->badge()
                    ->color(fn (string $state) => $state === 'P' ? 'danger' : 'info'),

                TextColumn::make('rt_rtmodel.name')
                    ->label('RT')
                    ->tooltip(fn ($record) => data_get($record, 'rt_rtmodel.rw.no_rw') ?? '-'),

                TextColumn::make('resident_status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif' => 'success',
                        'mutasi' => 'warning',
                        'meninggal' => 'danger',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'aktif' => 'heroicon-m-check-circle',      // ✅ ceklis
                        'mutasi' => 'heroicon-m-arrow-right-circle', // ➜ mutasi (pindah)
                        'meninggal' => 'heroicon-m-x-circle',      // ✖ meninggal
                        default => 'heroicon-m-question-mark-circle',
                    }),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),

                    DeleteAction::make()
                        ->visible(fn ($record) => ! $record->trashed())
                        ->successNotificationTitle('Data Penduduk Berhasil Dihapus'),

                    RestoreAction::make()
                        ->visible(fn ($record) => $record->trashed())
                        ->successNotificationTitle('Data Penduduk Berhasil Dipulihkan!'),

                    ForceDeleteAction::make()
                        ->visible(fn ($record) => $record->trashed())
                        ->successNotificationTitle('Data Penduduk Berhasil Dihapus Permanen!'),
                ])
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->label('')       // biar nggak ada teks
                    ->iconButton(),   // trigger jadi tombol icon bulat
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
