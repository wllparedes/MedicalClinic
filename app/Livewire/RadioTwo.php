<?php

namespace App\Livewire;

use Livewire\Attributes\Modelable;
use Livewire\Component;
use Str;

class RadioTwo extends Component
{
    #[Modelable]
    public $value;

    public $label;
    public $left;
    public $right;

    public $valueLeft;
    public $valueRight;

    public function mount($label = 'Sin label', $leftLabel = 'Left', $rightLabel = 'Right')
    {
        $this->label = $label;
        $this->left  = $leftLabel;
        $this->right = $rightLabel;

        $this->valueLeft  = Str::lower($this->left);
        $this->valueRight = Str::lower($this->right);
    }

    public function render()
    {
        return view('livewire.radio-two');
    }
}
