<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\User\Product\EditForm;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\WireUiActions;

class EditModal extends Component
{
    use WireUiActions;
    use WithFileUploads;

    public $openEdit = false;
    public EditForm $editForm;
    public $categories = [];
    public $subcategories = [];
    //
    public $imageUrl;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function update()
    {
        $this->editForm->update($this->imageUrl);
        $this->openEdit = false;
        $this->dialog()->success(config('parameters.messages.updated_record'));
        $this->dispatch('table:refresh');
    }

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

        $this->loadSubcategories();
        $this->editForm->subcategories_id = $product->subCategories->pluck('id')->toArray();

        $this->imageUrl = $product->file;

        $this->openEdit = true;
    }

    public function loadSubcategories()
    {
        $this->subcategories = Category::where('id', $this->editForm->category_id)->first()->subCategories;
    }

    public function updatedEditFormCategoryId()
    {
        if ($this->editForm->category_id) {
            $this->loadSubcategories();
        } else {
            $this->subcategories = [];
        }
        $this->editForm->subcategories_id = [];
    }

    // functions to upload the image

    public function updatedEditFormImage()
    {
        try {
            $this->editForm->validate([
                'image' => 'nullable|image|max:1024|mimes:jpeg,png,jpg',
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
