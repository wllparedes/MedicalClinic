<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarLink extends Component
{
    /**
     * Create a new component instance.
     */
    public $route;
    public $icon;
    public $label;
    public $qty;
    public $spa;
    public function __construct($route = 'login', $icon = 'question-mark-circle', $label = 'Unknown', $qty = 0, $spa = true)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->label = $label;
        $this->qty = $qty;
        $this->spa = $spa;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-link');
    }
}
