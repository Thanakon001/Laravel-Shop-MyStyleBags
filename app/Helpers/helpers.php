<?php
use Illuminate\Support\Facades\Route;

if (!function_exists('is_active')) {
    function is_active($routeName, $activeClass = 'bg-info text-white') {
        return request()->routeIs($routeName) ? $activeClass : '';
    }
}