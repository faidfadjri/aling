<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOutlet extends Model
{
    use HasFactory;

    protected $table    = 'order_outlet';
    protected $guarded  = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function outlet()
    {
        return $this->belongsTo(\App\Models\Outlet::class, 'outlet_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_outlet_id', 'id');
    }
}
