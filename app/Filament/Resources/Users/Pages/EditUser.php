<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Pages\Dashboard;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    // untuk notifikasi
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Data User Berhasil Diperbarui!';
    }

    protected function getRedirectUrl(): string
    {
        // return $this->getResource()::getUrl('index'); // balik ke halaman list/table
        return Dashboard::getUrl();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Kembali')
                ->url(Dashboard::getUrl())
                ->icon('heroicon-o-arrow-left')
                ->color('gray'),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('Simpan Perubahan')
                ->icon('heroicon-o-pencil'),
            $this->getCancelFormAction()
                ->label('Cancel')
                ->icon('heroicon-o-x-mark'),
        ];
    }
}
