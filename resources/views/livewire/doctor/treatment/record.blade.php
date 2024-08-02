<div class="flex gap-4 flex-col">

    @foreach ($treatments as $treatment)
        <div class="w-full p-2 flex gap-2 border-2 border-double shadow-sm border-amber-400 rounded-md justify-between">

            <div class="container-information">
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Tratamiento:</span>
                        <span class="text-gray-500 italic ">
                            {{ $treatment->treatment }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Nota:</span>
                        <span class="text-gray-500 italic ">
                            {{ $treatment->note ?? '-' }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Necesita medicamentos:</span>
                        <span class="text-gray-500 italic ">
                            {{ $treatment->need_products ? 'SI' : 'NO' }}
                        </span>
                    </div>
                </div>

                @if ($treatment->need_products)
                    <p class="font-semibold text-sm text-gray-600">Medicamentos:</p>

                    <nav class="text-xs text-gray-500">
                        @forelse ($treatment->products as $product)
                            <li>
                                {{ $product->name }}
                                - Horas:
                                {{ $product->pivot->hours }}
                                - Cantidad:
                                {{ $product->pivot->quantity }}
                            </li>
                        @empty
                            <p class="text-gray-500 italic">Aún sin medicamentos</p>
                        @endforelse
                    </nav>
                @endif

            </div>

            @if ($treatment->need_products)
                <div class="flex justify-center items-center">
                    <x-mini-button rounded amber icon="beaker" wire-load-enabled
                        wire:click="addMedicines({{ $treatment->id }})" spinner="addMedicines" />
                </div>
            @endif

        </div>
    @endforeach

</div>
