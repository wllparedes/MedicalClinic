<?php

namespace App\Livewire\Admin\Staff;

use App\Models\Specialty;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddSpecialties extends Component
{
    #[Validate('required|exists:specialties,id')]
    public $specialties_id;
    public $openAddSpecialty = false;
    public $specialties = [];
    public $user;

    #[On('addSpecialties')]
    public function openModal(User $user)
    {
        $this->user = $user;
        $this->specialties_id = [];
        $this->loadSpecialties();
        $this->openAddSpecialty = true;
    }

    public function add()
    {
        $this->validate();
        $this->user->specialties()->attach($this->specialties_id);
        $this->specialties_id = [];
        $this->loadSpecialties();
    }

    public function deleteSpecialty(Specialty $specialty)
    {
        $this->user->specialties()->detach($specialty->id);
        $this->loadSpecialties();
    }

    public function loadSpecialties()
    {
        $this->user->load('specialties');
        $this->specialties = $this->user->specialties;
    }

    public function render()
    {
        return view('livewire.admin.staff.add-specialties');
    }
}
