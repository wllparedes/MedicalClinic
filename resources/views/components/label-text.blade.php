<div>
    <div class="flex mb-1 justify-between items-end">
        <label class="block text-sm font-medium disabled:opacity-60 text-gray-700">
            {{ $label }}
        </label>
    </div>

    <div
        class="p-3 border-1 border-slate-100 rounded-md shadow-md @if ($height !== 'normal') h-[{{ $height }}] overflow-auto @endif">

        @if ($link)
            <a href="{{ $text }}" class="text-primary hover:underline transition-all" target="_BLANK">
                {{ $text }}
            </a>
        @else
            {{ $text }}
        @endif

    </div>
</div>
