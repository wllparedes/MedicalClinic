<li>
    <div class="flex items-center">

        @if ($prev)
            <x-icon name="chevron-right" class="w-4 h-4 text-gray-600" />
        @else
            <x-icon :name="$icon" class="w-4 h-4 text-gray-600" />
        @endif

        @if ($var)
            <a href="{{ route($route, $var) }}" {{ $spa ? 'wire:navigate' : '' }}
                class="ms-1 text-sm font-medium text-gray-500 md:ms-2">
                {{ $label }}
            </a>
        @else
            <a href="{{ route($route) }}" {{ $spa ? 'wire:navigate' : '' }}
                class="ms-1 text-sm font-medium text-gray-500 md:ms-2">
                {{ $label }}
            </a>
        @endif

    </div>
</li>
