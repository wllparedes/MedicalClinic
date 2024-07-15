<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="admin.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="admin.patients" label="Pacientes" :prev="1" />
    </x-navigation>

    <x-section-content>

        <livewire:common.patients.create-modal lazy />

        <livewire:common.patients.edit-modal />

        <livewire:common.patients.table />

    </x-section-content>

</x-user.app-layout>
