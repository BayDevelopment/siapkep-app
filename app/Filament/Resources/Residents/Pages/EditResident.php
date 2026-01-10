<?php

namespace App\Filament\Resources\Residents\Pages;

use App\Filament\Resources\Residents\ResidentResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditResident extends EditRecord
{
    protected static string $resource = ResidentResource::class;

    // untuk notifikasi
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Data Penduduk Berhasil Diperbarui!';
    }

    // untuk redirect setelah berhasil ditambahkan
    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            // ViewAction::make(),
            // DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
            Action::make('back')
                ->label('Kembali')
                ->url($this->getResource()::getUrl('index'))
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
