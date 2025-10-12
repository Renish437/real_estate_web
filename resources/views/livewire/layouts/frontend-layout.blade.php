{{-- resources/views/livewire/components/layouts/frontend-layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ' Real Estate Properties' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 dark:bg-neutral-900 text-gray-900 dark:text-gray-100">
     {{-- Navigation --}}
    <nav class="bg-white dark:bg-neutral-900 shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <div class="flex items-center">
                    <a wire:navigate href="{{ route('properties.index') }}" class="flex items-center space-x-2">
                        <span class="text-2xl">🏠</span>
                        <span class="text-xl font-bold text-gray-900 dark:text-gray-200">Real Estate App</span>
                    </a>
                </div>

                {{-- Navigation Links --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a wire:navigate href="{{ route('properties.index') }}"
                        class="text-gray-600 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('properties.index') ? 'text-violet-600 ' : '' }}">
                        All Properties
                    </a>
                    <a wire:navigate href="{{ route('properties.index', ['listingType' => 'sale']) }}"
                        class="text-gray-600 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                        For Sale
                    </a>
                    <a wire:navigate href="{{ route('properties.index', ['listingType' => 'rent']) }}"
                        class="text-gray-600 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                        For Rent
                    </a>
                    <a wire:navigate href="{{ route('properties.index', ['featuredOnly' => true]) }}"
                        class="text-gray-600 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                        Featured
                    </a>
                </div>

                {{-- Mobile menu button --}}
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button"
                        class="text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-violet-500 p-2 rounded-md">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div class="md:hidden" id="mobile-menu" style="display: none;">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white dark:bg-neutral-900 border-t border-gray-200">
                <a wire:navigate href="{{ route('properties.index') }}"
                    class="text-gray-600 hover:text-gray-900 dark:hover:text-gray-300 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('properties.index') ? 'text-violet-600 bg-violet-50' : '' }}">
                    All Properties
                </a>
                <a wire:navigate href="{{ route('properties.index', ['listingType' => 'sale']) }}"
                    class="text-gray-600 hover:text-gray-900 dark:hover:text-gray-300 block px-3 py-2 rounded-md text-base font-medium">
                    For Sale
                </a>
                <a wire:navigate href="{{ route('properties.index', ['listingType' => 'rent']) }}"
                    class="text-gray-600 hover:text-gray-900 dark:hover:text-gray-300 block px-3 py-2 rounded-md text-base font-medium">
                    For Rent
                </a>
                <a wire:navigate href="{{ route('properties.index', ['featuredOnly' => true]) }}"
                    class="text-gray-600 hover:text-gray-900 dark:hover:text-gray-300 block px-3 py-2 rounded-md text-base font-medium">
                    Featured
                </a>
            </div>
        </div>
    </nav>
    {{ $slot }}
    {{-- Footer --}}
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                {{-- Company Info --}}
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="text-2xl">🏠</span>
                        <span class="text-xl font-bold">Real Estate App</span>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Your trusted partner in finding the perfect property in Tanzania.
                        We offer the best selection of houses, apartments, land, and commercial properties.
                    </p>
                    <div class="flex space-x-4">
                        <a wire:navigate href="#" class="text-gray-300 hover:text-white">📘 Facebook</a>
                        <a wire:navigate href="#" class="text-gray-300 hover:text-white">📷 Instagram</a>
                        <a wire:navigate href="#" class="text-gray-300 hover:text-white">🐦 Twitter</a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a wire:navigate href="{{ route('properties.index') }}" class="hover:text-white">All Properties</a></li>
                        <li><a wire:navigate href="{{ route('properties.index', ['listingType' => 'sale']) }}"
                                class="hover:text-white">For Sale</a></li>
                        <li><a wire:navigate href="{{ route('properties.index', ['listingType' => 'rent']) }}"
                                class="hover:text-white">For Rent</a></li>
                        <li><a wire:navigate href="{{ route('properties.index', ['featuredOnly' => true]) }}"
                                class="hover:text-white">Featured</a></li>
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li>📍 Dar es Salaam, Tanzania</li>
                        <li>📞 +255 123 456 789</li>
                        <li>✉️ info@realestate.tz</li>
                        <li>🕐 Mon - Fri: 9AM - 6PM</li>
                    </ul>
                </div>
            </div>

            {{-- Bottom Footer --}}
            <div class="border-t border-gray-700 pt-8 mt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        © {{ date('Y') }} Real Estate App. All rights reserved.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a wire:navigate href="#" class="text-gray-400 hover:text-white text-sm">Privacy Policy</a>
                        <a wire:navigate href="#" class="text-gray-400 hover:text-white text-sm">Terms of Service</a>
                        <a wire:navigate href="#" class="text-gray-400 hover:text-white text-sm">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
   @stack('scripts')
</body>
</html>
