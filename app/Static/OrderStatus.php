<?php

namespace App\Static;

class OrderStatus
{
    const PENDING       = 'pending';
    const IN_PROGRESS   = 'diproses';
    const COMPLETED     = 'selesai';
    const REQ_CANCEL    = 'pengajuan pembatalan';
    const CANCELLED     = 'dibatalkan';
    const REJECTED      = 'ditolak';

    public static function all(): array
    {
        return [
            self::PENDING,
            self::IN_PROGRESS,
            self::COMPLETED,
            self::REQ_CANCEL,
            self::CANCELLED,
            self::REJECTED,
        ];
    }

    public static function isValid(string $status): bool
    {
        return in_array($status, self::all());
    }

    public function getStatusColor(string $status): string
    {
        return match ($status) {
            OrderStatus::PENDING       => 'gray',
            OrderStatus::IN_PROGRESS   => 'blue',
            OrderStatus::COMPLETED     => 'green',
            OrderStatus::REQ_CANCEL    => 'yellow',
            OrderStatus::CANCELLED     => 'red',
            OrderStatus::REJECTED      => 'rose',
            default                    => 'gray',
        };
    }
}
