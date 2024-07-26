<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="receptionist.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="receptionist.appointments" label="Citas médicas" :prev="1" />
        <x-nav-tab route="receptionist.appointments.show" :var="$appointment" label="Ver médicas" :prev="1" />
    </x-navigation>

    <x-section-content>

        <livewire:receptionist.appointments.information :appointment="$appointment" />

        @if ($appointment->status == 'pending')
            <livewire:receptionist.appointments.response :appointment="$appointment" />
        @endif

    </x-section-content>

</x-user.app-layout>
