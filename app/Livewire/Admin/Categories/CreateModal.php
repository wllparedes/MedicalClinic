<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Forms\User\Category\CreateForm;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Str;
use WireUi\Traits\WireUiActions;

class CreateModal extends Component
{
    use WireUiActions;

    public $openCreate = false;
    public CreateForm $createForm;

    public function save()
    {
        $this->createForm->save();
        $this->openCreate = false;
        $this->dispatch('table-category:refresh');
        $this->dialog()->success(config('parameters.messages.category_create'));
    }

    public function updatedCreateFormName($value)
    {
        $this->createForm->slug = Str::slug($value);
    }

    public function placeholder(): View
    {
        return view('skeletons.button');
    }

    public function render()
    {
        return view('livewire.admin.categories.create-modal');
    }
}
