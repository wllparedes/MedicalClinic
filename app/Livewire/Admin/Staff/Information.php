<?php

namespace App\Livewire\Admin\Staff;

use App\Models\User;
use Livewire\Component;

class Information extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
        $user->avatar();
    }

    public function render()
    {
        return view('livewire.admin.staff.information');
    }
}
