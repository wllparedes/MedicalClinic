<section id="dropdown_card" class="w-full border border-slate-300 rounded-md p-2" x-data="{ open: true }">

    <div class="dropdown_card flex justify-between items-center h-8">
        <span class="text-primary font-semibold text-lg">
            {{ $title }}
        </span>
        <div class="flex gap-2 text-slate-500 cursor-pointer" @click="open = !open">
            <span class="text-xs" x-show="open">Ocultar</span>
            <x-icon name="chevron-up" class="w-4 h-4" x-show="open" />
            <span class="text-xs" x-show="open == false" x-cloak>Mostrar</span>
            <x-icon name="chevron-down" class="w-4 h-4" x-show="open == false" x-cloak />
        </div>
    </div>

    <div class="dropdown_card" x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90">

        <hr class="h-px my-2 bg-gray-300 border-0">

        {{ $slot }}

    </div>

</section>
