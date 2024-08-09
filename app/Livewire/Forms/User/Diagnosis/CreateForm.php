<?php

namespace App\Livewire\Forms\User\Diagnosis;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateForm extends Form
{
    public $appointment;
    #[Validate('required|max:255')]
    public $diagnosis;
    #[Validate('required|max:255')]
    public $prescription;
    #[Validate]
    public $note;
    #[Validate('bool')]
    public $need_treatment = false;

    public function save()
    {
        $this->validate();

        $diagnosis =  $this->appointment->diagnosis()->create([
            'diagnosis' => $this->diagnosis,
            'prescription' => $this->prescription,
            'note' => $this->note ?? NULL,
            'need_treatment' => $this->need_treatment
        ]);

        if ($diagnosis) {
            $this->reset();
        }
    }
}
