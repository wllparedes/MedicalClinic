<?php

namespace App\Livewire\Doctor\Appointments;

use App\Models\Appointment;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ViewModal extends Component
{

    public $openView = false;
    public $editLink = false;

    #[Validate('url')]
    public $link;
    public Appointment $appointment;

    #[On('modal-information:show')]
    public function openModal(Appointment $appointment)
    {
        $appointment->load('patient');
        $this->appointment = $appointment;
        $this->editLink = false;
        $this->link = NULL;
        $this->openView = true;
    }

    public function changeLinkAppointment()
    {
        $this->editLink = (!$this->editLink) ? true : false;
        $this->link = $this->editLink ? $this->appointment->link : NULL;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function saveLinkAppointment()
    {
        $this->validate();

        $this->appointment->update([
            'link' => $this->link
        ]);
        $this->editLink = false;
    }

    public function viewDetails()
    {
        $this->redirect(route('doctor.appointments.show', $this->appointment), navigate: true);
    }
    public function render()
    {
        return view('livewire.doctor.appointments.view-modal');
    }
}
