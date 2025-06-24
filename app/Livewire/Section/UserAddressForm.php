<?php

namespace App\Livewire\Section;

use App\Models\Region\District;
use App\Models\Region\Province;
use App\Models\Region\Regency;
use App\Models\Region\Village;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserAddressForm extends Component
{
    public $type = 'rumah';
    public $description;

    public $province_id;
    public $regency_id;
    public $district_id;
    public $village_id;

    public $provinces = [];
    public $regencies = [];
    public $districts = [];
    public $villages = [];

    public function mount()
    {
        $this->provinces = Province::orderBy('name', 'asc')->get();
    }

    public function updatedProvinceId($value)
    {
        $this->regencies = Regency::where('province_id', $value)->orderBy('name', 'asc')->get();
        $this->regency_id = $this->district_id = $this->village_id = null;
        $this->districts = $this->villages = [];
    }

    public function updatedRegencyId($value)
    {
        $this->districts = District::where('regency_id', $value)->orderBy('name', 'asc')->get();
        $this->district_id = $this->village_id = null;
        $this->villages = [];
    }

    public function updatedDistrictId($value)
    {
        $this->villages = Village::where('district_id', $value)->orderBy('name', 'asc')->get();
        $this->village_id = null;
    }

    public function save()
    {
        try {
            $this->validate([
                'type'          => 'required|in:kantor,rumah,lainya',
                'province_id'   => 'required',
                'regency_id'    => 'required',
                'district_id'   => 'required',
                'village_id'    => 'required',
                'description'   => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch("failed", "gagal menambahkan alamat, silahkan periksa kembali");
            return;
        }

        UserAddress::create([
            'user_id'       => Auth::id(),
            'village_id'    => $this->village_id,
            'type'          => $this->type,
            'description'   => $this->description,
        ]);

        $this->dispatch("success", "berhasil menambahkan alamat");

        $this->reset(['type', 'description', 'province_id', 'regency_id', 'district_id', 'village_id']);
        $this->regencies = $this->districts = $this->villages = [];
    }

    public function render()
    {
        return view('livewire.section.user-address-form');
    }
}
