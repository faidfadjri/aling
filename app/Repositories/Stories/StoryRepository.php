<?php

namespace App\Repositories\Stories;

interface StoryRepository
{
    static function getActiveStories(): ?array;
}
