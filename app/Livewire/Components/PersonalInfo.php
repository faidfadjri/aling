<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class PersonalInfo extends Component
{
    use WithFileUploads;
    public $photo;

    public $name, $username, $email, $hp, $password, $password_confirmation;
    public $isEditing = false;


    public function mount()
    {
        $user = auth()->user();
        $this->name     = $user->name;
        $this->username = $user->username;
        $this->email    = $user->email;
        $this->hp       = $user->hp;
    }

    public function enableEdit()
    {
        $this->isEditing = true;
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->mount();
    }

    public function updateProfile()
    {

        $user = auth()->user();

        $this->validate([
            'name'      => 'nullable|string|max:255',
            'username'  => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'     => ['nullable', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'hp'        => 'nullable|string|max:20',
            'password'  => 'nullable|min:6|confirmed',
            'photo'     => 'nullable|image|max:1024'
        ]);

        $photoPath = $user->photo;

        if ($this->photo) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $this->photo->store('photos', 'public');
        }

        $updateData = [
            'name'      => $this->name,
            'username'  => $this->username,
            'email'     => $this->email,
            'hp'        => $this->hp,
            'password'  => $this->password ? Hash::make($this->password) : $user->password,
        ];

        if ($this->photo) {
            $updateData['photo'] = $photoPath;
        }

        $user->update($updateData);

        $this->isEditing = false;
        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.components.personal-info', [
            'user' => auth()->user(),
        ]);
    }
}
