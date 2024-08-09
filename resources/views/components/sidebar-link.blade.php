<li x-data="{ hiddenLabel: $persist(false) }" x-on:sidebar-function.window="hiddenLabel = !hiddenLabel"
    x-on:open-sidebar.window="hiddenLabel = false"
    x-on:resize.window="open = window.innerWidth > 640, hiddenLabel = false">
    <a href="{{ route($route) }}" {{ $spa ? 'wire:navigate' : '' }}
        class="{{ setActive($route . '*') }} link-db  flex  p-2 h-[50px] rounded-lg group text-white link-sidebar"
        :class="{ 'justify-center': hiddenLabel, 'justify-between': !hiddenLabel }">

        <div class="flex items-center">
            <x-icon :name="$icon" class="w-5 h-5" />
            <span x-show="!hiddenLabel" class="ms-3">{{ __($label) }}</span>
        </div>

        @if ($qty)
            <span
                class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white rounded-full bg-gradient-to-r from-teal-500 to-cyan-600">
                {{ $qty }}
            </span>
        @endif

    </a>
</li>
