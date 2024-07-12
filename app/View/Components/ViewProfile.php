<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ViewProfile extends Component
{
    /**
     * Create a new component instance.
     */
    public $username;
    public $email;
    public $user;
    public $avatar;
    public function __construct()
    {
        $this->user = Auth::user();
        $this->user->avatar();

        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->avatar = $this->user->file;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.view-profile');
    }
}
