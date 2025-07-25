<?php

namespace App\Livewire\Section;

use App\Models\Media\Story;
use Livewire\Component;

class Stories extends Component
{
    public $selectedStory = null;
    public $currentIndex = 0;
    public $stories = [];

    public function mount()
    {
        $this->loadStories();
    }

    public function loadStories()
    {
        $this->stories = Story::with('user')
            ->active()
            ->orderBy('created_at', 'desc')
            ->get()
            ->filter(function ($story) {
                return !$story->checkExpired();
            })
            ->values()
            ->toArray();
    }

    public function openStory($index)
    {
        $this->currentIndex = (int) $index;
        $this->selectedStory = $this->stories[$this->currentIndex] ?? null;
    }

    public function closeStory()
    {
        $this->selectedStory = null;
        $this->currentIndex = 0;
    }

    public function nextStory()
    {
        if ($this->currentIndex < count($this->stories) - 1) {
            $this->currentIndex++;
            $this->selectedStory = $this->stories[$this->currentIndex];
        } else {
            $this->closeStory();
        }
    }

    public function prevStory()
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
            $this->selectedStory = $this->stories[$this->currentIndex];
        }
    }

    public function render()
    {
        return view('livewire.section.stories');
    }
}
