<?php

namespace App\Filament\Resources\RWS\Pages;

use App\Filament\Resources\RWS\RWResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditRW extends EditRecord
{
    protected static string $resource = RWResource::class;

    protected function getHeaderActions(): array
    {
        return [
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
                ->icon('heroicon-o-plus'),
            $this->getCancelFormAction()
                ->label('Cancel')
                ->icon('heroicon-o-x-mark'),
        ];
    }
}
