<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="receptionist.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="receptionist.patients" label="Personal" :prev="1" />
        <x-nav-tab route="receptionist.patients.show" :var="['patient' => $patient]" label="Ver personal" :prev="1" />
    </x-navigation>

    <x-section-content>

        <livewire:receptionist.patients.information :patient="$patient" />

        @can('allowPatientPending', $patient)
            <livewire:common.patients.admission-requests :patient="$patient" />
        @endcan

    </x-section-content>

</x-user.app-layout>
