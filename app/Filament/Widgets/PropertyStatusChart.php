<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PropertyStatusChart extends ChartWidget
{
    protected ?string $heading = 'Property Status Chart';
    protected static ?int $sort = 3;

       protected function getData(): array
    {
        $data = Property::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'datasets' => [
                [
                    'label' => 'Status Count',
                    'data' => $data->values(),
                    'backgroundColor' => [
                        '#22c55e', // available
                        '#f59e0b', // pending
                        '#ef4444', // sold
                        '#3b82f6', // rented
                        '#6b7280', // draft
                    ],
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
