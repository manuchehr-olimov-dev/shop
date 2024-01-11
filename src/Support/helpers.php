<?php


use App\Http\Controllers\Product\PriceController;
use Support\Flash\Flash;

if (!function_exists('flash')) {
    function flash(): Flash
    {
        return app(Flash::class);
    }
}

if(!function_exists('price')){
    function price($value): PriceController
    {
        return  new PriceController($value);
    }
}
