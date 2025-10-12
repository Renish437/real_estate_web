<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum PropertyType: string implements HasLabel, HasColor, HasIcon
{
    case Apartment = 'apartment';
    case House = 'house';
    case Condo = 'condo';
    case Land = 'land';
    case Townhouse = 'townhouse';
    case Villa = 'villa';
    case Commercial = 'commercial';

    public function getLabel(): string
    {
        return match ($this) {
            self::Apartment => 'Apartment',
            self::House => 'House',
            self::Condo => 'Condo',
            self::Land => 'Land',
            self::Townhouse => 'Townhouse',
            self::Villa => 'Villa',
            self::Commercial => 'Commercial',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Apartment => 'info',
            self::House => 'success',
            self::Condo => 'secondary',
            self::Land => 'gray',
            self::Townhouse => 'warning',
            self::Villa => 'pink',
            self::Commercial => 'primary',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Apartment => 'heroicon-o-building-office-2',
            self::House => 'heroicon-o-home-modern',
            self::Condo => 'heroicon-o-building-library',
            self::Land => 'heroicon-o-map',
            self::Townhouse => 'heroicon-o-home',
            self::Villa => 'heroicon-o-sparkles',
            self::Commercial => 'heroicon-o-building-storefront',
        };
    }
}
