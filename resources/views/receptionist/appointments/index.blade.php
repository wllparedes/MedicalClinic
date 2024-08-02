<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="receptionist.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="receptionist.appointments" label="Citas médicas" :prev="1" />
    </x-navigation>

    <x-section-content>

        <livewire:receptionist.appointments.record />

    </x-section-content>

</x-user.app-layout>
