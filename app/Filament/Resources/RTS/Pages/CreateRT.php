<?php

namespace App\Filament\Resources\RTS\Pages;

use App\Filament\Resources\RTS\RTResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateRT extends CreateRecord
{
    protected static string $resource = RTResource::class;

    protected static bool $canCreateAnother = false;

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
