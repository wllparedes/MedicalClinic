<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="admin.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="admin.staff" label="Personal" icon="users" :prev="1" />
    </x-navigation>

    <x-section-content>

        <x-dropdown-card title="Especialidades" open="0">

            <livewire:admin.specialties.create-modal lazy />

            <livewire:admin.specialties.edit-modal />

            <livewire:admin.specialties.table />

        </x-dropdown-card>

        <br>

        <x-dropdown-card title="Personal">

            <livewire:admin.staff.create-modal lazy />

            <livewire:admin.staff.edit-modal />

            <livewire:admin.staff.add-specialties />

            <livewire:admin.staff.table />

        </x-dropdown-card>

    </x-section-content>

</x-user.app-layout>
