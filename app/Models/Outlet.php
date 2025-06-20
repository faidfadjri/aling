<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $table = 'outlets';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(User::class);
    }
}
