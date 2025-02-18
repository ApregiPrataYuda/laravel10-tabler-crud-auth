<?php

namespace App\Helpers;

if (!function_exists('indo_currency')) {
    function indo_currency($nominal)
    {
        // Mengembalikan hasil format mata uang
        return 'Rp ' . number_format($nominal, 0, ',', '.');
    }
}