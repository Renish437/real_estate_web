<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;

class PropertyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('slug'),
                View::make('description')
                ->view('filament.pages.property.description')
                    ->columnSpanFull(),
                TextEntry::make('type')
                    ->badge(),
                ImageEntry::make('images')
                ->disk('public')
                
                ->columnSpanFull(),
                TextEntry::make('listing_type')
                    ->badge(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('price')
                    ->money('NPR'),
                TextEntry::make('features')
                    ->badge(),
                TextEntry::make('price_per_sqft')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('address'),
                TextEntry::make('state'),
                TextEntry::make('city'),
                TextEntry::make('country'),
                TextEntry::make('postal_code')
                    ->placeholder('-'),
                TextEntry::make('latitude')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('longitude')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('bedrooms')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('bathrooms')
                    ->numeric()
                    ->placeholder('-'),
                IconEntry::make('hall')
                    ->boolean(),
                TextEntry::make('other_rooms_count')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('total_area')
                    ->numeric()
                    ->suffix(' sqft')
                    ->placeholder('-'),
                TextEntry::make('built_year')
                    ->numeric()
                    ->placeholder('-'),

                IconEntry::make('furnished')
                    ->boolean(),
                IconEntry::make('parking')
                    ->boolean(),
                TextEntry::make('parking_spaces')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('meta_title')
                    ->placeholder('-'),
                TextEntry::make('meta_description')
                    ->placeholder('-'),
                IconEntry::make('is_featured')
                    ->boolean(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('featured_until')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('contact_name')
                    ->placeholder('-'),
                TextEntry::make('contact_phone')
                    ->placeholder('-'),
                TextEntry::make('contact_email')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
