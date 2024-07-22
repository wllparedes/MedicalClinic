<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="admin.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="admin.products" label="Productos" :prev="1" />
    </x-navigation>

    <x-section-content>

        <livewire:admin.products.create-modal lazy />

        <livewire:admin.products.edit-modal />

        <livewire:admin.products.table />

    </x-section-content>

</x-user.app-layout>
