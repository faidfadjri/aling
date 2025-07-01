<?php

namespace App\Models;

use App\Models\Product\Product;
use App\Models\Region\Village;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $table = 'outlets';
    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'outlet_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }
}
