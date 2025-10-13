<?php

namespace App\Filament\Widgets;

use App\Models\Enquiry;
use App\Models\Property;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget

{

    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        // 🗓 Current and previous month date ranges
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();
        $previousMonthStart = now()->subMonth()->startOfMonth();
        $previousMonthEnd = now()->subMonth()->endOfMonth();

        // ---------- TOTAL PROPERTIES ----------
        $totalNow = Property::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();
        $totalPrev = Property::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();
        $totalGrowth = $this->calculateGrowth($totalNow, $totalPrev);
        $totalCount = Property::count();

        // ---------- ENQUIRIES ----------
        $enquiryNow = Enquiry::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();
        $enquiryPrev = Enquiry::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();
        $enquiryGrowth = $this->calculateGrowth($enquiryNow, $enquiryPrev);
        $enquiryCount = Enquiry::count();

        // ---------- AVAILABLE PROPERTIES ----------
        $availableNow = Property::query()
            ->available()
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->count();
        $availablePrev = Property::query()
            ->available()
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->count();
        $availableGrowth = $this->calculateGrowth($availableNow, $availablePrev);
        $availableCount = Property::query()->available()->count();

        // ---------- RENTED PROPERTIES ----------
        $rentedNow = Property::query()
            ->forRent()
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->count();
        $rentedPrev = Property::query()
            ->forRent()
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->count();
        $rentedGrowth = $this->calculateGrowth($rentedNow, $rentedPrev);
        $rentedCount = Property::query()->forRent()->count();

        // ✅ Return Filament Stats
        return [
            Stat::make('Total Properties', $totalCount)
                ->description($this->formatDescription($totalGrowth))
                ->descriptionIcon($this->getIcon($totalGrowth))
                ->color($this->getColor($totalGrowth)),

            Stat::make('Enquiries', $enquiryCount)
                ->description($this->formatDescription($enquiryGrowth))
                ->descriptionIcon($this->getIcon($enquiryGrowth))
                ->color($this->getColor($enquiryGrowth)),

            Stat::make('Available Properties', $availableCount)
                ->description($this->formatDescription($availableGrowth))
                ->descriptionIcon($this->getIcon($availableGrowth))
                ->color($this->getColor($availableGrowth)),

            Stat::make('Rented Properties', $rentedCount)
                ->description($this->formatDescription($rentedGrowth))
                ->descriptionIcon($this->getIcon($rentedGrowth))
                ->color($this->getColor($rentedGrowth)),
        ];
    }

    // 🔹 Calculate growth percentage safely
    private function calculateGrowth(int $current, int $previous): float
    {
        if ($previous === 0) {
            return $current > 0 ? 100.0 : 0.0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }

    // 🔹 Format description text for Stat
    private function formatDescription(float $growth): string
    {
        return $growth >= 0
            ? "{$growth}% increase this month"
            : abs($growth) . "% decrease this month";
    }

    // 🔹 Return icon based on growth direction
    private function getIcon(float $growth): string
    {
        return $growth >= 0
            ? 'heroicon-m-arrow-trending-up'
            : 'heroicon-m-arrow-trending-down';
    }

    // 🔹 Return color for Stat based on growth
    private function getColor(float $growth): string
    {
        return $growth >= 0 ? 'success' : 'danger';
    }
}
