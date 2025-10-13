<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ListingTypeChart extends ChartWidget
{
    protected ?string $heading = 'Listing Type Chart';
    protected static ?int $sort = 5;

     protected function getData(): array
    {
        $data = Property::select('listing_type', DB::raw('COUNT(*) as total'))
            ->groupBy('listing_type')
            ->pluck('total', 'listing_type');

        return [
            'datasets' => [
                [
                    'label' => 'Listings',
                    'data' => $data->values(),
                    'backgroundColor' => ['#3b82f6', '#f59e0b'], // sale, rent
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // or 'pie'
    }
}
