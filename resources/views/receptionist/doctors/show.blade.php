<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="receptionist.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="receptionist.doctors" label="Doctores" :prev="1" />
        <x-nav-tab route="receptionist.doctors.show" :var="['doctor' => $doctor]" label="Detalles del Doctor" :prev="true" />
    </x-navigation>

    <x-section-content>

        <livewire:admin.staff.information :user="$doctor" />

        <livewire:receptionist.doctors.schedule-information :doctor="$doctor" />

    </x-section-content>

</x-user.app-layout>
