<?php

namespace App\Livewire\Doctor\Appointments;

use App\Livewire\Forms\User\Treatment\CreateForm;
use App\Models\Appointment;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class Treatment extends Component
{

    public Appointment $appointment;
    public $haveDiagnosis = false;

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $this->hasDiagnosis();
    }

    #[On('diagnosis:refresh')]
    public function hasDiagnosis()
    {
        $this->appointment->load('diagnosis');
        $this->haveDiagnosis = ($this->appointment->diagnosis && $this->appointment->diagnosis->need_treatment) ? true : false;
    }

    public function render()
    {
        return view('livewire.doctor.appointments.treatment');
    }
}
