<?php

namespace App\Livewire\Forms\User\Patients;

use App\Models\Patient;
use Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class CreateForm extends Form
{
    #[Validate('required')]
    public $names;
    #[Validate('required')]
    public $last_names;
    #[Validate('required|unique:users,username')]
    public $username;
    #[Validate('required|unique:users,dni')]
    public $dni;
    #[Validate('required|max:15')]
    public $phone;
    #[Validate('max:15')]
    public $emergency_phone;
    #[Validate('required|date')]
    public $birthday;
    #[Validate('required|email')]
    public $email;
    #[Validate('required')]
    public $gender = 'hombre';
    #[Validate('required|min:8')]
    public $password;

    public function save()
    {
        $this->validate();

        $patient = Patient::create([
            'names' => $this->names,
            'last_names' => $this->last_names,
            'username' => $this->username,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'emergency_phone' => $this->emergency_phone,
            'birthday' => $this->birthday,
            'email' => $this->email,
            'gender' => getGenderChar($this->gender),
            'password' => Hash::make($this->password),
            'slug' => Str::slug($this->names . ' ' . $this->last_names),
            'status' => 'approved'
        ]);

        if ($patient) {
            $this->reset();
        }
    }
}
