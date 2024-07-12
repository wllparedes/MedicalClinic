<div>
    <div class="flex justify-between items-end mb-1">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
        </label>
    </div>
    <div class="relative rounded-md  shadow-sm flex gap-3 items-center h-1/2 text-sm">
        <x-radio id="345423534" left-label="{{ $left }}" value="{{ $valueLeft }}" wire:model="value" />
        <x-radio id="35423534534" left-label="{{ $right }}" value="{{ $valueRight }}" wire:model="value" />
    </div>
</div>
