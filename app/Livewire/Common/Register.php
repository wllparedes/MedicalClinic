<?php

namespace App\Livewire\Common;

use App\Livewire\Forms\Common\RegisterForm;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Register extends Component
{

    use WireUiActions;

    public RegisterForm $registerForm;

    public function register()
    {
        $this->registerForm->save();

        $this->dialog()->show([
            'icon' => 'info',
            'title' => config('parameters.messages.request_sent'),
            'description' => config('parameters.messages.request_message'),
        ]);
    }

    public function render()
    {
        return view('livewire.common.register');
    }
}
