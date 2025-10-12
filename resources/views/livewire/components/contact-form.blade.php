<div class="bg-white dark:bg-gray-800 rounded-b-xl p-6 shadow-lg">
@if($showSuccess)
<div 
    class="mb-4 p-4 rounded-lg border bg-green-100 dark:bg-green-900/30 border-green-400 dark:border-green-700
           text-green-700 dark:text-green-300 transition-all duration-300 max-w-md mx-auto">

    <!-- Top row: Icon + main message -->
    <div class="flex items-center space-x-2 mb-2">
        <!-- Success Icon -->
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                  clip-rule="evenodd" />
        </svg>
        <span class="font-medium text-sm sm:text-base">Message sent successfully!</span>
    </div>

    <!-- Bottom row: Secondary text + close button -->
    <div class="flex justify-between items-center">
        <!-- Secondary text -->
        <p class="text-xs sm:text-sm dark:text-green-400">
            We'll get back to you within 24 hours.
        </p>

        <!-- Close button -->
        <button wire:click="hideSuccess"
                class="text-green-700 dark:text-green-300 hover:text-green-900 dark:hover:text-green-100 transition-colors duration-200">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
@endif




    @if($errors->has('form'))
        <!-- Updated: Dark mode for general error alert -->
        <div
            class="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 rounded-lg">
            {{ $errors->first('form') }}
        </div>
    @endif

    <form wire:submit="submit" class="space-y-4">
        <div>
            <!-- Updated: Dark mode text for label -->
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name *</label>
            <input type="text" id="name" wire:model="name" 
            class="w-full p-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm bg-white dark:bg-gray-700
            dark:text-white focus:outline-none focus:ring-2 transition focus:border-violet-500 focus:ring-violet-500"
            placeholder="Your full name">
            @error('name')
                <!-- Updated: Dark mode text for error message -->
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <!-- Updated: Dark mode text for label -->
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email *</label>
            <input type="email" id="email" wire:model="email" 
            class="w-full p-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm bg-white dark:bg-gray-700
            dark:text-white focus:outline-none focus:ring-2 transition focus:border-violet-500 focus:ring-violet-500"
            placeholder="your.email@example.com">
            @error('email')
                <!-- Updated: Dark mode text for error message -->
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <!-- Updated: Dark mode text for label -->
            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
            <input type="tel" id="phone" wire:model="phone" 
            class="w-full p-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm bg-white dark:bg-gray-700
            dark:text-white focus:outline-none focus:ring-2 transition focus:border-violet-500 focus:ring-violet-500"
            placeholder="+255 123 456 789">
            @error('phone')
                <!-- Updated: Dark mode text for error message -->
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <!-- Updated: Dark mode text for label -->
            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Message
                *</label>
            <textarea id="message" wire:model="message" rows="4" 
                      class="w-full p-2 rounded-md border border-gray-300 dark:border-gray-600 shadow-sm bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 transition focus:border-violet-500 focus:ring-violet-500"
                      placeholder="Tell us about your interest in this property..."></textarea>
            @error('message')
                <!-- Updated: Dark mode text for error message -->
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
            <!-- Updated: Dark mode text for help message -->
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimum 10 characters</p>
        </div>

        <!-- The button remains the same as it uses solid colors which look good in both modes -->
<button type="submit" wire:loading.attr="disabled"
    class="w-full bg-violet-600 text-white py-2 px-6 rounded-md 
           hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500 
           focus:ring-offset-2 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed 
           flex items-center justify-center min-h-[40px]">

    <!-- Default text -->
    <span wire:loading.remove class="text-sm sm:text-base">Send Message</span>

    <!-- Loading spinner -->
    <span wire:loading class="inline-flex items-center space-x-2 text-sm sm:text-base">
        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
      
    </span>
</button>





    </form>

   @push('scripts')
        <script>
        // Note: Livewire scripts are maintained for component fidelity
        document.addEventListener('livewire:initialized', function () {
            Livewire.on('showSuccess', function () {
                setTimeout(function () {
                    Livewire.dispatch('hideSuccess');
                }, 5000);
            });
        });
    </script>
   @endpush

</div>