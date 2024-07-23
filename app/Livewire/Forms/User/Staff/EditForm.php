<?php

namespace App\Livewire\Forms\User\Staff;

use App\Models\File;
use App\Services\FileService;
use Hash;
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
    public $emergency_phone;
    #[Validate]
    public $email;
    #[Validate]
    public $gender;
    #[Validate]
    public $password;
    #[Validate]
    public $image;
    public $user;

    public function rules(): array
    {
        return [
            'names' => 'required',
            'last_names' => 'required',
            'username' => ['required', Rule::unique('users', 'username')->ignore($this->user)],
            'dni' => ['required', Rule::unique('users', 'dni')->ignore($this->user)],
            'phone' => 'required',
            'emergency_phone' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'password' => 'nullable|min:8',
            'image' => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
        ];
    }

    /**
     * Summary of updateImage
     * @param File $image Image to delete
     * @return void
     */
    public function updateImage($image)
    {
        $fileService = new FileService();
        $storage = env('FILESYSTEM_DISK');

        if ($this->image) {
            $fileService->destroy($image, $storage);
            $fileService->store($this->user, 'images', 'avatars', $this->image, $storage, 'avatars', 'one_one');
        }
    }

    public function update($image)
    {
        $this->validate();

        $data = $this->all();
        $data['gender'] = getGenderChar($this->gender);
        $data['password'] = Hash::make($this->password);
        $data['slug'] = Str::slug($this->names . '-' . $this->last_names);

        $this->user->update($data);

        $this->updateImage($image);

        $this->reset();
    }
}
