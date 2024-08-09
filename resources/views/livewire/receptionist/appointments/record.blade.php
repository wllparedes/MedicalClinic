<div>
    <section class="flex flex-col flex-wrap gap-4">
        @forelse ($appointments as $appointment)
            <div class="appointment-container relative shadow-md border-slate-300 border rounded-md p-4">

                <div class="absolute top-4 right-4">
                    @if ($appointment->status == 'pending')
                        <x-badge rounded warning label="Pendiente" />
                    @elseif ($appointment->status == 'rejected')
                        <x-badge rounded negative label="Rechazado" />
                    @elseif ($appointment->status == 'approved')
                        <x-badge rounded positive label="Aprovado" />
                    @elseif ($appointment->status == 'cancelled')
                        <x-badge rounded positive label="Cancelado" />
                    @endif
                </div>

                <div class="flex gap-4">
                    <div class="information-container flex flex-col gap-4 w-full">

                        <div class="appointment-container">
                            <p class="font-bold text-xs mb-5 underline underline-offset-8">
                                DETALLES DE LA CITA:
                            </p>

                            <div class="flex gap-3 justify-start flex-wrap">

                                <div class="text-sm">
                                    <span class="font-semibold text-gray-600">Motivo:</span>
                                    <span class="text-gray-500 italic">
                                        {{ $appointment->motive }}
                                    </span>
                                </div>
                                <div class="text-sm">
                                    <span class="font-semibold text-gray-600">Mensaje:</span>
                                    <span class="text-gray-500 italic">
                                        {{ $appointment->message }}
                                    </span>
                                </div>
                                <div class="text-sm">
                                    <span class="font-semibold text-gray-600">Tipo:</span>
                                    <span class="text-gray-500 italic">
                                        {{ $appointment->type }}
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
                                    <span class="font-semibold text-gray-600">Enlace:</span>
                                    <span class="text-gray-500 italic">
                                        {!! getLink($appointment->link) !!}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <hr class="h-px w-full my-2 bg-gray-300 border-0">

                        <section class="patient-container border border-dashed border-cyan-600 rounded-md p-3"
                            x-data="{ open: false }">

                            <div class="flex justify-between items-center h-8">
                                <span class="text-primary font-bold text-xs mb-5 underline underline-offset-8">
                                    PACIENTE:
                                </span>
                                <div class="flex gap-2 text-slate-500 cursor-pointer select-none" @click="open = !open">
                                    <span class="text-xs" x-show="open">Ocultar</span>
                                    <x-icon name="chevron-up" class="w-4 h-4" x-show="open" />
                                    <span class="text-xs " x-show="open == false" x-cloak>Mostrar</span>
                                    <x-icon name="chevron-down" class="w-4 h-4" x-show="open == false" x-cloak />
                                </div>
                            </div>

                            <div class="flex gap-4 w-full" x-show="open" x-cloak x-transition>
                                <div class="flex gap-3 justify-center items-center flex-wrap">
                                    <div class="text-sm">
                                        <span class="font-semibold text-gray-600">Nombres:</span>
                                        <span class="text-gray-500 italic">
                                            {{ $appointment->patient->names }}
                                        </span>
                                    </div>
                                    <div class="text-sm">
                                        <span class="font-semibold text-gray-600">Apellidos:</span>
                                        <span class="text-gray-500 italic">
                                            {{ $appointment->patient->last_names }}
                                        </span>
                                    </div>
                                    <div class="text-sm">
                                        <span class="font-semibold text-gray-600">DNI:</span>
                                        <span class="text-gray-500 italic">
                                            {{ $appointment->patient->dni }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </section>

                        <section class="doctor-container border border-dashed border-cyan-600 rounded-md p-3"
                            x-data="{ open: false }">
                            <div class="flex justify-between items-center h-8">
                                <span class="text-primary font-bold text-xs mb-5 underline underline-offset-8">
                                    DOCTOR:
                                </span>
                                <div class="flex gap-2 text-slate-500 cursor-pointer select-none" @click="open = !open">
                                    <span class="text-xs" x-show="open">Ocultar</span>
                                    <x-icon name="chevron-up" class="w-4 h-4" x-show="open" />
                                    <span class="text-xs " x-show="open == false" x-cloak>Mostrar</span>
                                    <x-icon name="chevron-down" class="w-4 h-4" x-show="open == false" x-cloak />
                                </div>
                            </div>
                            <div class="flex gap-4 w-full" x-show="open" x-cloak x-transition>
                                @if ($appointment->doctor)
                                    <div class="flex gap-3 justify-center items-center flex-wrap">
                                        <div class="text-sm">
                                            <span class="font-semibold text-gray-600">Nombres:</span>
                                            <span class="text-gray-500 italic">
                                                {{ $appointment->doctor->names }}
                                            </span>
                                        </div>
                                        <div class="text-sm">
                                            <span class="font-semibold text-gray-600">Apellidos:</span>
                                            <span class="text-gray-500 italic">
                                                {{ $appointment->doctor->last_names }}
                                            </span>
                                        </div>
                                        <div class="text-sm">
                                            <span class="font-semibold text-gray-600">DNI:</span>
                                            <span class="text-gray-500 italic">
                                                {{ $appointment->doctor->dni }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-sm text-slate-500">Sin doctor asignado.</p>
                                @endif
                            </div>

                        </section>

                    </div>
                </div>

                <x-button label="Más información" teal wire-load-enabled class="mt-4 w-full"
                    wire:click='redirectAppointment({{ $appointment }})' />
            </div>

        @empty
            <div class="flex items-center justify-center h-64">
                <div class="text-center">
                    <x-icon name="minus-circle" class="w-14 h-14 text-red-500 mx-auto mb-4" />
                    <h2 class="text-2xl font-semibold text-gray-700 mb-2">¡No se encontraron citas médicas!
                    </h2>
                </div>
            </div>
        @endforelse
    </section>

    <br>

    {{ $appointments->links(data: ['scrollTo' => false]) }}

</div>
