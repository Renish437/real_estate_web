<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Models\Property;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->description('Fill out the basic info first')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdatedJs(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->disabled()
                            ->dehydrated(),

                        Select::make('type')
                            ->options(Property::getPropertyTypes())
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('listing_type')
                            ->options(Property::getListingTypes())
                            ->default('sale')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('status')
                            ->options(Property::getStatuses())
                            ->default('available')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])->columns(2),


                Section::make('Locations')
                    ->description('Provide the location fof the property')
                    ->schema([
                        Flex::make([
                            TextInput::make('city')
                                ->required(),
                            TextInput::make('state')
                                ->required(),
                            TextInput::make('country')
                                ->required()
                                ->default('Nepal'),

                        ])->columnSpanFull(),
                        TextInput::make('address')
                            ->required(),
                        TextInput::make('postal_code'),

                        TextInput::make('latitude')
                            ->numeric(),
                        TextInput::make('longitude')
                            ->numeric(),
                    ])->columns(2),
                Section::make('Description')
                    ->description('You can add long description attaching images,links etc.')
                    ->columnSpanFull()
                    ->schema([
                        RichEditor::make('description')
                            ->label('Property Description')

                            ->extraAttributes([
                                'class' => 'p-10',
                            ])
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Section::make('Property Details')
                 ->description('Fill out property details properly and precise')
                    ->columnSpanFull()
                    ->schema([

                        TextInput::make('bedrooms')
                            ->numeric()
                            ->label('Bedrooms')
                            ->extraAttributes(['class' => 'w-full']),

                        TextInput::make('bathrooms')
                            ->numeric()
                            ->label('Bathrooms')
                            ->extraAttributes(['class' => 'w-full']),

                        TextInput::make('hall')
                            ->numeric()
                            ->label('Hall')
                            ->extraAttributes(['class' => 'w-full']),

                        TextInput::make('other_rooms_count')
                            ->numeric()
                            ->label('Other Rooms')
                            ->extraAttributes(['class' => 'w-full']),


                        TextInput::make('total_area')
                            ->numeric()
                            ->suffix('sqft')
                            ->label('Total Area')
                            ->extraAttributes(['class' => 'w-full']),

                        TextInput::make('built_year')
                            ->numeric()
                            ->label('Built Year')
                            ->extraAttributes(['class' => 'w-full']),



                        // Row 3
                        Toggle::make('furnished')
                            ->required()
                            ->label('Furnished')
                            ->extraAttributes(['class' => 'w-full']),

                        Toggle::make('parking')
                            ->required()
                            ->label('Parking')
                            ->live()
                            ->extraAttributes(['class' => 'w-full']),
                        TextInput::make('parking_spaces')
                            ->numeric()
                            ->label('Parking Spaces')
                            ->visible(fn(Get $get): bool => $get('parking'))
                            ->extraAttributes(['class' => 'w-full']),
                    ])
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3,
                    ]),


                Section::make('Contact Information')
                ->description('Provide the information of owner of the property.')
                    ->schema([
                        TextInput::make('contact_name'),
                        TextInput::make('contact_phone')
                            ->tel(),
                        TextInput::make('contact_email')
                            ->email(),
                    ])->columns(3),
                Section::make('Pricing')
                ->description('Fill out the pricing for property')
                    ->columns(2)
                    ->schema([
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('NPR'),
                        TextInput::make('price_per_sqft')
                            ->prefix('NPR')
                            ->numeric(),
                    ]),
                Section::make('Features & Images')
                ->description('Make sure tags are entered and added one by one and images are reorderable too.')
                    ->columns(1)
                    ->schema([
                        TagsInput::make('features')
    ->placeholder('Add Tags')
    ->helperText('Add features like garden, pool, gym, etc.')
    ->label('Property Features')
    ->separator(',') // optional
    ->reorderable() // optional
    ->suggestions([
        'Swimming Pool', 'Garden', 'Security', 'Gym', 'Parking',
        'Balcony', 'Rooftop', 'Fireplace', 'Backup Generator', 'Solar Power'
    ])
   ,

                        FileUpload::make('images')
                            ->disk('public')
                            ->panelLayout('grid')  // shows thumbnails in a grid
                            ->multiple()
                            ->reorderable()
                            ->maxFiles(10)
                            ->directory('property-images'),



                    ])->columnSpanFull(),
                Section::make('SEOs')
                ->description('Fill out the fields for proper SEO optimization and Crawls.')
                    ->schema([

                        TextInput::make('meta_title'),
                        Textarea::make('meta_description'),
                    ])->columns(1),
                Section::make('Visibilty')
                ->description('Provide the visibilty to fields shown below.')
                    ->schema([
                        Toggle::make('is_active')
                            ->required(),
                        Toggle::make('is_featured')
                            ->required()
                            ->live(),
                        DateTimePicker::make('featured_until')
                            ->visible(fn(Get $get): bool => $get('is_featured')),
                    ])->columns(1),


            ]);
    }
}
