<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="admin.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="admin.staff" label="Personal" icon="users" :prev="1" />
    </x-navigation>

    <x-section-content>

        <livewire:admin.staff.create-modal lazy />

        <livewire:admin.staff.edit-modal />

        <livewire:admin.staff.table />

    </x-section-content>

</x-user.app-layout>
