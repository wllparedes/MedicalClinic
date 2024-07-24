<?php

namespace App\Livewire\Patient\Appointments;

use App\Models\Appointment;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewModal extends Component
{

    public $openView = false;
    public Appointment $appointment;

    #[On('modal-information:show')]
    public function openModal(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $this->openView = true;
    }

    public function viewDetails()
    {
        dd('hi');
    }

    public function render()
    {
        return view('livewire.patient.appointments.view-modal');
    }
}
