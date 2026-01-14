<?php

namespace App\Filament\Widgets;

use App\Models\ResidentModel;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HidupStat extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Meninggal', ResidentModel::where('resident_status', 'meninggal')->count())
                ->icon('heroicon-o-x-circle'),

            Stat::make('Migrasi', ResidentModel::where('resident_status', 'mutasi')->count())
                ->icon('heroicon-o-arrow-right-on-rectangle'),

            Stat::make('Aktif', ResidentModel::where('resident_status', 'aktif')->count())
                ->icon('heroicon-o-heart'),
        ];
    }
}
