<x-card title="Información de la cita médica">
    <h4 class="font-semibold underline mb-1">Cita:</h4>
    <div class="flex gap-3 justify-start flex-wrap p-1">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Motivo:</span>
            {{ $appointment->motive }}
        </div>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Fecha:</span>
            {{ $appointment->date }}
        </div>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Tipo:</span>
            {{ getTypeAppointments($appointment->type) }}
        </div>
    </div>
    <div class="flex gap-3 justify-start flex-wrap p-1">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Mensaje:</span>
            {{ $appointment->message }}
        </div>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Enlace:</span>
            @if ($appointment->type === 'virtual')
                <a href="{{ $appointment->link }}" target="_BLANK" class="text-primary">
                    {{ $appointment->link ?? 'No hay enlace' }}
                </a>
            @else
                -
            @endif
        </div>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Estado:</span>
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

    <h4 class="font-semibold underline mb-1">Paciente:</h4>
    <div class="flex gap-3 justify-start flex-wrap p-1">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">DNI:</span>
            {{ $patient->dni }}
        </div>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Apellidos:</span>
            {{ $patient->last_names }}
        </div>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Nombres:</span>
            {{ $patient->names }}
        </div>
    </div>
    <div class="flex gap-2 justify-start flex-wrap p-1">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Género:</span>
            {{ getGenderName($patient->gender) }}
        </div>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Nacimiento:</span>
            {{ $patient->birthday }}
        </div>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Télefono:</span>
            {{ $patient->phone }}
        </div>
    </div>
    <div class="flex gap-2 justify-start flex-wrap p-1">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Télefono de emergencia:</span>
            {{ $patient->emergency_phone ?? '-' }}
        </div>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Correo:</span>
            {{ $patient->email }}
        </div>
    </div>

    <hr class="h-px w-full my-2 bg-gray-300 border-0 mb-2">

    @if (!$appointment->doctor)
        <x-alert title="Sin doctor" secondary padding="px-4 py-2">
            <x-slot name="slot">
                No ha sido asignado un doctor para esta cita médica
            </x-slot>
        </x-alert>
    @elseif ($appointment->doctor)
        <h4 class="font-semibold underline mb-1">Doctor:</h4>
        <div class="flex gap-3 justify-start flex-wrap p-1">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold">DNI:</span>
                {{ $doctor->dni }}
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold">Apellidos:</span>
                {{ $doctor->last_names }}
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold">Nombres:</span>
                {{ $doctor->names }}
            </div>
        </div>
        <div class="flex gap-2 justify-start flex-wrap p-1">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold">Género:</span>
                {{ getGenderName($doctor->gender) }}
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold">Télefono:</span>
                {{ $doctor->phone }}
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold">Télefono de emergencia:</span>
                {{ $doctor->emergency_phone ?? '-' }}
            </div>
        </div>
        <div class="flex gap-2 justify-start flex-wrap p-1">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold">Correo:</span>
                {{ $doctor->email }}
            </div>
        </div>
    @endif

</x-card>
