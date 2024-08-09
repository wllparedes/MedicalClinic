<?php

namespace App\Livewire\Forms\User\AppointmentDetails;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateForm extends Form
{
    public $details;
    #[Validate]
    public $height;
    #[Validate]
    public $weight;
    #[Validate]
    public $blood_pressure;
    #[Validate]
    public $heart_rate;
    #[Validate]
    public $temperature;
    #[Validate]
    public $bmi;
    #[Validate('max:255')]
    public $symptoms;

    public function update()
    {
        $this->validate();

        $this->details->update([
            'height' => $this->height,
            'weight' => $this->weight,
            'blood_pressure' => $this->blood_pressure,
            'heart_rate' => $this->heart_rate,
            'temperature' => $this->temperature,
            'bmi' => $this->bmi,
            'symptoms' => $this->symptoms
        ]);
    }
}
