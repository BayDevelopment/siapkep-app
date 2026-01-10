<?php

namespace App\Filament\Resources\Mutations\Pages;

use App\Filament\Resources\Mutations\MutationsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMutations extends EditRecord
{
    protected static string $resource = MutationsResource::class;

    // untuk notifikasi
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Data Mutasi Berhasil Diperbarui!';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // balik ke halaman list/table
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
