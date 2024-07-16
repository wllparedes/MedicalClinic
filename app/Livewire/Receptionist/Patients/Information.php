<?php

namespace App\Livewire\Receptionist\Patients;

use App\Models\Patient;
use Livewire\Component;

class Information extends Component
{
    public Patient $patient;

    public function mount(Patient $patient)
    {
        $this->patient = $patient;
        $patient->avatar();
    }

    public function render()
    {
        return view('livewire.receptionist.patients.information');
    }
}
