<li>
    <div class="flex items-center text-pretty">

        @if ($prev)
            <x-icon name="chevron-right" class="w-4 h-4 text-gray-600" />
        @endif

        @if ($var)
            <a href="{{ route($route, $var) }}" {{ $spa ? 'wire:navigate' : '' }}
                class="ms-1 font-medium text-gray-600 md:ms-2  text-sm">
                {{ $label }}
            </a>
        @else
            <a href="{{ route($route) }}" {{ $spa ? 'wire:navigate' : '' }}
                class="ms-1 font-medium text-gray-600 md:ms-2  text-sm">
                {{ $label }}
            </a>
        @endif

    </div>
</li>
