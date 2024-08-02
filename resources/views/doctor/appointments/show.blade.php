<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="doctor.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="doctor.appointments" label="Citas médicas" :prev="1" />
        <x-nav-tab route="doctor.appointments.show" :var="['appointment' => $appointment]" label="Información" :prev="1" />
    </x-navigation>

    <x-section-content>


        <div class="flex gap-4 flex-wrap">
            <x-dropdown-card title="Paciente" class="w-[350px]">

                <div class="flex gap-4 p-2 flex-col">
                    <div class="container-profile w-full flex justify-center items-center">
                        <img class="object-cover w-20 h-20 border rounded-full border-slate-100 shadow-md"
                            src="{{ verifyMultipleAvatar($appointment->patient->file, $appointment->patient->names) }}">
                    </div>
                    <div class="container-information flex flex-col gap-2">
                        <p class="font-semibold text-sm truncate">
                            {{ $appointment->patient->full_name }}
                        </p>
                        <p class="text-xs">
                            <span class="font-semibold text-gray-600">DNI:</span>
                            <span class="text-gray-500 italic">
                                {{ $appointment->patient->dni }}
                            </span>
                        </p>
                        <p class="text-xs">
                            <span class="font-semibold text-gray-600">Género:</span>
                            <span class="text-gray-500 italic">
                                {{ getGenderName($appointment->patient->gender) }}
                            </span>
                        </p>
                        <p class="text-xs truncate">
                            <span class="font-semibold text-gray-600">Correo:</span>
                            <span class="text-gray-500 italic">
                                {{ $appointment->patient->email }}
                            </span>
                        </p>
                        <span class="text-xs truncate">
                            <span class="font-semibold text-gray-600">Teléfono:</span>
                            <span class="text-gray-500 italic">
                                {{ $appointment->patient->phone }}
                            </span>
                        </span>
                        <span class="text-xs truncate">
                            <span class="font-semibold text-gray-600">Teléfono de emergencia:</span>
                            <span class="text-gray-500 italic">
                                {{ $appointment->patient->emergency_phone ?? '-' }}
                            </span>
                        </span>
                        <span class="text-xs truncate">
                            <span class="font-semibold text-gray-600">Fecha de nacimiento:</span>
                            <span class="text-gray-500 italic">
                                {{ $appointment->patient->birthday }}
                            </span>
                        </span>
                    </div>
                </div>

            </x-dropdown-card>

            <x-dropdown-card title="Cita médica" class="w-[600px]">

                <livewire:doctor.appointments.details :appointment="$appointment" />

            </x-dropdown-card>

        </div>

        <br>

        <x-dropdown-card title="Diagnostico">

            <livewire:doctor.appointments.diagnosis :appointment="$appointment" />

            <livewire:doctor.appointments.treatment :appointment="$appointment" />

        </x-dropdown-card>


    </x-section-content>

</x-user.app-layout>
