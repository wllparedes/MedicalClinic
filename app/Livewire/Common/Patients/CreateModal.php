<?php

namespace App\Livewire\Common\Patients;

use App\Livewire\Forms\User\Patients\CreateForm;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class CreateModal extends Component
{
    use WireUiActions;

    public $openCreate = false;
    public CreateForm $createForm;

    public function save()
    {
        $this->createForm->save();
        $this->dispatch('table:refresh');
        $this->openCreate = false;
        $this->dialog()->success(config('parameters.messages.client_create'));
    }

    public function placeholder(): View
    {
        return view('skeletons.button');
    }

    public function render()
    {
        return view('livewire.common.patients.create-modal');
    }
}
