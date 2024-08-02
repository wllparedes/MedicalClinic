<?php

namespace App\Livewire\Forms\User\Specialty;

use App\Models\Specialty;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class CreateForm extends Form
{
    #[Validate('required')]
    public $name;
    #[Validate('max:255')]
    public $description;

    public function save()
    {
        $this->validate();

        $specialty = Specialty::create([
            'name' => $this->name,
            'description' => $this->description ?? NULL,
            'slug' => Str::slug($this->name)
        ]);

        if ($specialty) {
            $this->reset();
        }
    }
}
