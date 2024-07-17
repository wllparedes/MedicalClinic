<?php

namespace App\Livewire\Admin\Staff;

use App\Livewire\Forms\User\Staff\EditForm;
use App\Models\User;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class EditModal extends Component
{

    use WireUiActions;

    public $openEdit = false;
    public EditForm $editForm;
    public $roles = [];
    //
    public $imageUrl;

    public function mount()
    {
        $this->roles = config('parameters.roles');
    }

    #[On('editUser')]
    public function openModal(User $user)
    {
        $this->editForm->resetErrorBag();
        $this->editForm->resetValidation();
        $this->editForm->reset();

        $this->editForm->user = $user;
        $this->editForm->fill($user->toArray());
        $this->editForm->gender = getGenderNameMin($user->gender);
        $user->avatar();
        $this->imageUrl = $user->file;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->editForm->update($this->imageUrl);
        $this->dispatch('table:refresh');
        $this->openEdit = false;
        $this->dialog()->success(config('parameters.messages.updated_record'));
    }

    // functions to upload the image

    public function updatedEditFormImage()
    {
        try {
            $this->editForm->validate([
                'image' => 'image|max:1024|mimes:jpeg,png,jpg',
            ]);
        } catch (Exception $e) {
            $this->editForm->image = null;
            $this->addError('image', $e->getMessage());
        }
    }

    public function deletePhotoProfile()
    {
        $this->editForm->image = null;
    }

    public function render()
    {
        return view('livewire.admin.staff.edit-modal');
    }
}
