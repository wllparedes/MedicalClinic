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
        $appointment->load('doctor');
        $this->appointment = $appointment;
        $this->openView = true;
    }

    public function viewDetails(Appointment $appointment)
    {
        $this->redirect(route('patient.appointments.show', $appointment), navigate: true);
    }

    public function render()
    {
        return view('livewire.patient.appointments.view-modal');
    }
}
