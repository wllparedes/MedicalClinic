<?php

namespace App\Livewire\Forms\Common;

use App\Models\Patient;
use Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class RegisterForm extends Form
{
    #[Validate('required')]
    public $names;
    #[Validate('required')]
    public $last_names;
    #[Validate('required|unique:users,username')]
    public $username;
    #[Validate('required|unique:users,dni')]
    public $dni;
    #[Validate('required')]
    public $gender = 'hombre';
    #[Validate('required')]
    public $phone;
    #[Validate('required|email')]
    public $email;
    #[Validate('required|min:8')]
    public $password;
    #[Validate('required|same:password')]
    public $password_confirmation;

    public function save()
    {
        $this->validate();

        $data = $this->all();
        $data['password'] = Hash::make($data['password']);
        $data['gender'] = getGenderChar($data['dni']);
        $data['slug'] = Str::slug($data['names'] . ' ' . $data['last_names']);

        $patient = Patient::create($data);

        if ($patient) {
            $this->reset();
        }
    }
}
