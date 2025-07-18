<?php

namespace App\Livewire\Section;

use App\Models\UserAddress as ModelsUserAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class UserAddress extends Component
{
    public $selectedAddress;

    public function mount()
    {
        $this->selectedAddress = Cookie::get('selected-address');
    }

    public function selectAddress($id)
    {
        $this->selectedAddress = $id;
        Cookie::queue('selected-address', $id, 60 * 24 * 7);
    }

    public function deleteAddress($id)
    {
        $address = ModelsUserAddress::find($id);
        if (!$address) {
            $this->dispatch('delete-address-fails', ['error' => 'gagal hapus alamat']);
        }

        $address->delete();
        $this->dispatch('delete-address-success', ['message' => 'berhasil hapus alamat']);
    }

    public function render()
    {
        $addresses = Auth::user()?->addresses ?? [];
        return view('livewire.section.user-address', [
            'addresses' => $addresses,
            'selectedAddress' => $this->selectedAddress
        ]);
    }
}
