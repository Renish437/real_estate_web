<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum ListingType: string implements HasLabel, HasColor, HasIcon
{
    case Sale = 'sale';
    case Rent = 'rent';

    public function getLabel(): string
    {
        return match ($this) {
            self::Sale => 'For Sale',
            self::Rent => 'For Rent',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Sale => 'success',
            self::Rent => 'warning',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Sale => 'heroicon-o-currency-dollar',
            self::Rent => 'heroicon-o-home',
        };
    }
}
