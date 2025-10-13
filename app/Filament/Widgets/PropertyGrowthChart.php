<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PropertyGrowthChart extends ChartWidget
{
    protected ?string $heading = 'Property Growth Chart';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Property::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $months = collect(range(1, 12))->map(fn ($m) => now()->setMonth($m)->format('M'));

        return [
            'datasets' => [
                [
                    'label' => 'New Properties',
                    'data' => $months->map(fn ($m, $i) => $data[$i + 1] ?? 0),
                    'borderColor' => '#22c55e',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.3)',
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
