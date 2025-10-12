
<div>
         <div class="min-h-screen bg-gray-50 dark:bg-gray-950">
        <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <nav class="flex text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
                    <a wire:navigate href="{{ route('properties.index') }}"
                        class="hover:text-gray-700 dark:hover:text-gray-200">Properties</a>
                    <span class="mx-2">/</span>
                    <a wire:navigate href="{{ route('properties.index') }}?city={{ $property->city }}"
                        class="hover:text-gray-700 dark:hover:text-gray-200">{{ $property->city }}</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900 dark:text-white">{{ $property->title }}</span>
                </nav>
            </div>
        </div>
        {{-- main content --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                {{-- Main Content --}}
                <div class="lg:col-span-2">
                    {{-- Property Header: Light bg-white / Dark bg-gray-800 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $property->title }}
                                </h1>
                                <p class="text-lg text-gray-600 dark:text-gray-300">📍 {{ $property->full_address }}</p>
                            </div>
                            <div class="text-right">
                                @if($property->isFeatured())
                                    <span
                                        class="inline-block bg-yellow-500 text-white px-3 py-1 text-sm font-semibold rounded mb-2">FEATURED</span><br>
                                @endif
                                <span
                                    class="inline-block bg-{{ $property->listing_type->value === 'sale' ? 'green' : 'violet' }}-500 text-white px-3 py-1 text-sm font-semibold rounded uppercase">
                                    {{ $property->listing_type->value }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="text-3xl font-bold text-green-600">{{ $property->formatted_price }}</div>
                            @if($property->price_per_sqft)
                                <div class="text-lg text-gray-500 dark:text-gray-400">NPR
                                    {{ number_format($property->price_per_sqft, 0) }} per
                                    sqft</div>
                            @endif
                        </div>
                    </div>

                    {{-- Property Images: Light bg-white / Dark bg-gray-800 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden mb-6">
                        @if($property->images && count($property->images) > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                                @foreach($property->images as $index => $image)
                                    <div class="{{ $index === 0 ? 'md:col-span-2' : '' }}">
                                        <img src="{{ Storage::url($image) }}" alt="Property image {{ $index + 1 }}"
                                            class="w-full {{ $index === 0 ? ' h-96' : 'h-38' }} object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                                            onclick="openImageModal('{{ Storage::url($image) }}')">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- Placeholder: Light bg-gray-200 / Dark bg-gray-700 --}}
                            <div class="h-64 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <div class="text-center">
                                    <span class="text-6xl mb-2 block">{{ $property->type_icon }}</span>
                                    <p class="text-gray-500 dark:text-gray-300">No images available</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Property Details: Light bg-white / Dark bg-gray-800 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Property Details</h2>

                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                            @if($property->hall)
                                {{-- Detail Card: Light bg-gray-50 / Dark bg-gray-700 --}}
                                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="text-2xl mb-1">🛋️</div>
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ $property->bathrooms }}
                                    </div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">
                                        Hall{{ $property->hall > 1 ? 's' : '' }}
                                    </div>
                                </div>
                            @endif
                            @if($property->bedrooms)
                                {{-- Detail Card: Light bg-gray-50 / Dark bg-gray-700 --}}
                                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="text-2xl mb-1">🛏️</div>
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ $property->bedrooms }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">
                                        Bedroom{{ $property->bedrooms > 1 ? 's' : '' }}</div>
                                </div>
                            @endif

                            @if($property->bathrooms)
                                {{-- Detail Card: Light bg-gray-50 / Dark bg-gray-700 --}}
                                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="text-2xl mb-1">🚿</div>
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ $property->bathrooms }}
                                    </div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">
                                        Bathroom{{ $property->bathrooms > 1 ? 's' : '' }}
                                    </div>
                                </div>
                            @endif
                            

                            @if($property->total_area)
                                {{-- Detail Card: Light bg-gray-50 / Dark bg-gray-700 --}}
                                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="text-2xl mb-1">📐</div>
                                    <div class="font-semibold text-gray-900 dark:text-white">
                                        {{ number_format($property->total_area) }}
                                    </div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">Square Feet</div>
                                </div>
                            @endif

                            @if($property->built_year)
                                {{-- Detail Card: Light bg-gray-50 / Dark bg-gray-700 --}}
                                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="text-2xl mb-1">📅</div>
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ $property->built_year }}
                                    </div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">Year Built</div>
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Property Information</h3>
                                <ul class="space-y-1 text-gray-600 dark:text-gray-300">
                                    <li><span class="font-medium">Type:</span> {{ ucfirst($property->type->value) }}</li>
                                    <li><span class="font-medium">Status:</span>
                                        <span
                                            class="px-2 py-1 bg-{{ $property->status_color }}-100 text-{{ $property->status_color }}-800 dark:bg-{{ $property->status_color }}-900 dark:text-{{ $property->status_color }}-200 rounded text-xs font-medium">
                                            {{ ucfirst($property->status->value) }}
                                        </span>
                                    </li>
                                    @if($property->furnished !== null)
                                        <li><span class="font-medium">Furnished:</span>
                                            {{ $property->furnished ? 'Yes' : 'No' }}</li>
                                    @endif
                                    @if($property->parking)
                                        <li><span class="font-medium">Parking:</span>
                                            {{ $property->parking_spaces ? $property->parking_spaces . ' spaces' : 'Available' }}
                                        </li>
                                    @endif
                                </ul>
                            </div>

