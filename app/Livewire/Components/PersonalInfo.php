<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PersonalInfo extends Component
{
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
            'name'      => 'required|string|max:255',
            'username'  => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'     => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'hp'        => 'required|string|max:20',
            'password'  => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'name'      => $this->name,
            'username'  => $this->username,
            'email'     => $this->email,
            'hp'        => $this->hp,
            'password'  => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        $this->isEditing = false;
        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.components.personal-info');
    }
}
