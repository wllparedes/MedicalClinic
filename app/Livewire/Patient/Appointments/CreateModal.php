<?php

namespace App\Livewire\Patient\Appointments;

use App\Livewire\Forms\Patient\Appointments\CreateForm;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class CreateModal extends Component
{
    use WireUiActions;
    public Bool $openRequest = false;
    public CreateForm $createForm;

    public function save()
    {
        $this->createForm->save();
        $this->openRequest = false;
        $this->dispatch('calendar:refresh');
        $this->dialog()->success(config('parameters.messages.appointment_request'));
    }

    public function placeholder(): View
    {
        return view('skeletons.button');
    }

    public function render()
    {
        return view('livewire.patient.appointments.create-modal');
    }
}
