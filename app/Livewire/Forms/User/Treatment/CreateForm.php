<?php

namespace App\Livewire\Forms\User\Treatment;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateForm extends Form
{

    public $diagnosis;
    #[Validate('required|max:255')]
    public $treatment;
    #[Validate('max:255')]
    public $note;
    #[Validate('bool')]
    public $need_products = false;

    public function save()
    {
        $this->validate();

        $treatment = $this->diagnosis->treatments()->create([
            'diagnosis' => $this->diagnosis,
            'treatment' => $this->treatment,
            'need_products' => $this->need_products ?? false
        ]);

        if ($treatment) {
            $this->reset();
        }
    }
}
