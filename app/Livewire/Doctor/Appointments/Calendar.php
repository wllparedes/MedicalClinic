<?php

namespace App\Livewire\Doctor\Appointments;

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;
use Omnia\LivewireCalendar\LivewireCalendar;

class Calendar extends LivewireCalendar
{
    public $doctor;

    public function events(): Collection
    {
        $this->doctor = User::find(auth()->user()->id);

        $this->doctor->load([
            'appointments' => fn ($q) => $q->where('status', '!=', 'pending')
        ]);

        $appointments = $this->doctor->appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->motive,
                'description' => $appointment->message,
                'date' => $appointment->date
            ];
        });
        return collect($appointments);
    }
    public function onEventClick($appointmentId)
    {
        $appointment = (int) $appointmentId;
        $this->dispatch('modal-information:show', ['appointment' => $appointment]);
    }
}
