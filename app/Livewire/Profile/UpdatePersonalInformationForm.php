<?php

namespace App\Livewire\Profile;

use App\Livewire\Forms\Profile\UpdateProfileInformationForm;
use App\Models\User;
use Livewire\Component;

class UpdatePersonalInformationForm extends Component
{

    public User $user;
    public UpdateProfileInformationForm $updateForm;

    public function mount()
    {
        $this->user = auth()->user();
        $this->updateForm->dni = $this->user->dni;
        $this->updateForm->phone = $this->user->phone;
        $this->updateForm->username = $this->user->username;
    }

    public function updateProfileInformation()
    {
        $this->updateForm->save($this->user);
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.profile.update-personal-information-form');
    }
}
