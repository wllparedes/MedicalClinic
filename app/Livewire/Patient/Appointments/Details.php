<?php

namespace App\Livewire\Patient\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Details extends Component
{
    use WireUiActions;

    public Appointment $appointment;
    public $details;

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $this->details = $appointment->detail()->firstOrCreate([
            'appointment_id' => $appointment->id
        ]);
        // $this->updateForm->details = $details;
        // $this->updateForm->fill($details->toArray());
    }

    public function render()
    {
        return view('livewire.patient.appointments.details');
    }
}
