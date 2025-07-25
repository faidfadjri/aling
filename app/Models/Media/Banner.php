<?php

namespace App\Models\Media;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table    = 'media_banner';
    protected $guarded  = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
