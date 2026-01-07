<?php

namespace App\Filament\Resources\RWS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class RWSTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_rw')
                    ->label('RW')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama RW')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->badge(),
                DeleteAction::make()
                    ->badge()
                    ->visible(fn ($record) => ! $record->trashed())
                    ->successNotificationTitle('Data RT Berhasil Dihapus!'),

                RestoreAction::make()
                    ->badge()
                    ->visible(fn ($record) => $record->trashed())
                    ->successNotificationTitle('Data RT Berhasil Dipulihkan!'),

                ForceDeleteAction::make()
                    ->badge()
                    ->visible(fn ($record) => $record->trashed())
                    ->successNotificationTitle('Data RT Berhasil Dihapus Permanen!'),
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
