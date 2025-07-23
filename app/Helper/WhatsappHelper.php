<?php

if (!function_exists('formatWaLink')) {
    function formatWaLink($phone)
    {
        $phone = preg_replace('/\D+/', '', $phone);

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (str_starts_with($phone, '+62')) {
            $phone = substr($phone, 1);
        } elseif (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }

        return 'https://wa.me/' . $phone;
    }
}
