<?php

namespace App\Livewire\Forms\User\Staff;

use App\Models\User;
use App\Services\FileService;
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
    #[Validate('required|max:15')]
    public $emergency_phone;
    #[Validate('required|email')]
    public $email;
    #[Validate('required')]
    public $gender = 'hombre';
    #[Validate('required')]
    public $role;
    #[Validate('required|min:8')]
    public $password;
    #[Validate('nullable|image|max:1024|mimes:jpg,jpeg,png')]
    public $image;


    /**
     * Summary of uploadAvatar
     * @param User $user Update User avatar
     * @return void
     */
    public function uploadAvatar($user)
    {
        $fileService = new FileService();
        $storage = env('FILESYSTEM_DISK');

        if ($this->image) {
            $fileService->store($user, 'images', 'avatars', $this->image, $storage, 'avatars', 'one_one');
        }
    }

    public function save()
    {

        $this->validate();

        $user = User::create([
            'names' => $this->names,
            'last_names' => $this->last_names,
            'username' => $this->username,
            'slug' => Str::slug($this->names . '-' . $this->last_names),
            'dni' => $this->dni,
            'phone' => $this->phone,
            'emergency_phone' => $this->emergency_phone,
            'email' => $this->email,
            'gender' => getGenderChar($this->gender),
            'role' => $this->role,
            'password' => Hash::make($this->password)
        ]);

        $this->uploadAvatar($user);

        if ($user) {
            $this->reset();
        }
    }
}
