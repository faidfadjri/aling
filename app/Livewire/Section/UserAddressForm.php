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
    public $addressID;

    public $province_id;
    public $regency_id;
    public $district_id;
    public $village_id;

    public $provinces = [];
    public $regencies = [];
    public $districts = [];
    public $villages = [];

    protected $rules = [
        'type' => 'required|string',
        'province_id' => 'required|exists:provinces,id',
        'regency_id' => 'required|exists:regencies,id',
        'district_id' => 'required|exists:districts,id',
        'village_id' => 'required|exists:villages,id',
        'description' => 'required|string|min:5',
    ];

    public function mount($addressID = null)
    {
        $this->addressID = $addressID;
        $this->provinces = Province::orderBy('name', 'asc')->get();

        if ($addressID) {
            $address = UserAddress::find($addressID);
            if ($address) {
                $this->type = $address->type;
                $this->description = $address->description;
                $this->province_id = $address->village->district->regency->province_id ?? null;
                $this->regency_id = $address->village->district->regency_id ?? null;
                $this->district_id = $address->village->district_id ?? null;
                $this->village_id = $address->village_id ?? null;

                $this->regencies = Regency::where('province_id', $this->province_id)->get();
                $this->districts = District::where('regency_id', $this->regency_id)->get();
                $this->villages = Village::where('district_id', $this->district_id)->get();
            }
        }
    }

    public function updatedProvinceId($value)
    {
        $this->regencies = Regency::where('province_id', $value)->get();
        $this->regency_id = $this->district_id = $this->village_id = null;
        $this->districts = $this->villages = [];
    }

    public function updatedRegencyId($value)
    {
        $this->districts = District::where('regency_id', $value)->get();
        $this->district_id = $this->village_id = null;
        $this->villages = [];
    }

    public function updatedDistrictId($value)
    {
        $this->villages = Village::where('district_id', $value)->get();
        $this->village_id = null;
    }

    public function save()
    {
        $this->validate([
            'type' => 'required|string',
            'province_id' => 'required|exists:reg_provinces,id',
            'regency_id' => 'required|exists:reg_regencies,id',
            'district_id' => 'required|exists:reg_districts,id',
            'village_id' => 'required|exists:reg_villages,id',
            'description' => 'required|string|min:5',
        ], [
            'type.required' => 'Tolong pilih jenis alamat dulu.',
            'type.string' => 'Jenis alamat harus berupa teks.',

            'province_id.required' => 'Provinsi belum dipilih.',
            'province_id.exists' => 'Provinsi yang dipilih nggak valid.',

            'regency_id.required' => 'Kota atau kabupaten belum dipilih.',
            'regency_id.exists' => 'Kota atau kabupaten yang dipilih nggak valid.',

            'district_id.required' => 'Kecamatan belum dipilih.',
            'district_id.exists' => 'Kecamatan yang dipilih nggak valid.',

            'village_id.required' => 'Kelurahan atau desa belum dipilih.',
            'village_id.exists' => 'Kelurahan atau desa yang dipilih nggak valid.',

            'description.required' => 'Tolong isi detail alamatnya.',
            'description.string' => 'Detail alamat harus berupa teks.',
            'description.min' => 'Detail alamat minimal 5 karakter.',
        ]);



        if ($this->addressID) {
            $address = UserAddress::find($this->addressID);
            $address?->update([
                'type' => $this->type,
                'description' => $this->description,
                'village_id' => $this->village_id,
            ]);
        } else {
            UserAddress::create([
                'user_id' => Auth::id(),
                'type' => $this->type,
                'description' => $this->description,
                'village_id' => $this->village_id,
            ]);
        }

        $this->dispatch('success', ['message' => 'Alamat berhasil disimpan.']);

        $this->reset(['type', 'description', 'province_id', 'regency_id', 'district_id', 'village_id']);
        $this->regencies = $this->districts = $this->villages = [];
    }

    public function render()
    {
        return view('livewire.section.user-address-form');
    }
}
