<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserAddress extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user_address';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
