<?php

namespace App\Filament\Resources\Enquiries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Section::make('Enquiry Form')
               ->columns(2)
               ->description("Fill out enquiry form if the customer or owner has something")
               ->schema([
              
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                       Select::make('property_id')
                ->label("Property")
                ->relationship('property','title')
                    ->required()
                    ->searchable()
                    ->preload(),
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('ip_address'),
                TextInput::make('user_agent'),
               ])->columnSpanFull()
            ]);
    }
}
