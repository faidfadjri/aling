<?php

namespace App\Repositories\Order;

use Illuminate\Database\Eloquent\Collection;

interface OrderRepository
{
    static function searchByInvoice(?string $keyword): array|Collection|null;
    static function getCountByDate($date = null);

    static function save($order);
}
