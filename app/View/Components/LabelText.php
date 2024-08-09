<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LabelText extends Component
{
    public $label;
    public $text;
    public $height;
    public $link;

    /**
     * Create a new component instance.
     */
    public function __construct($label = 'No label', $text = 'No text', $height = 'normal', $link = false)
    {
        $this->label = $label;
        $this->text = $text;
        $this->height = $height;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.label-text');
    }
}