<?php
    $features = is_array($property->features) ? $property->features : json_decode($property->features, true);
?>

@if(!empty($features))
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Features & Amenities</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($property->features as $feature)
                                            <span
                                                class="px-3 py-1 bg-violet-100 text-violet-800 dark:bg-violet-900 dark:text-violet-200 text-xs font-medium rounded-full">
                                                {{ $feature }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Property Description: Light bg-white / Dark bg-gray-800 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">About This Property</h2>
                        {{-- Note: prose needs dark mode config, but we target text color directly for simplicity --}}
                        <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                            {!! $property->description!!}
                        </div>
                    </div>

                    {{-- Location Map: Light bg-white / Dark bg-gray-800 --}}
                 @if($property->latitude && $property->longitude)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Location</h2>

        <div class="h-64 w-full rounded-lg overflow-hidden">
            <iframe
                width="100%"
                height="100%"
                frameborder="0"
                scrolling="no"
                marginheight="0"
                marginwidth="0"
                src="https://www.openstreetmap.org/export/embed.html?bbox={{ $property->longitude - 0.01 }},{{ $property->latitude - 0.01 }},{{ $property->longitude + 0.01 }},{{ $property->latitude + 0.01 }}&layer=mapnik&marker={{ $property->latitude }},{{ $property->longitude }}">
            </iframe>
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
            Coordinates: {{ $property->latitude }}, {{ $property->longitude }}
        </p>
    </div>
@endif


                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 mt-8 lg:mt-0">
                    {{-- Contact Form: Light bg-white / Dark bg-gray-800 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg  p-5 mb-6 top-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Interested in this property?
                        </h3>

                        @if($property->contact_name || $property->contact_phone || $property->contact_email)
                            {{-- Contact Info Card: Light bg-gray-50 / Dark bg-gray-700 --}}
                          <div class="bg-white dark:bg-gray-800 shadow-md rounded-t-xl p-5   transition">
    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
        📞 Contact Information
    </h4>

    <div class="space-y-3 text-sm">
        @if($property->contact_name)
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700 dark:text-gray-300">Name</span>
                <span class="text-gray-900 dark:text-gray-100">{{ $property->contact_name }}</span>
            </div>
        @endif

        @if($property->contact_phone)
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700 dark:text-gray-300">Phone</span>
                <a href="tel:{{ $property->contact_phone }}"
                   class="text-violet-600 hover:underline dark:text-violet-400">
                    {{ $property->contact_phone }}
                </a>
            </div>
        @endif

        @if($property->contact_email)
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700 dark:text-gray-300">Email</span>
                <a href="mailto:{{ $property->contact_email }}"
                   class="text-violet-600 hover:underline dark:text-violet-400 truncate max-w-[180px] text-right">
                    {{ $property->contact_email }}
                </a>
            </div>
        @endif
    </div>
</div>

                        @endif

                        <livewire:components.contact-form :property="$property" />
                    </div>

                    {{-- Quick Actions: Light bg-white / Dark bg-gray-800 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            @if($property->contact_phone)
                                <a  href="tel:{{ $property->contact_phone }}"
                                    class="block w-full bg-green-600 text-white text-center py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-300">
                                    📞 Call Now
                                </a>
                            @endif

                            @if($property->contact_email)
                                <a  href="mailto:{{ $property->contact_email }}?subject=Inquiry about {{ $property->title }}"
                                    class="block w-full bg-violet-600 text-white text-center py-2 px-4 rounded-md hover:bg-violet-700 transition-colors duration-300">
                                    ✉️ Send Email
                                </a>
                            @endif

                            <button onclick="shareProperty()"
                                class="block w-full bg-gray-600 text-white text-center py-2 px-4 rounded-md hover:bg-gray-700 transition-colors duration-300">
                                📤 Share Property
                            </button>

                            {{-- Back to Listings Button: Light bg-gray-100/text-gray-700 / Dark
                            bg-gray-700/text-gray-200 --}}
                            <a wire:navigate href="{{ route('properties.index') }}"
                                class="block w-full bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200 text-center py-2 px-4 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-300">
                                ← Back to Listings
                            </a>
                        </div>
                    </div>

                    {{-- Property Summary: Light bg-gray-50 / Dark bg-gray-700 --}}
             <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-5 border border-gray-200 dark:border-gray-700 transition">
    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
        🏡 Property Summary
    </h4>

    <div class="divide-y divide-gray-200 dark:divide-gray-700">
        <div class="py-2 flex justify-between text-sm">
            <span class="font-medium text-gray-700 dark:text-gray-300">Property ID</span>
            <span class="text-gray-900 dark:text-gray-100">#{{ $property->id }}</span>
        </div>

        <div class="py-2 flex justify-between text-sm">
            <span class="font-medium text-gray-700 dark:text-gray-300">Listed</span>
            <span class="text-gray-900 dark:text-gray-100">{{ $property->created_at->diffForHumans() }}</span>
        </div>

        <div class="py-2 flex justify-between text-sm">
            <span class="font-medium text-gray-700 dark:text-gray-300">Type</span>
            <span class="text-gray-900 dark:text-gray-100">{{ ucfirst($property->type->value) }}</span>
        </div>

        <div class="py-2 flex justify-between text-sm">
            <span class="font-medium text-gray-700 dark:text-gray-300">City</span>
            <span class="text-gray-900 dark:text-gray-100">{{ $property->city }}</span>
        </div>

        @if($property->total_area)
        <div class="py-2 flex justify-between text-sm">
            <span class="font-medium text-gray-700 dark:text-gray-300">Area</span>
            <span class="text-gray-900 dark:text-gray-100">{{ number_format($property->total_area) }} sqft</span>
        </div>
        @endif
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4">
        <div class="max-w-4xl max-h-full relative">
            <img id="modalImage" src="" alt="Property image" class="max-w-full max-h-full object-contain">
            <button onclick="closeImageModal()"
                class="absolute cursor-pointer top-4 right-4 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75">
                ✕
            </button>
        </div>
    </div>
    <div id="toastNotification"
        class="fixed bottom-5 right-5 bg-gray-900 text-white px-4 py-3 rounded-lg shadow-xl transition-opacity duration-300 opacity-0 pointer-events-none z-50">
        <span id="toastMessage"></span>
    </div>
   @push('scripts')
        <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Function to show the custom toast notification
        function showToast(message) {
            const toast = document.getElementById('toastNotification');
            const toastMessage = document.getElementById('toastMessage');

            // Set message and make toast visible
            toastMessage.textContent = message;
            // The user had broken class strings here, fixing them.
            toast.classList.remove('opacity-0', 'pointer-events-none');
            toast.classList.add('opacity-100');

            // Hide after 3 seconds
            setTimeout(() => {
                toast.classList.remove('opacity-100');
                toast.classList.add('opacity-0', 'pointer-events-none');
            }, 3000);

        }

        function shareProperty() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $property->title }}',
                    text: '{{ Str::limit($property->description, 100) }}',
                    url: window.location.href,
                });
            } else {
                // Fallback: copy to clipboard
                // Using document.execCommand('copy') as navigator.clipboard may be restricted in some environments (like iframes)
                const tempInput = document.createElement('input');
                tempInput.value = window.location.href;
                document.body.appendChild(tempInput);
                tempInput.select();
                try {
                    document.execCommand('copy');
                    showToast('Property link copied to clipboard!');
                } catch (err) {
                    console.error('Failed to copy text: ', err);
                    showToast('Failed to copy link. Check console for details.');
                }
                document.body.removeChild(tempInput);
            }
        }

        // Close modal on escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Close modal on outside click
        document.getElementById('imageModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
    </script>
   @endpush
</div>

