<div class="min-h-screen bg-gray-50 dark:bg-neutral-900">
    {{-- Header Section --}}
    <div class="bg-white dark:bg-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Find Your Dream Property</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">Discover the best real estate opportunities in
                    Nepal</p>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Filters Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                {{-- Search --}}
                <div>
                    {{-- Adjusted label text color for better contrast in light mode --}}
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search properties..."
                        {{-- Added text color for both modes and dark border color --}}
                        class="w-full text-gray-900 dark:text-gray-200 dark:bg-gray-700 p-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:border-violet-500 focus:ring-violet-500 transition">
                </div>

                {{-- Property Type --}}
                <div>
                    {{-- Adjusted label text color for better contrast in light mode --}}
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Property Type</label>
                    <select wire:model.live="type" {{-- Added text color for both modes and dark border color --}}
                        class="w-full text-gray-900 dark:text-gray-200  dark:bg-gray-700 py-2.5 px-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:border-violet-500 focus:ring-violet-500 transition">
                        <option value="">All Types</option>
                        @foreach ($propertyTypes as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach


                    </select>


                </div>

                {{-- Listing Type --}}
                <div>
                    {{-- Adjusted label text color for better contrast in light mode --}}
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Listing Type</label>
                    <select wire:model.live="listingType" {{-- Added text color for both modes and dark border color --}}
                        class="w-full text-gray-900 dark:text-gray-200 dark:bg-gray-700 py-2.5 px-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:border-violet-500 focus:ring-violet-500 transition">
                        <option value="">For Sale & Rent</option>
                        @foreach ($listingTypes as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- City --}}
                <div>
                    {{-- Adjusted label text color for better contrast in light mode --}}
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                    <select wire:model.live="city" {{-- Added text color for both modes and dark border color --}}
                        class="w-full text-gray-900 dark:text-gray-200 dark:bg-gray-700 py-2.5 px-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:border-violet-500 focus:ring-violet-500 transition">
                        <option value="">All Cities</option>
                        @foreach ($cities as $cityOption)
                            <option value="{{ $cityOption }}">{{ $cityOption }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Advanced Filters --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Price Range --}}
                <div>
                    {{-- Adjusted label text color for better contrast in light mode --}}
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Min Price
                        (NPR)</label>
                    <input type="number" wire:model.live.debounce.500ms="minPrice" placeholder="Min price"
                        {{-- Added text color for both modes and dark border color --}}
                        class="w-full text-gray-900 dark:text-gray-200 dark:bg-gray-700 p-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:border-violet-500 focus:ring-violet-500 transition">
                </div>

                <div>
                    {{-- Adjusted label text color for better contrast in light mode --}}
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Max Price
                        (NPR)</label>
                    <input type="number" wire:model.live.debounce.500ms="maxPrice" placeholder="Max price"
                        {{-- Added text color for both modes and dark border color --}}
                        class="w-full text-gray-900 dark:text-gray-200 dark:bg-gray-700 p-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:border-violet-500 focus:ring-violet-500 transition">
                </div>

                {{-- Min Bedrooms --}}
                <div>
                    {{-- Adjusted label text color for better contrast in light mode --}}
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Min Bedrooms</label>
                    <select wire:model.live="minBedrooms" {{-- Added text color for both modes and dark border color --}}
                        class="w-full text-gray-900 dark:text-gray-200 dark:bg-gray-700 py-2.5 px-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:border-violet-500 focus:ring-violet-500 transition">
                        <option value="">Any</option>
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}">{{ $i }}+ bedroom{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- Featured Toggle --}}
                <div class="flex items-end">
                    <label class="flex items-center">
                        {{-- Added dark border to checkbox --}}
                        <input type="checkbox" wire:model.live="featuredOnly"
                            class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-violet-600 shadow-sm focus:outline-none focus:ring-2 transition focus:border-violet-500 focus:ring-violet-500">
                        {{-- Adjusted label text color for better contrast in light mode --}}
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Featured only</span>
                    </label>
                </div>
            </div>

            {{-- Actions --}}
            {{-- Added dark border color to separator --}}
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button wire:click="clearFilters"
                    class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-violet-700 transition-colors duration-300 font-medium">
                    Clear All Filters
                </button>

                <div class="flex items-center space-x-4">
                    {{-- View Mode Toggle --}}
                    <div class="flex items-center space-x-2">
                        <button wire:click="setViewMode('grid')" {{-- Added dark mode classes for active state --}}
                            class="p-2 rounded-md {{ $viewMode === 'grid' ? 'bg-violet-100 text-violet-600 dark:bg-violet-800 dark:text-violet-200' : 'text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300' }}">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </button>
                        <button wire:click="setViewMode('list')" {{-- Added dark mode classes for active state and hover --}}
                            class="p-2 rounded-md {{ $viewMode === 'list' ? 'bg-violet-100 text-violet-600 dark:bg-violet-800 dark:text-violet-200' : 'text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300' }}">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Results Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                {{-- Added dark text color to title --}}
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                    {{ $properties->total() }} Properties Found
                </h2>
                @if ($search || $type || $listingType || $city || $minPrice || $maxPrice || $minBedrooms || $featuredOnly)
                    {{-- Added dark text color to filtered text --}}
                    <span class="text-sm text-gray-500 dark:text-gray-400">with filters applied</span>
                @endif
            </div>

            {{-- Sort Options --}}
            <div class="flex items-center space-x-2">
                {{-- Added dark text color to sort label --}}
                <span class="text-sm text-gray-700 dark:text-gray-300">Sort by:</span>
                <select wire:model.live="sortBy" {{-- Added dark background, text, and border color to select --}}
                    class="text-sm px-4 py-2.5 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-violet-500 transition border-gray-300 dark:border-gray-600 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-gray-800 dark:text-gray-300">
                    <option value="created_at">Newest</option>
                    <option value="price">Price</option>
                    <option value="title">Name</option>
                    <option value="city">City</option>
                </select>
                {{-- Added dark text color and hover to sort button --}}
                <button wire:click="sortBy('{{ $sortBy }}')"
                    class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    @if ($sortDirection === 'asc')
                        ↑
                    @else
                        ↓
                    @endif
                </button>
            </div>
        </div>

        @if ($properties->count() > 0)
            <div
                class="{{ $viewMode === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6' : 'space-y-6' }}">
                @foreach ($properties as $property)
                <?php
