<?php

namespace App\Livewire\Forms\User\Specialty;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class EditForm extends Form
{
    public $specialty;
    #[Validate('required')]
    public $name;
    #[Validate('max:255')]
    public $description;

    public function update()
    {
        $this->validate();

        $specialty = $this->specialty->update([
            'name' => $this->name,
            'description' => $this->description ?? NULL,
            'slug' => Str::slug($this->name)
        ]);

        if ($specialty) {
            $this->reset();
        }
    }
}
