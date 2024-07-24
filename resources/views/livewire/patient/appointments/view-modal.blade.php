<x-modal-card blur="md" title="Cita médica" wire:model="openView" width="xl">

    @if ($openView)
        <div class="flex gap-3 justify-between flex-wrap">
            <p class="font-bold text-xs mb-5 underline underline-offset-8">
                INFORMACIÓN DE LA CITA MÉDICA
            </p>
            <div>
                @if ($appointment->status == 'pending')
                    <x-badge rounded warning label="Pendiente" />
                @elseif ($appointment->status == 'rejected')
                    <x-badge rounded negative label="Rechazado" />
                @elseif ($appointment->status == 'approved')
                    <x-badge rounded positive label="Admitido" />
                @elseif ($appointment->status == 'cancelled')
                    <x-badge rounded positive label="Cancelado" />
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <div class="col-span-1 sm:col-span-2">
                <x-label-text label="Motivo" :text="$appointment->motive" height="100px" />
            </div>

            <x-label-text label="Fecha" :text="$appointment->date" />

            <x-label-text label="Tipo" :text="getTypeAppointments($appointment->type)" />

            <div class="col-span-1 sm:col-span-2">
                <x-label-text label="Mensaje" :text="$appointment->message" height="100px" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <hr class="h-px w-full my-2 bg-gray-300 border-0">
            </div>

            @if ($appointment->type == 'virtual')
                <div class="col-span-1 sm:col-span-2">
                    <x-label-text label="Enlace de la cita" :text="$appointment->link ?? 'Aún no hay link'" height="50px" link="true" />
                </div>
            @endif

            <div class="col-span-1 sm:col-span-2">
                <x-button wire:click='viewDetails' right-icon="plus" teal label="Ver más detalles" wire-load-enabled
                    class="w-full" />
            </div>

        </div>
    @endif

</x-modal-card>
