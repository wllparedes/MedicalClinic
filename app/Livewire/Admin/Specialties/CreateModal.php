<?php

namespace App\Livewire\Admin\Specialties;

use App\Livewire\Forms\User\Specialty\CreateForm;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class CreateModal extends Component
{
    use WireUiActions;
    public CreateForm $createForm;
    public $openCreateSpecialty = false;

    public function save()
    {
        $this->createForm->save();
        $this->dispatch('table-specialty:refresh');
        $this->openCreateSpecialty = false;
        $this->dialog()->success(config('parameters.messages.specialty_create'));
    }

    public function placeholder(): View
    {
        return view('skeletons.button-second');
    }

    public function render()
    {
        return view('livewire.admin.specialties.create-modal');
    }
}
