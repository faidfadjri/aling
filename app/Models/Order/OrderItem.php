<?php

namespace App\Models\Order;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderOutlet()
    {
        return $this->belongsTo(OrderOutlet::class, 'order_outlet_id', 'id');
    }
}
