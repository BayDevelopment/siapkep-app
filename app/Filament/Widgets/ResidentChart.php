<?php

namespace App\Filament\Widgets;

use App\Models\ResidentModel;
use Filament\Widgets\ChartWidget;

class ResidentChart extends ChartWidget
{
    // protected int|string|array $columnSpan = [
    //     'md' => 12,  // di tablet/HP turun ke bawah full
    //     'xl' => 6,   // di layar besar setengah
    // ];

    protected ?string $heading = 'Penduduk Chart';

    protected function getData(): array
    {
        $statusMap = [
            'Aktif' => 'aktif',
            'Meninggal' => 'meninggal',
            'Mutasi' => 'mutasi',
        ];

        $labels = array_keys($statusMap);

        $counts = collect($statusMap)->map(fn ($dbValue) => ResidentModel::query()->where('resident_status', $dbValue)->count()
        )->values()->all();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah',
                    'data' => $counts,

                    // ✅ warna tiap slice (urutnya harus sama dengan $labels / $counts)
                    'backgroundColor' => [
                        '#22c55e', // Hidup (green)
                        '#ef4444', // Meninggal (red)
                        '#3b82f6', // Migrasi (blue)
                    ],

                    // opsional biar ada garis pemisah slice
                    'borderColor' => [
                        '#16a34a',
                        '#dc2626',
                        '#2563eb',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
