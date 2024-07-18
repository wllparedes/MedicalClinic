<?php

namespace App\Livewire\Forms\User\SubCategory;

use App\Models\SubCategory;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class CreateForm extends Form
{

    #[Validate('required|exists:categories,id')]
    public $category;
    #[Validate('required')]
    public $name;

    public function save()
    {
        $this->validate();

        $subCategory = SubCategory::create([
            'category_id' => $this->category,
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        if ($subCategory) {
            $this->reset('name');
        }
    }
}
