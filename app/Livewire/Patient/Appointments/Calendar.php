<?php

namespace App\Livewire\Patient\Appointments;

use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Omnia\LivewireCalendar\LivewireCalendar;

class Calendar extends LivewireCalendar
{
    public $patient;
    public $initialYear;
    public $initialMonth;

    public function events(): Collection
    {
        $this->patient = Patient::find(auth()->user()->id);
        $appointments = $this->patient->appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->motive,
                'description' => $appointment->message,
                'date' => $appointment->date
            ];
        });
        return collect($appointments);
    }

    #[On('calendar:refresh')]
    public function loadAppointments()
    {
        $this->patient->load('appointments');
    }

    public function onEventClick($appointmentId)
    {
        $appointment = (int) $appointmentId;
        $this->dispatch('modal-information:show', ['appointment' => $appointment]);
    }
}
