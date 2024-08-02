<?php

namespace App\Livewire\Doctor\Appointments;

use App\Livewire\Forms\User\AppointmentDetails\UpdateForm;
use App\Models\Appointment;
use Livewire\Attributes\Validate;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Details extends Component
{

    use WireUiActions;

    public Appointment $appointment;
    public UpdateForm $updateForm;
    public $editLink = false;
    #[Validate('url')]
    public $link = NULL;

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $details = $appointment->detail()->firstOrCreate([
            'appointment_id' => $appointment->id
        ]);
        $this->updateForm->details = $details;
        $this->updateForm->fill($details->toArray());
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

    public function update()
    {
        $this->updateForm->update();
        $this->notification()->info(config('parameters.messages.updated_details'));
    }

    public function render()
    {
        return view('livewire.doctor.appointments.details');
    }
}
