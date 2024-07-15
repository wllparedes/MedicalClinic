<?php

namespace App\Livewire\Forms\User\Patients;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class EditForm extends Form
{
    #[Validate]
    public $names;
    #[Validate]
    public $last_names;
    #[Validate]
    public $username;
    #[Validate]
    public $dni;
    #[Validate]
    public $phone;
    #[Validate]
    public $birthday;
    #[Validate]
    public $emergency_phone;
    #[Validate]
    public $email;
    #[Validate]
    public $gender;
    #[Validate]
    public $password;
    public $patient;

    public function rules(): array
    {
        return [
            'names' => 'required',
            'last_names' => 'required',
            'username' => ['required', Rule::unique('patients', 'username')->ignore($this->patient)],
            'dni' => ['required', Rule::unique('patients', 'dni')->ignore($this->patient)],
            'phone' => 'required',
            'birthday' => 'required|date',
            'emergency_phone' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'password' => 'nullable|min:8',
        ];
    }

    public function update()
    {
        $this->validate();

        $data = $this->all();
        $data['gender'] = getGenderChar($this->gender);
        $data['password'] = Hash::make($this->password);
        $data['slug'] = Str::slug($this->names . '-' . $this->last_names);

        $this->patient->update($data);

        $this->reset();
    }
}
