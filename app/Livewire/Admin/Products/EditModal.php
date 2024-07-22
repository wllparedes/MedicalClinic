<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\User\Product\EditForm;
use App\Models\Product;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;

class EditModal extends Component
{

    public $openEdit = false;
    public EditForm $editForm;
    //
    public $imageUrl;

    #[On('editProduct')]
    public function openModal(Product $product)
    {
        $this->editForm->resetErrorBag();
        $this->editForm->resetValidation();
        $this->editForm->reset();

        $product->load([
            'subCategories',
            'file' => fn ($q) => $q->where('category', 'products'),
        ]);

        $this->editForm->product = $product;
        $this->editForm->fill($product->toArray());
        $this->editForm->subcategories_id = $product->subCategories->pluck('id')->toArray();
        $this->imageUrl = $product->file;

        $this->openEdit = true;
    }

    // functions to upload the image

    public function updatedEditFormImage()
    {
        try {
            $this->editForm->validate([
                'image' => 'required|image|max:1024|mimes:jpeg,png,jpg',
            ]);
        } catch (Exception $e) {
            $this->editForm->image = null;
            $this->addError('image', $e->getMessage());
        }
    }

    public function deletePhotoProfile()
    {
        $this->editForm->image = null;
    }

    public function render()
    {
        return view('livewire.admin.products.edit-modal');
    }
}
