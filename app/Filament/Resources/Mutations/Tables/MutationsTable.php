<?php

namespace App\Filament\Resources\Mutations\Tables;

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

class MutationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('resident_id')
                    ->label('Nama Penduduk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('mutation_type')
                    ->label('Tipe Mutasi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('mutation_date')
                    ->label('Tanggal Mutasi')
                    ->searchable()
                    ->sortable(),
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
                    ->successNotificationTitle('Data Mutasi Berhasil Dihapus!'),

                RestoreAction::make()
                    ->badge()
                    ->visible(fn ($record) => $record->trashed())
                    ->successNotificationTitle('Data Mutasi Berhasil Dipulihkan!'),

                ForceDeleteAction::make()
                    ->badge()
                    ->visible(fn ($record) => $record->trashed())
                    ->successNotificationTitle('Data Mutasi Berhasil Dihapus Permanen!'),
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
