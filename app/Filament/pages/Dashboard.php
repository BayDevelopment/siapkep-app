<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\HidupStat;
use App\Filament\Widgets\ResidentChart;
use App\Filament\Widgets\UsersTable;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getColumns(): int|array
    {
        return [
            'md' => 12,
            'xl' => 12,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            HidupStat::class,
            ResidentChart::class,
            UsersTable::class,
        ];
    }

    // Biar widget default bawaan dashboard hilang
    public function getWidgets(): array
    {
        return [];
    }
}
