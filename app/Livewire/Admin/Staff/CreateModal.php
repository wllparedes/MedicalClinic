<?php

namespace App\Livewire\Admin\Staff;

use App\Livewire\Forms\User\Staff\CreateForm;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\WireUiActions;

class CreateModal extends Component
{
    use WithFileUploads;
    use WireUiActions;

    public $openCreate = false;
    public CreateForm $createForm;
    public $roles = [];

    public function mount()
    {
        $this->roles = config('parameters.roles');
    }

    public function save()
    {
        $this->createForm->save();
        $this->dispatch('table:refresh');
        $this->openCreate = false;
        $this->dialog()->success(config('parameters.messages.staff_create'));

    }

    public function updatedCreateFormImage()
    {
        try {
            $this->createForm->validate([
                'image' => 'image|max:1024|mimes:jpeg,png,jpg',
            ]);
        } catch (Exception $e) {
            $this->createForm->image = null;
            $this->addError('image', $e->getMessage());
        }
    }

    public function deletePhotoProfile()
    {
        $this->createForm->image = null;
    }

    public function placeholder(): View
    {
        return view('skeletons.button');
    }

    public function render()
    {
        return view('livewire.admin.staff.create-modal');
    }
}
