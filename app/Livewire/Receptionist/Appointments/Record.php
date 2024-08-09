<?php

namespace App\Livewire\Receptionist\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class Record extends Component
{
    use WithPagination;

    public function redirectAppointment(Appointment $appointment)
    {
        $this->redirect(route('receptionist.appointments.show', ['appointment' => $appointment]), navigate: true);
    }

    public function render()
    {
        return view('livewire.receptionist.appointments.record', [
            'appointments' => Appointment::with([
                'patient',
                'doctor'
            ])->paginate(8)
        ]);
    }
}
