<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavTab extends Component
{
    /**
     * Create a new component instance.
     */
    public $route, $label, $spa, $icon, $prev, $var;
    public function __construct($route = 'login', $label = 'Sin label', $spa = true, $icon = 'home', $prev = false, $var = null)
    {
        $this->route = $route;
        $this->label = $label;
        $this->spa = $spa;
        $this->icon = $icon;
        $this->prev = $prev;
        $this->var = $var;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-tab');
    }
}
