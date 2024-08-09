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

        <div class="" x-show="open" x-cloak x-transition>

            <div class="flex gap-3 justify-start flex-wrap">
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">Altura:</span>
                    <span class="text-gray-500 italic">
                        {{ $details->height ?? '-' }}
                    </span>
                </div>
            </div>
            <div class="flex gap-3 justify-start flex-wrap">
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">Peso:</span>
                    <span class="text-gray-500 italic">
                        {{ $details->weight ?? '-' }}
                    </span>
                </div>
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">Presión alterial:</span>
                    <span class="text-gray-500 italic">
                        {{ $appointment->blood_pressure ?? '-' }}
                    </span>
                </div>
            </div>
            <div class="flex gap-3 justify-start flex-wrap">
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">Ritmo cardiaco:</span>
                    <span class="text-gray-500 italic">
                        {{ $appointment->heart_rate ?? '-' }}
                    </span>
                </div>
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">Temperatura:</span>
                    <span class="text-gray-500 italic">
                        {{ $appointment->temperature ?? '-' }}
                    </span>
                </div>
            </div>
            <div class="flex gap-3 justify-start flex-wrap">
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">Masa corporal:</span>
                    <span class="text-gray-500 italic">
                        {{ $appointment->bmi ?? '-' }}
                    </span>
                </div>
            </div>
            <div class="flex gap-3 justify-start flex-wrap">
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">Síntomas:</span>
                    <span class="text-gray-500 italic">
                        {{ $details->symptoms ?? '-' }}
                    </span>
                </div>
            </div>

        </div>

    </section>




</section>
