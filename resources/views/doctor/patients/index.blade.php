<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="doctor.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="doctor.patients" label="Pacientes" :prev="1" />
    </x-navigation>

    <x-section-content>

        <livewire:doctor.patients.record />

    </x-section-content>

</x-user.app-layout>
