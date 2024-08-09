<section class="p-2">
    <div class="flex gap-3 justify-start flex-wrap">
        <div class="text-sm">
            <span class="font-semibold text-gray-600">Motivo:</span>
            <span class="text-gray-500 italic">
                {{ $appointment->motive }}
            </span>
        </div>
    </div>
    <div class="flex gap-3 justify-start flex-wrap">
        <div class="text-sm">
            <span class="font-semibold text-gray-600">Fecha:</span>
            <span class="text-gray-500 italic">
                {{ $appointment->date }}
            </span>
        </div>
        <div class="text-sm">
            <span class="font-semibold text-gray-600">Tipo:</span>
            <span class="text-gray-500 italic">
                {{ getTypeAppointments($appointment->type) }}
            </span>
        </div>
    </div>
    <div class="flex gap-3 justify-start flex-wrap">
        <div class="text-sm">
            <span class="font-semibold text-gray-600">Mensaje:</span>
            <span class="text-gray-500 italic">
                {{ $appointment->message ?? '-' }}
            </span>
        </div>
    </div>

    @if ($appointment->type == 'virtual')
        <div class="flex gap-3 justify-start flex-wrap">
            <div class="text-sm">
                <span class="font-semibold text-gray-600">Enlace:</span>
                <span class="text-gray-500 italic truncate">
                    {!! getLink($appointment->link, 40) !!}
                </span>
                <x-mini-button 2xs rounded teal icon="pencil" wire:click="changeLinkAppointment" wire-load-enabled />
            </div>
        </div>
    @endif

    @if ($editLink && $appointment->type == 'virtual')
        <div class="flex flex-col gap-3 mt-2">
            <div class="col-span-1 sm:col-span-2">
                <x-input placeholder="Ingrese el enlace" wire:model='link' />
            </div>
            <div class="flex justify-end">
                <x-button teal label="Guardar" wire:click="saveLinkAppointment" wire-load-enabled />
            </div>
        </div>
    @endif

    <br>

    <section class="details-container border border-dashed border-teal-600 rounded-md p-3" x-data="{ open: false }">

        <div class="flex justify-between items-center h-8">
            <span class="text-teal-600 font-bold text-xs mb-5 underline underline-offset-8">
                ACTUALIZAR DETALLES:
            </span>
            <div class="flex gap-2 text-slate-500 cursor-pointer select-none" @click="open = !open">
                <span class="text-xs" x-show="open">Ocultar</span>
                <x-icon name="chevron-up" class="w-4 h-4" x-show="open" />
                <span class="text-xs " x-show="open == false" x-cloak>Mostrar</span>
                <x-icon name="chevron-down" class="w-4 h-4" x-show="open == false" x-cloak />
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" x-show="open" x-cloak x-transition>
            <x-input label="Altura" color="positive" wire:model.blur='updateForm.height'
                placeholder="Ingrese la altura" />
            <x-input label="Peso" color="positive" wire:model.blur='updateForm.weight'
                placeholder="Ingrese el peso" />
            <x-input label="Presión arterial" color="positive" wire:model.blur='updateForm.blood_pressure'
                placeholder="Ingrese la presión alterial" />
            <x-input label="Ritmo cardiaco" color="positive" wire:model.blur='updateForm.heart_rate'
                placeholder="Ingrese el ritmo cardiaco" />
            <x-input label="Temperatura" color="positive" wire:model.blur='updateForm.temperature'
                placeholder="Ingrese la temperatura" />
            <x-input label="índice de masa corporal" color="positive" wire:model.blur='updateForm.bmi'
                placeholder="Ingrese el índice de masa corporal" />
            <div class="col-span-1 sm:col-span-2">
                <x-textarea label="Síntomas" color="positive" wire:model.blur='updateForm.symptoms'
                    placeholder="Ingrese los síntomas" />
            </div>
            <div class="col-span-1 sm:col-span-2">
                <x-button teal label="Actualizar" wire-load-enabled wire:click="update" spinner="update" />
            </div>
        </div>

    </section>




</section>
