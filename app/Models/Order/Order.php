<?php

namespace App\Models\Order;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table    = 'orders';
    protected $guarded  = ['id'];

    public function orderOutlets()
    {
        return $this->hasMany(OrderOutlet::class, 'order_id');
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'address_id', 'id');
    }

    public function products()
    {
        return $this->hasManyThrough(
            \App\Models\Product\Product::class,
            \App\Models\Order\OrderItem::class,
            'order_id',
            'id',
            'id',
            'product_id'
        );
    }
}
