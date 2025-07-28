<?php

namespace App\Livewire\Section;

use App\Models\Media\Story;
use App\Repositories\Stories\StoryRepository;
use App\Repositories\Stories\StoryRepositoryImpl;
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
        $this->stories = StoryRepositoryImpl::getActiveStories();
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
