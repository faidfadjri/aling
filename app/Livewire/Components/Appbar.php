<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Cookie;
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

    public function disableFocus()
    {
        $this->isFocused = false;
        $this->search = '';
        $this->results = [];
        Log::alert('Search focus disabled');
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

            $history = json_decode(Cookie::get('search_history', '[]'), true);
            $history = array_filter($history, fn($item) => $item !== $this->search);
            array_unshift($history, $this->search);
            $history = array_slice($history, 0, 5);

            Cookie::queue('search_history', json_encode($history), 60 * 24 * 7);
        } else {
            $this->results = [];
        }
    }


    public function render()
    {
        $searchHistory = json_decode(Cookie::get('search_history', '[]'), true);

        return view('livewire.components.appbar', [
            'searchHistory' => $searchHistory,
        ]);
    }
}
