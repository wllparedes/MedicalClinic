<?php

namespace App\Livewire\Forms\User\Category;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class CreateForm extends Form
{
    #[Validate('required')]
    public $name = '';
    public $slug = '';

    public function save()
    {
        $this->validate();

        $category = Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        if ($category) {
            $this->reset();
        }
    }
}
