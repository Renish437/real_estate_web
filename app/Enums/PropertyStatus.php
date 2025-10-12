<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum PropertyStatus: string implements HasLabel, HasColor, HasIcon
{
    case Available = 'available';
    case Sold = 'sold';
    case Pending = 'pending';
    case Draft = 'draft';
    case Rented = 'rented';

    public function getLabel(): string
    {
        return ucfirst($this->value);
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Available => 'success',
            self::Sold => 'danger',
            self::Pending => 'warning',
            self::Draft => 'gray',
            self::Rented => 'info',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Available => 'heroicon-o-check-circle',
            self::Sold => 'heroicon-o-x-circle',
            self::Pending => 'heroicon-o-clock',
            self::Draft => 'heroicon-o-document',
            self::Rented => 'heroicon-o-home-modern',
        };
    }
}
