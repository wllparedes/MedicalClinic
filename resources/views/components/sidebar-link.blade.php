<li>
    <a href="{{ route($route) }}" {{ $spa ? 'wire:navigate' : '' }}
        class="{{ setActive($route . '*') }} link-db  flex justify-between p-2 rounded-lg group text-white link-sidebar">

        <div class="flex items-center">
            <x-icon :name="$icon" class="w-5 h-5" />
            <span class="ms-3">{{ __($label) }}</span>
        </div>

        @if ($qty)
            <span
                class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white rounded-full bg-gradient-to-r from-teal-500 to-sky-600">
                {{ $qty }}
            </span>
        @endif

    </a>
</li>
