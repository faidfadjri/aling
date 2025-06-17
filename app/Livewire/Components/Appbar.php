<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Appbar extends Component
{
    public string $search = '';
    public array $results = [];

    public bool $isFocused = false;

    public function updatedSearch()
    {
        $this->results = [];
        $this->isFocused = true;

        Log::alert('Search initiated', [
            'search_term' => $this->search,
        ]);
        $this->doSearch();
    }

    public function doSearch()
    {
        usleep(500000);

        $allPossibleResults = [
            'Ayam Potong 5KG',
            'Ayam Kampung 10KG',
            'Ayam Organik',
            'Daging Sapi Lokal',
            'Ikan Segar',
            'Telur Ayam',
            'Beras 10KG',
            'Gula Pasir',
            'Minyak Goreng',
            'Susu Segar 1L',
        ];

        if (!empty($this->search)) {
            $this->results = array_filter($allPossibleResults, function ($item) {
                return stripos($item, $this->search) !== false;
            });
        } else {
            $this->results = [];
        }
    }

    public function render()
    {
        return view('livewire.components.appbar');
    }
}
