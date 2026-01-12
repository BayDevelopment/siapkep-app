<?php

namespace App\Filament\Resources\Meninggals\Pages;

use App\Filament\Resources\Meninggals\MeninggalResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMeninggal extends ViewRecord
{
    protected static string $resource = MeninggalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
