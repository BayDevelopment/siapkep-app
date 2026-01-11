<?php

namespace App\Filament\Resources\Mutations\Pages;

use App\Filament\Resources\Mutations\MutationsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMutations extends CreateRecord
{
    protected static string $resource = MutationsResource::class;

    protected static bool $canCreateAnother = false;

    // untuk notifikasi
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Mutasi Berhasil Ditambahkan!';
    }

    // untuk redirect setelah berhasil ditambahkan
    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Create')
                ->icon('heroicon-o-plus'),
            $this->getCancelFormAction()
                ->label('Cancel')
                ->icon('heroicon-o-x-mark'),
        ];
    }
}
