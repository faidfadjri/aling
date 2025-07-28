<?php

namespace App\Repositories\Banner;

use App\Models\Media\Banner;
use Illuminate\Database\Eloquent\Collection;

interface BannerRepository
{
    public static function getBanners(): array|Collection|null;
}
