<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="receptionist.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="receptionist.doctors" label="Doctores" :prev="1" />
    </x-navigation>

    <x-section-content>

        <livewire:receptionist.doctors.schedule-modal />

        <livewire:receptionist.doctors.table />

    </x-section-content>

</x-user.app-layout>
