<?php

namespace App\Livewire\Forms\User\Product;

use App\Services\FileService;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class EditForm extends Form
{
    public $product;
    #[Validate('required')]
    public $name;
    #[Validate('max:255')]
    public $description;
    #[Validate('required|numeric|exists:categories,id')]
    public $category_id;
    #[Validate('required|array|exists:sub_categories,id')]
    public $subcategories_id;
    #[Validate('nullable|image|max:1024|mimes:jpg,jpeg,png')]
    public $image;

    public function updateImage($image)
    {
        $fileService = new FileService();
        $storage = env('FILESYSTEM_DISK');

        if ($this->image) {
            $fileService->destroy($image, $storage);
            $fileService->store($this->product, 'images', 'products', $this->image, $storage, 'products', 'one_one');
        }
    }

    public function update($image)
    {
        $this->validate();

        $this->product->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description ?? NULL,
            'category_id' => $this->category_id,
        ]);

        $this->product->subCategories()->sync($this->subcategories_id);

        $this->updateImage($image);

        $this->reset();
    }
}
