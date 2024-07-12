<?php

namespace App\Livewire\Forms\Profile;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateProfileInformationForm extends Form
{
    public $dni;
    public $phone;
    public $username;

    public function save(User $user)
    {
        $this->validate([
            'dni' => ['required', 'string', 'max:10'],
            'phone' => ['required', 'string', 'max:10'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update([
            'dni' => $this->dni,
            'phone_number' => $this->phone,
            'username' => $this->username,
        ]);
    }
}
