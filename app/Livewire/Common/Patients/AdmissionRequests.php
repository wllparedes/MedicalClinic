<?php

namespace App\Livewire\Common\Patients;

use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AdmissionRequests extends Component
{
    public Patient $patient;
    public $state = [];
    public $status;

    public function mount()
    {
        $this->state = config('parameters.states');
    }

    public function admission()
    {

        $this->validate([
            'status' => 'required',
        ]);

        $this->patient->update([
            'status' => $this->status,
        ]);

        return $this->redirect(getRoutePatientShow($this->patient), navigate: true);
    }

    public function render()
    {
        return view('livewire.common.patients.admission-requests');
    }
}
