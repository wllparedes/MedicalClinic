<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="admin.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="admin.categories" label="Categorias" :prev="1" />
    </x-navigation>

    <x-section-content>


        <x-dropdown-card title="Categorías">

            <livewire:admin.categories.create-modal lazy />

            <livewire:admin.categories.table />

        </x-dropdown-card>

        <br>

        <x-dropdown-card title="Sub categorías" open="false">

            <livewire:admin.subcategories.create-modal lazy />

            <livewire:admin.subcategories.table />

        </x-dropdown-card>


    </x-section-content>

</x-user.app-layout>
