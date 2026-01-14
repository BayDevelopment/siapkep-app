<?php

namespace App\Filament\Resources\Mutations\Tables;

use Carbon\Carbon;
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

class MutationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('residentMutations.full_name')
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
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state
                           ? Carbon::parse($state)->locale('id')->translatedFormat('l, d F Y')
                           : '-'
                    ),
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
                        ->successNotificationTitle('Data Mutasi Berhasil Dihapus!'),

                    RestoreAction::make()
                        ->visible(fn ($record) => $record->trashed())
                        ->successNotificationTitle('Data Mutasi Berhasil Dipulihkan!'),

                    ForceDeleteAction::make()
                        ->visible(fn ($record) => $record->trashed())
                        ->successNotificationTitle('Data Mutasi Berhasil Dihapus Permanen!'),
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
