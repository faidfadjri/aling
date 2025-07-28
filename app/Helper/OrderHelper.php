<?php

namespace App\Helper;

use App\Repositories\Order\OrderRepositoryImpl;
use Carbon\Carbon;

class OrderHelper
{
    public static function generateOrderNumber()
    {
        $datePrefix = Carbon::now()->format('Ymd');

        $orderCountToday = OrderRepositoryImpl::getCountByDate() + 1;
        $increment       = str_pad($orderCountToday, 5, '0', STR_PAD_LEFT);

        return "INV-{$datePrefix}-{$increment}";
    }
}
