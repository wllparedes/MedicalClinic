<?php

namespace App\Livewire\Common\Patients;

use App\Livewire\Forms\User\Patients\EditForm;
use App\Models\Patient;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class EditModal extends Component
{

    use WireUiActions;

    public $openEdit = false;
    public EditForm $editForm;

    #[On('editPatient')]
    public function openModal(Patient $patient)
    {
        $this->editForm->resetErrorBag();
        $this->editForm->resetValidation();
        $this->editForm->reset();

        $this->editForm->patient = $patient;
        $this->editForm->fill($patient->toArray());
        $this->editForm->gender = getGenderNameMin($patient->gender);
        $this->openEdit = true;
    }

    public function update()
    {
        $this->editForm->update();
        $this->dispatch('table:refresh');
        $this->openEdit = false;
        $this->dialog()->success(config('parameters.messages.updated_record'));
    }

    public function render()
    {
        return view('livewire.common.patients.edit-modal');
    }
}
