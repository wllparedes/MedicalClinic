<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="admin.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="admin.staff" label="Personal" :prev="true" />
        <x-nav-tab route="admin.staff.show" :var="['user' => $user]" label="Detalles del usuario" :prev="true" />
    </x-navigation>

    <x-section-content>

        <livewire:admin.staff.information :user="$user" />

    </x-section-content>

</x-user.app-layout>
