<?php

namespace App\Livewire\Doctor\Appointments;

use App\Livewire\Forms\User\Diagnosis\CreateForm;
use App\Models\Appointment;
use App\Models\Product;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Diagnosis extends Component
{
    use WireUiActions;

    public CreateForm $createForm;
    public Appointment $appointment;

    public function mount()
    {
        $this->appointment->load('diagnosis');
        $this->createForm->appointment = $this->appointment;
    }

    public function save()
    {
        $this->createForm->validate();

        $this->notification()->confirm([
            'title' => config('parameters.messages.are_you_sure_?'),
            'description' => config('parameters.messages.save_record_?'),
            'icon' => 'question',
            'accept' => [
                'label' => config('parameters.messages.yes_guarded'),
                'method' => 'saveDiagnosis',
                'params' => 'Saved',
            ],
            'reject' => [
                'label' => __('Cancel'),
                'method' => 'cancel',
            ],
        ]);
    }

    public function saveDiagnosis(): void
    {
        $this->createForm->save();
        $this->notification()->success(config('parameters.messages.operation_success'));
        $this->appointment->load('diagnosis');
        $this->dispatch('diagnosis:refresh');
    }

    public function cancel(): void
    {
        $this->notification()->info(config('parameters.messages.operation_cancelled'));
    }

    public function render()
    {
        return view('livewire.doctor.appointments.diagnosis');
    }
}
