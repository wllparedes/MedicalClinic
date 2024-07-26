<?php

namespace App\Livewire\Receptionist\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Response extends Component
{
    use WireUiActions;
    public Appointment $appointment;
    public $state = [];
    public $status;
    public $doctor_id;

    public function mount()
    {
        $this->state = config('parameters.states');
    }

    public function admission()
    {
        $this->validate([
            'status' => 'required'
        ]);

        if ($this->status == 'rejected') {
            $this->validate([
                'doctor_id' => 'exists:users,id'
            ]);
        } else {
            $this->validate([
                'doctor_id' => 'required|exists:users,id'
            ]);
        }

        $this->appointment->update([
            'doctor_id' => $this->doctor_id ?? null,
            'status' => $this->status
        ]);

        $this->dialog()->success(config('parameters.messages.appointment_response'));

        $this->redirect(route('receptionist.appointments.show', $this->appointment), navigate: true);
    }

    public function render()
    {
        return view('livewire.receptionist.appointments.response');
    }
}
