<?php

namespace App\Filament\Resources\Meninggals\Pages;

use App\Filament\Resources\Meninggals\MeninggalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMeninggal extends CreateRecord
{
    protected static string $resource = MeninggalResource::class;

    protected static bool $canCreateAnother = false;

    // untuk notifikasi
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Meninggal Berhasil Ditambahkan!';
    }

    // untuk redirect setelah berhasil ditambahkan
    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    public function getFormActions(): array
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
