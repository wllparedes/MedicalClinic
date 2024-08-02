<x-modal-card blur="md" title="Información de la cita médica" wire:model="openView" width="2xl">

    @if ($openView)


        <div class="relative">
            <p class="font-bold text-xs mb-5 underline underline-offset-8 text-primary">
                PACIENTE:
            </p>
            <div class="absolute top-0 right-0">
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
        <div class="flex gap-3 justify-start flex-wrap">
            <div class="text-sm">
                <span class="font-semibold text-gray-600">Correo:</span>
                <span class="text-gray-500 italic">
                    {{ $appointment->patient->email }}
                </span>
            </div>
            <div class="text-sm">
                <span class="font-semibold text-gray-600">Teléfono:</span>
                <span class="text-gray-500 italic">
                    {{ $appointment->patient->phone }}
                </span>
            </div>
            <div class="text-sm">
                <span class="font-semibold text-gray-600">Genéro:</span>
                <span class="text-gray-500 italic">
                    {{ getGenderName($appointment->patient->gender) }}
                </span>
            </div>
        </div>

        <br>

        <p class="font-bold text-xs mb-5 underline underline-offset-8 text-primary">
            CITA:
        </p>

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
                    <x-mini-button 2xs rounded cyan icon="pencil" wire:click="changeLinkAppointment"
                        spinner="changeLinkAppointment" wire-load-enabled />
                </div>
            </div>
        @endif

        @if ($editLink && $appointment->type == 'virtual')
            <br>

            <div class="flex flex-col gap-3">
                <div class="col-span-1 sm:col-span-2">
                    <x-input label="Enlace" placeholder="Ingrese el enlace" wire:model='link' />
                </div>
                <div class="flex justify-end">
                    <x-button cyan label="Guardar" wire:click="saveLinkAppointment" spinner="saveLinkAppointment"
                        wire-load-enabled />
                </div>
            </div>
        @endif
        <br>
        <div class="col-span-1 sm:col-span-2">
            <x-button wire:click='viewDetails' right-icon="plus" teal label="Ver más detalles" wire-load-enabled
                class="w-full" />
        </div>
    @endif

</x-modal-card>
