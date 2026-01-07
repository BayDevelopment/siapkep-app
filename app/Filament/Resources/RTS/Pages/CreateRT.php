<?php

namespace App\Filament\Resources\RTS\Pages;

use App\Filament\Resources\RTS\RTResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateRT extends CreateRecord
{
    protected static string $resource = RTResource::class;

    protected static bool $canCreateAnother = false;

    // untuk notifikasi
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data RT Berhasil Ditambahkan!';
    }

    // untuk redirect setelah berhasil ditambahkan
    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
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
            $this->getCreateFormAction()
                ->label('Create')
                ->icon('heroicon-o-plus'),
            $this->getCancelFormAction()
                ->label('Cancel')
                ->icon('heroicon-o-x-mark'),
        ];
    }
}
