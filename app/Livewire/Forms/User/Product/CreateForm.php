<?php

namespace App\Livewire\Forms\User\Product;

use App\Models\Product;
use App\Services\FileService;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class CreateForm extends Form
{
    #[Validate('required')]
    public $name;
    #[Validate('required|max:255')]
    public $description;
    #[Validate('required|numeric|exists:categories,id')]
    public $category_id;
    #[Validate('required|array|exists:sub_categories,id')]
    public $subcategories_id = [];
    #[Validate('required|image|max:1024|mimes:jpg,jpeg,png')]
    public $image;

    public function uploadFiles(Product $product)
    {
        if ($this->image) {
            $fileService = new FileService();
            $storage = env('FILESYSTEM_DISK');
            $fileService->store($product, 'images', 'products', $this->image, $storage, 'products', 'one_one');
        }
    }

    public function save()
    {
        $this->validate();

        $product = Product::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'category_id' => $this->category_id,
        ]);

        $product->subCategories()->attach($this->subcategories_id);

        $this->uploadFiles($product);

        $this->reset();
    }
}
