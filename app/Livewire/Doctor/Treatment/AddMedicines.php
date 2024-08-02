<?php

namespace App\Livewire\Doctor\Treatment;

use App\Models\Product;
use App\Models\Treatment;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class AddMedicines extends Component
{
    use WireUiActions;

    public $openAddForm = false;
    public $treatment;
    public $products = [];
    #[Validate('required|exists:products,id')]
    public $product;
    #[Validate('required')]
    public $hours;
    #[Validate('required')]
    public $quantity;

    public function mount()
    {
        $this->products = Product::all();
    }

    #[On('medicines:add')]
    public function openModal(Treatment $treatment)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset('treatment', 'product', 'hours', 'quantity');

        $this->treatment = $treatment;
        $this->openAddForm = true;
    }

    public function save()
    {
        $this->validate();

        $this->treatment->products()->attach(
            $this->product,
            [
                'hours' => $this->hours,
                'quantity' => $this->quantity
            ]
        );
        $this->reset('treatment', 'product', 'hours', 'quantity');
        $this->openAddForm = false;
        $this->notification()->success(config('parameters.messages.medicine_success'));
        $this->dispatch('treatment:refresh');
    }


    public function render()
    {
        return view('livewire.doctor.treatment.add-medicines');
    }
}
