<?php

namespace App\Filament\Resources\Residents\Tables;

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
                    ->sortable(),

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
                ViewAction::make()
                    ->badge(),
                EditAction::make()
                    ->badge(),
                DeleteAction::make()
                    ->badge()
                    ->visible(fn ($record) => ! $record->trashed())
                    ->successNotificationTitle('Data Penduduk Berhasil Dihapus'),
                RestoreAction::make()
                    ->badge()
                    ->visible(fn ($record) => $record->trashed())
                    ->successNotificationTitle('Data Penduduk Berhasil Dipulihkan!'),

                ForceDeleteAction::make()
                    ->badge()
                    ->visible(fn ($record) => $record->trashed())
                    ->successNotificationTitle('Data Penduduk Berhasil Dihapus Permanen!'),
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
