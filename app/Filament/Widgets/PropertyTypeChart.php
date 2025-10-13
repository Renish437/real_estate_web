<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PropertyTypeChart extends ChartWidget
{
    protected  ?string $heading = 'Property Type Distribution';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $data = Property::select('type', DB::raw('COUNT(*) as total'))
            ->groupBy('type')
            ->pluck('total', 'type');

        return [
            'datasets' => [
                [
                    'label' => 'Properties',
                    'data' => $data->values(),
                    'backgroundColor' => [
                        '#3b82f6', '#10b981', '#f59e0b', '#ef4444',
                        '#8b5cf6', '#14b8a6', '#eab308'
                    ],
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'pie'; // you can use 'doughnut' or 'bar'
    }
}
