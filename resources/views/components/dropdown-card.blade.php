<section {{ $attributes->merge(['class' => 'border border-slate-300 rounded-md p-2 transition-[height]']) }}
    x-data="{ open: {{ $open }} }" :class="{
        'h-[50px]': !open,
        'h-auto': open,
    }">
    <div class="dropdown_card flex justify-between items-center h-8">
        <span class="text-primary font-semibold text-lg">
            {{ $title }}
        </span>
        <div class="flex gap-2 text-slate-500 cursor-pointer select-none" @click="open = !open">
            <span class="text-xs" x-show="open">Ocultar</span>
            <x-icon name="chevron-up" class="w-4 h-4" x-show="open" />
            <span class="text-xs" x-show="open == false" x-cloak>Mostrar</span>
            <x-icon name="chevron-down" class="w-4 h-4" x-show="open == false" x-cloak />
        </div>
    </div>

    <div class="dropdown_card" x-show="open" x-cloak>

        <hr class="h-px my-2 bg-gray-300 border-0">

        {{ $slot }}

    </div>

</section>
