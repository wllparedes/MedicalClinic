<?php

namespace App\Livewire\Receptionist\Appointments;

use App\Models\Appointment;
use Livewire\Component;

class Information extends Component
{
    public Appointment $appointment;
    public $patient;
    public $doctor;

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $this->appointment->load('patient', 'doctor');
        $this->patient = $appointment->patient;
        $this->doctor = $appointment->doctor;
    }

    public function render()
    {
        return view('livewire.receptionist.appointments.information');
    }
}
