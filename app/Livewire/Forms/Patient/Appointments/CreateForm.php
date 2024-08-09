<?php

namespace App\Livewire\Forms\Patient\Appointments;

use App\Models\Appointment;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateForm extends Form
{
    #[Validate('required|max:255')]
    public $motive;
    #[Validate('required|date')]
    public $date;
    #[Validate('required')]
    public $type = 'normal';
    #[Validate('max:255')]
    public $message;

    public function save()
    {
        $this->validate();

        $patient = auth()->user();

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'motive' => $this->motive,
            'date' => $this->date,
            'type' => $this->type ?? 'normal',
            'message' => $this->message ?? NULL
        ]);

        if ($appointment) {
            $this->reset();
        }
    }
}