$images = is_string($property->images)
    ? json_decode($property->images, true)
    : $property->images;
$mainImage = $images[0] ?? null;
?>
                    @if ($viewMode === 'grid')
                        {{-- Grid View --}}
                        <div
                            class="bg-white cursor-pointer dark:bg-gray-900 rounded-lg shadow-md overflow-hidden hover:shadow-lg  dark:hover:shadow-gray-700 transition-all duration-300 group">
                            <a wire:navigate href="{{ route('property.show',$property->slug) }}" class="relative ">
                                @if ($mainImage)
                                    <img src="{{ Storage::url($mainImage) }}" alt="{{ $property->title }}"
                                        class="w-full h-52 object-cover transition-transform duration-300 group-hover:scale-105"
                                        loading="lazy">
                                @else
                                    <div
                                        class="w-full h-52 bg-gray-200 dark:bg-gray-800 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </div>
                                @endif

                                @if ($property->isFeatured())
                                    <div class="absolute top-2 left-2">
                                        <span
                                            class="bg-yellow-400 text-white px-2 py-1 text-xs font-semibold uppercase rounded-full">Featured</span>
                                    </div>
                                @endif

                                <div class="absolute top-3 right-3 z-10">
                                    <span
                                        class="{{ $property->listing_type->value === 'sale' ? 'bg-emerald-500' : 'bg-violet-500' }} text-white px-3 py-1 text-xs font-semibold rounded-full uppercase">
                                        {{ $property->listing_type->value }}
                                    </span>
                                </div>



                              
                            </a>

                            <div class="p-4">
                                <a wire:navigate href="{{ route('property.show',$property->slug) }}" class="font-semibold text-base text-gray-900 dark:text-gray-100 mb-1 line-clamp-2">
                                    {{ $property->title }}</a>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-2 line-clamp-1">
                                    <svg class="w-4 h-4 inline-block mr-1 text-gray-600 dark:text-gray-400"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    {{ $property->full_address }}
                                </p>

                                <div class="flex items-center justify-between mb-3">
                                    <span
                                        class="text-lg font-bold text-green-600 dark:text-green-400">{{ $property->formatted_price }}</span>
                                    @if ($property->price_per_sqft)
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            <span class="mr-1">NPR </span>  {{ number_format($property->price_per_sqft, 0) }}/sqft</span>
                                    @endif
                                </div>

                                @if ($property->bedrooms || $property->bathrooms || $property->total_area)
                                    <div
                                        class="flex items-center space-x-3 text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        @if ($property->bedrooms)
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-600 dark:text-gray-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 9h18v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                </svg>
                                                {{ $property->bedrooms }}
                                            </span>
                                        @endif
                                        @if ($property->bathrooms)
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-600 dark:text-gray-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                                </svg>
                                                {{ $property->bathrooms }}
                                            </span>
                                        @endif
                                        @if ($property->total_area)
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-600 dark:text-gray-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                                </svg>
                                                {{ number_format($property->total_area) }} sqft
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                <a wire:navigate href="{{ route('property.show', $property->slug) }}"
                                    class="block w-full bg-violet-600 text-white text-center py-2 rounded-md hover:bg-violet-700 transition-colors duration-300 font-medium"
                                    aria-label="View details for {{ $property->title }}">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- List View --}}
                        <div
                            class="bg-white cursor-pointer dark:bg-gray-900 rounded-lg shadow-md overflow-hidden hover:shadow-lg dark:hover:shadow-gray-700 transition-all duration-300 group md:flex">
                            <a wire:navigate href="{{ route('property.show',$property->slug) }}" class="md:w-1/3 relative">
                                @if ($mainImage)
                                    <img src="{{ Storage::url($mainImage)}}" alt="{{ $property->title }}"
                                        class="w-full h-48 md:h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        loading="lazy">
                                @else
                                    <div
                                        class="w-full h-48 md:h-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2directorios/artefacts/8b4e2b3c-7c3a-4f5e-9b3c-7d2a9f8b6c3d.png2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </div>
                                @endif

                                @if ($property->isFeatured())
                                    <div class="absolute top-2 left-2">
                                        <span
                                            class="bg-yellow-400 text-white px-2 py-1 text-xs font-semibold rounded-full">Featured</span>
                                    </div>
                                @endif
                            </a>

                            <div class="md:w-2/3 p-4 relative">

                                <div class="absolute top-3 right-3">
                                    <span
                                        class="bg-{{ $property->listing_type->value === 'sale' ? 'emerald' : 'violet' }}-500 text-white px-3 py-1 text-xs font-semibold rounded-full uppercase">
                                        {{ $property->listing_type->value }}
                                    </span>
                                </div>


                                <p class="text-gray-600 dark:text-gray-400 mb-2">
                                    <svg class="w-4 h-4 inline-block mr-1 text-gray-600 dark:text-gray-400"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    {{ $property->full_address }}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mb-3 line-clamp-2">
                                    {!! Str::limit($property->description,200) !!}</p>

                                @if ($property->bedrooms || $property->bathrooms || $property->total_area)
                                    <div
                                        class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        @if ($property->bedrooms)
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-600 dark:text-gray-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 9h18v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                </svg>
                                                {{ $property->bedrooms }} bedrooms
                                            </span>
                                        @endif
                                        @if ($property->bathrooms)
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-600 dark:text-gray-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                                </svg>
                                                {{ $property->bathrooms }} bathrooms
                                            </span>
                                        @endif
                                        @if ($property->total_area)
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-600 dark:text-gray-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                                </svg>
                                                {{ number_format($property->total_area) }} sqft
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                <div class="flex items-center justify-between">
                                    <div>
                                        <span
                                            class="text-lg font-bold text-green-600 dark:text-green-400">{{ $property->formatted_price }}</span>
                                        @if ($property->price_per_sqft)
                                            <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">NPR
                                                {{ number_format($property->price_per_sqft, 0) }}/sqft</span>
                                        @endif
                                    </div>

                                    <a wire:navigate href="{{ route('property.show', $property->slug) }}"
                                        class="bg-violet-600 text-white px-6 py-2 rounded-md hover:bg-violet-700 transition-colors duration-300 font-medium"
                                        aria-label="View details for {{ $property->title }}">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>



            {{-- Pagination --}}
            <div class="mt-8" wire:ignore>
                {{ $properties->links() }}
            </div>
        @else
            {{-- No Results --}}
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🏠</div>
                {{-- Added dark text color to title and paragraph --}}
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">No properties found</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Try adjusting your search criteria or clearing some
                    filters.</p>
                <button wire:click="clearFilters"
                    class="bg-violet-600 text-white px-4 py-2 rounded-md hover:bg-violet-700 transition-colors duration-300">
                    Clear All Filters
                </button>
            </div>
        @endif
    </div>
</div>
