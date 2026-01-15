<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Pages\Dashboard;
use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static bool $canCreateAnother = false;

    // untuk notifikasi
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data User Berhasil Ditambahkan!';
    }

    // untuk redirect setelah berhasil ditambahkan
    protected function getRedirectUrl(): string
    {
        // return static::$resource::getUrl('index');
        return Dashboard::getUrl();
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
