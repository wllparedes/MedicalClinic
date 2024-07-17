<section class="w-full animate-pulse" wire:loading>
    <x-card title="Horario del Doctor">
        <div class="flex justify-between flex-col gap-3">
            @for ($i = 0; $i < 5; $i++)
                <div class="flex gap-3">
                    <span class="w-16 truncate text-xs font-semibold">
                        <div class="h-2 bg-gray-200 rounded-full w-16"></div>
                    </span>
                    <div class="flex flex-wrap gap-2">

                        @for ($y = 0; $y < 2; $y++)
                            <x-badge outline gray label="12:00 a 15:00" />
                        @endfor

                    </div>
                </div>
            @endfor

        </div>
    </x-card>
</section>
