<?php

namespace App\Livewire\Doctor\Patients;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class Record extends Component
{
    use WithPagination;

    // public function redirectAppointment(Appointment $appointment)
    // {
    //     $this->redirect(route('receptionist.appointments.show', ['appointment' => $appointment]), navigate: true);
    // }

    public function redirectChat()
    {
        $this->redirect(route('doctor.chats'), navigate: true);
    }


    public function render()
    {
        $user = auth()->user();
        $patientsId = collect($user->appointments->pluck('patient_id')->unique());

        return view('livewire.doctor.patients.record', [
            'patients' => Patient::whereIn('id', $patientsId)->with([
                'file' => fn ($q) => $q->where('category', 'avatars')
            ])->paginate(8)
        ]);
    }
}
