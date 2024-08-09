<x-patient.app-layout>

    <x-navigation>
        <x-nav-tab route="patient.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="patient.appointments" label="Citas médicas" :prev="1" />
    </x-navigation>

    <x-section-content>

        <x-dropdown-card title="Calendario de citas">

            <livewire:patient.appointments.create-modal lazy />

            <livewire:patient.appointments.view-modal />

            <livewire:patient.appointments.calendar :day-click-enabled="false" :drag-and-drop-enabled="false"
                event-view="partials.calendar.event" day-view="partials.calendar.day"
                before-calendar-view="partials.calendar.before-calendar"
                day-of-week-view="partials.calendar.day-week-calendar" />

        </x-dropdown-card>

    </x-section-content>

    @push('js')
        @livewireCalendarScripts
    @endpush

</x-patient.app-layout>
