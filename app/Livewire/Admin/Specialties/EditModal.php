<?php

namespace App\Livewire\Admin\Specialties;

use App\Livewire\Forms\User\Specialty\EditForm;
use App\Models\Specialty;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class EditModal extends Component
{
    use WireUiActions;
    public $openEditSpecialty = false;
    public EditForm $editForm;

    public function update()
    {
        $this->editForm->update();
        $this->dispatch('table-specialty:refresh');
        $this->openEditSpecialty = false;
        $this->dialog()->success(config('parameters.messages.updated_record'));
    }

    #[On('editSpecialty')]
    public function openModal(Specialty $specialty)
    {
        $this->editForm->specialty = $specialty;
        $this->editForm->fill($specialty->toArray());
        $this->openEditSpecialty = true;
    }

    public function render()
    {
        return view('livewire.admin.specialties.edit-modal');
    }
}
