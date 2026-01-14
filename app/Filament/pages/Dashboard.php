<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\HidupStat;
use App\Filament\Widgets\ResidentChart;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getColumns(): int|array
    {
        return [
            'md' => 3,
            'xl' => 3,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            HidupStat::class,
            ResidentChart::class,
        ];
    }

    // Biar widget default bawaan dashboard hilang
    public function getWidgets(): array
    {
        return [];
    }
}
