<?php

namespace App\Livewire\Admin\SubCategories;

use App\Livewire\Forms\User\SubCategory\CreateForm;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateModal extends Component
{
    public $openCreateSub = false;
    public CreateForm $createForm;

    #[Computed]
    public function loadSubcategories()
    {
        $category = Category::find($this->createForm->category);
        return $category->subCategories()->get();
    }

    public function save()
    {
        $this->createForm->save();
        $this->dispatch('table-subCategory:refresh');
        $this->dispatch('table-category:refresh');
    }

    public function placeholder(): View
    {
        return view('skeletons.button-second');
    }


    #[On('form-subCategory:refresh')]
    public function resetSubCategory()
    {
        $this->createForm->resetErrorBag();
        $this->createForm->resetValidation();
        $this->createForm->reset();
    }

    public function render()
    {
        return view('livewire.admin.sub-categories.create-modal');
    }
}
