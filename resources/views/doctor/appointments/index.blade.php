<x-user.app-layout>

    <x-navigation>
        <x-nav-tab route="doctor.dashboard" label="Inicio" icon="home" />
        <x-nav-tab route="doctor.appointments" label="Citas médicas" :prev="1" />
    </x-navigation>

    <x-section-content>

        <x-dropdown-card title="Citas médicas asignadas">

            <livewire:doctor.appointments.view-modal />

            <livewire:doctor.appointments.calendar :day-click-enabled="false" :drag-and-drop-enabled="false"
                event-view="partials.calendar.event" day-view="partials.calendar.day"
                before-calendar-view="partials.calendar.before-calendar"
                day-of-week-view="partials.calendar.day-week-calendar" />

        </x-dropdown-card>

    </x-section-content>

</x-user.app-layout>
