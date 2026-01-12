<?php

namespace App\Filament\Resources\Meninggals\Tables;

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

class MeninggalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('residentMeninggal.full_name')
                    ->label('Nama Penduduk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('death_date')
                    ->label('Tanggal Meninggal')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('death_place')
                    ->label('Tempat Meninggal')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('cause_of_death')
                    ->label('Penyebab Kematian')
                    ->searchable()
                    ->sortable(),
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
                        ->successNotificationTitle('Data Meninggal Berhasil Dihapus!'),

                    RestoreAction::make()
                        ->visible(fn ($record) => $record->trashed())
                        ->successNotificationTitle('Data Meninggal Berhasil Dipulihkan!'),

                    ForceDeleteAction::make()
                        ->visible(fn ($record) => $record->trashed())
                        ->successNotificationTitle('Data Meninggal Berhasil Dihapus Permanen!'),
                ])
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->label('')
                    ->iconButton(),

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
