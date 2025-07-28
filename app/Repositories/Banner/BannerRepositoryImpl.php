<?php

namespace App\Repositories\Banner;

use App\Models\Media\Banner;
use Illuminate\Database\Eloquent\Collection;

class BannerRepositoryImpl implements BannerRepository
{
    public static function getBanners(): array|Collection|null
    {
        return Banner::orderBy("position", "asc")->orderBy("created_at", "asc")->get();
    }
}
