<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\User\Product\CreateForm;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\WireUiActions;

class CreateModal extends Component
{
    use WireUiActions;
    use WithFileUploads;

    public $openCreate = false;
    public CreateForm $createForm;


    public function save()
    {
        $this->createForm->save();
        $this->dispatch('table:refresh');
        $this->openCreate = false;
        $this->dialog()->success(config('parameters.messages.product_create'));
    }

    // Image

    public function updatedCreateFormImage()
    {
        try {
            $this->createForm->validate([
                'image' => 'required|image|max:1024|mimes:jpeg,png,jpg',
            ]);
        } catch (Exception $e) {
            $this->createForm->image = null;
            $this->addError('image', $e->getMessage());
        }
    }

    public function deletePhotoProfile()
    {
        $this->createForm->image = null;
    }

    public function placeholder(): View
    {
        return view('skeletons.button');
    }

    public function updatedCreateFormCategoryId()
    {
        $this->createForm->reset('subcategories_id');
    }

    public function render()
    {
        return view('livewire.admin.products.create-modal');
    }
}
