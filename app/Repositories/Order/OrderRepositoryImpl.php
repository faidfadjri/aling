<?php

namespace App\Repositories\Order;

use App\Models\Order\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class OrderRepositoryImpl implements OrderRepository
{
    public static function searchByInvoice(?string $keyword): array|Collection|null
    {
        return Order::where("order_number", "like", "%$keyword%")->limit(6)->get();
    }

    public static function getCountByDate($date = null)
    {
        if (!$date) {
            $date = Carbon::today();
        }
        return Order::whereDate('created_at', $date)->count();
    }

    static function save($order)
    {
        return Order::create($order);
    }
}
