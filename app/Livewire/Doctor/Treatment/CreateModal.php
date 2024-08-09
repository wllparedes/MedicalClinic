<?php

namespace App\Livewire\Doctor\Treatment;

use App\Livewire\Forms\User\Treatment\CreateForm;
use App\Models\Diagnosis;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class CreateModal extends Component
{
    use WireUiActions;

    public $openCreate = false;
    public CreateForm $createForm;
    public Diagnosis $diagnosis;

    public function mount(Diagnosis $diagnosis)
    {
        $this->createForm->diagnosis = $diagnosis;
    }

    public function save()
    {
        $this->createForm->save();
        $this->openCreate = false;
        $this->dialog()->success(config('parameters.messages.treatment_success'));
        $this->dispatch('treatment:refresh');
    }

    public function placeholder(): View
    {
        return view('skeletons.button-three');
    }

    public function render()
    {
        return view('livewire.doctor.treatment.create-modal');
    }
}
