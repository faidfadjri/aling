<?php

namespace App\Repositories\Stories;

use App\Models\Media\Story;

class StoryRepositoryImpl implements StoryRepository
{
    public static function getActiveStories(): ?array
    {
        return Story::with('user')
            ->active()
            ->orderBy('created_at', 'desc')
            ->get()
            ->filter(function ($story) {
                return !$story->checkExpired();
            })
            ->values()
            ->toArray();
    }
}
