<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownCard extends Component
{

    public $title;
    public $open;
    /**
     * Summary of __construct
     * @param string $title - Dropdown card title
     * @param bool $open - Attribute to initialize the dropdown open or not
     */
    public function __construct($title, $open = true)
    {
        $this->title = $title;
        $this->open = $open;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown-card');
    }
}
