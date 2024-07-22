<?php

namespace App\Livewire\Forms\User\Product;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EditForm extends Form
{
    public $product;
    #[Validate('required')]
    public $name;
    #[Validate('required|max:255')]
    public $description;
    #[Validate('required|numeric|exists:categories,id')]
    public $category_id;
    #[Validate('required|array|exists:sub_categories,id')]
    public $subcategories_id;
    #[Validate('nullable|image|max:1024|mimes:jpg,jpeg,png')]
    public $image;

    public function update()
    {
        $this->validate();
    }
}
