<x-modal-card blur="md" title="Cita médica" wire:model="openView" width="2xl">

    @if ($openView)
        <div class="flex gap-3 justify-between flex-wrap">
            <p class="font-bold text-xs mb-5 underline underline-offset-8 text-primary">
                CITA:
            </p>
            <div>
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
        </div>

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
                    <span class="text-gray-500 italic">
                        {!! getLink($appointment->link) !!}
                    </span>
                </div>
            </div>
        @endif

        <br>

        <p class="font-bold text-xs mb-5 underline underline-offset-8 text-primary">
            DOCTOR:
        </p>

        @if ($appointment->doctor)
            <div class="flex gap-3 justify-start flex-wrap">
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
            </div>
            <div class="flex gap-3 justify-start flex-wrap">
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">DNI:</span>
                    <span class="text-gray-500 italic">
                        {{ $appointment->doctor->dni }}
                    </span>
                </div>
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">Correo:</span>
                    <span class="text-gray-500 italic">
                        {{ $appointment->doctor->email }}
                    </span>
                </div>
            </div>
            <div class="flex gap-3 justify-start flex-wrap">
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">Teléfono:</span>
                    <span class="text-gray-500 italic">
                        {{ $appointment->doctor->phone }}
                    </span>
                </div>
                <div class="text-sm">
                    <span class="font-semibold text-gray-600">Teléfono de emergencia:</span>
                    <span class="text-gray-500 italic">
                        {{ $appointment->doctor->emergency_phone ?? '.' }}
                    </span>
                </div>
            </div>
        @else
            <p class="text-gray-500 text-xs italic">Aún sin un doctor asignado</p>
        @endif

        <div class="flex mt-4">
            <x-button wire:click='viewDetails({{ $appointment }})' right-icon="plus" teal label="Ver más detalles"
                wire-load-enabled class="w-full" />
        </div>

    @endif

</x-modal-card>
